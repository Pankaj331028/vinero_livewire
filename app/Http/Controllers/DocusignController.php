<?php

namespace App\Http\Controllers;

use App\Http\Controllers\WebsiteController;
use Auth;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Configuration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class DocusignController extends Controller {

	private $config, $web, $args, $signer_client_id = 1000;

	public function __construct() {
		$this->web = new WebsiteController;
	}
	/**
	 * Show the html page
	 *
	 * @return render
	 */
	public function index() {
		if (Session::has('envelope_id')) {
			try {
				$offer = Auth::user()->offer;
				$response = Http::withHeaders([
					'Authorization' => 'Bearer ' . Session::get('token'),
				])->get('https://demo.docusign.net/restapi/v2.1/accounts/' . env('DOCUSIGN_ACCOUNT_ID') . '/envelopes/' . Session::get('envelope_id') . '/documents/' . Auth::id());
				file_put_contents('uploads/offers/agreements/Purchase-Agreement-' . $offer->property->vms_property_id . '-' . $offer->id . '.pdf', $response->getBody());

				Session::forget('envelope_id');
				Session::forget('token');
				Session::put('signed', true);
				return redirect()->route('offer');
			} catch (\Exception $e) {
				Session::flash('error', 'Unable to process your request. Please try again or contact administrator if issue persists.');
				return redirect()->route('offer');
			}
		}
	}

	/**
	 * Connect your application to docusign
	 *
	 * @return url
	 */
	public function connectDocusign() {
		try {
			$params = [
				'response_type' => 'code',
				'scope' => 'signature',
				'client_id' => env('DOCUSIGN_CLIENT_ID'),
				'state' => 'a39fh23hnf23',
				'redirect_uri' => route('docusign.callback'),
			];
			$queryBuild = http_build_query($params);

			$url = "https://account-d.docusign.com/oauth/auth?";

			$botUrl = $url . $queryBuild;

			return redirect()->to($botUrl);
		} catch (Exception $e) {
			return redirect()->back()->with('error', 'Something Went wrong !');
		}
	}

	/**
	 * This function called when you auth your application with docusign
	 *
	 * @return url
	 */
	public function callback(Request $request) {
		$response = Http::withBasicAuth(env('DOCUSIGN_CLIENT_ID'), env('DOCUSIGN_CLIENT_SECRET'))
			->post('https://account-d.docusign.com/oauth/token', [
				'grant_type' => 'authorization_code',
				'code' => $request->code,
			]);

		$result = $response->json();
		$request->session()->put('docusign_auth_code', $result['access_token']);

		return redirect()->route('docusign.sign');
	}

	/**
	 * Write code on Method
	 *
	 * @return response()
	 */
	public function signDocument() {
		try {
			$this->args = $this->getTemplateArgs();
			$args = $this->args;

			$offer = Auth::user()->offer;

			$envelope_args = $args["envelope_args"];

			/* Create the envelope request object */
			$envelope_definition = $this->makeEnvelopeFileObject($args["envelope_args"]);
			$envelope_api = $this->getEnvelopeApi();

			$api_client = new \DocuSign\eSign\client\ApiClient($this->config);
			$envelope_api = new \DocuSign\eSign\Api\EnvelopesApi($api_client);
			$results = $envelope_api->createEnvelope($args['account_id'], $envelope_definition);
			$envelopeId = $results->getEnvelopeId();
			Session::put('envelope_id', $envelopeId);
			Session::put('token', $this->args['ds_access_token']);

			$authentication_method = 'None';
			$recipient_view_request = new \DocuSign\eSign\Model\RecipientViewRequest([
				'authentication_method' => $authentication_method,
				'client_user_id' => $envelope_args['signer_client_id'],
				'recipient_id' => '1',
				'return_url' => $envelope_args['ds_return_url'],
				'user_name' => $offer->buyer_name, 'email' => Auth::guard('accounts')->user()->email,
			]);

			$results = $envelope_api->createRecipientView($args['account_id'], $envelopeId, $recipient_view_request);
			// dd($results);
			return redirect()->to($results['url']);
		} catch (Exception $e) {
			dd($e);
		}

	}

	/**
	 * Write code on Method
	 *
	 * @return response()
	 */
	private function makeEnvelopeFileObject($args) {
		$request = new Request;

		$docsFilePath = $this->web->download_pdf($request);

		$offer = Auth::user()->offer;

		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$contentBytes = file_get_contents($docsFilePath, false, stream_context_create($arrContextOptions));

		/* Create the document model */
		$document = new \DocuSign\eSign\Model\Document([
			'document_base64' => base64_encode($contentBytes),
			'name' => 'Purchase-Agreement-' . $offer->property->vms_property_id . '-' . $offer->id . '.pdf',
			'file_extension' => 'pdf',
			'document_id' => Auth::id(),
		]);

		/* Create the signer recipient model */
		$signer = new \DocuSign\eSign\Model\Signer([
			'email' => Auth::guard('accounts')->user()->email,
			'name' => $offer->buyer_name,
			'recipient_id' => Auth::id(),
			'routing_order' => '1',
			'client_user_id' => $args['signer_client_id'],
		]);

		/* Create a signHere tab (field on the document) */
		$signHere = new \DocuSign\eSign\Model\SignHere([
			'anchor_string' => '/sn1/',
			'anchor_units' => 'pixels',
			'anchor_y_offset' => '10',
			'anchor_x_offset' => '20',
		]);

		/* Create a signHere 2 tab (field on the document) */
		$signHere2 = new \DocuSign\eSign\Model\SignHere([
			'anchor_string' => '/sn2/',
			'anchor_units' => 'pixels',
			'anchor_y_offset' => '40',
			'anchor_x_offset' => '40',
		]);

		$signer->settabs(new \DocuSign\eSign\Model\Tabs(['sign_here_tabs' => [$signHere, $signHere2]]));

		$envelopeDefinition = new \DocuSign\eSign\Model\EnvelopeDefinition([
			'email_subject' => 'Purchase-Agreement-' . $offer->property->vms_property_id . '-' . $offer->id . '.pdf',
			'documents' => [$document],
			'recipients' => new \DocuSign\eSign\Model\Recipients(['signers' => [$signer]]),
			'status' => "sent",
		]);

		return $envelopeDefinition;
	}

	/**
	 * Write code on Method
	 *
	 * @return response()
	 */
	public function getEnvelopeApi(): EnvelopesApi{
		$this->config = new Configuration();
		$this->config->setHost($this->args['base_path']);
		$this->config->addDefaultHeader('Authorization', 'Bearer ' . $this->args['ds_access_token']);
		$this->apiClient = new ApiClient($this->config);

		return new EnvelopesApi($this->apiClient);
	}

	/**
	 * Write code on Method
	 *
	 * @return response()
	 */
	private function getTemplateArgs() {
		$args = [
			'account_id' => env('DOCUSIGN_ACCOUNT_ID'),
			'base_path' => env('DOCUSIGN_BASE_URL'),
			'ds_access_token' => Session::get('docusign_auth_code'),
			'envelope_args' => [
				'signer_client_id' => $this->signer_client_id,
				'ds_return_url' => route('docusign'),
			],
		];

		return $args;
	}
}