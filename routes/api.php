<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('login', 'ApiController@login'); //done
Route::post('verify-otp', 'ApiController@verifyOtp'); // done
// Route::post('resend-otp', 'ApiController@resendOtp');
Route::get('send-notification', 'ApiController@notify');
Route::get('update-license', 'ApiController@updateLicense');

Route::middleware('auth:api')->group(function () {
	Route::post('get-content', 'ApiController@getContent'); // done
	Route::get('get-survey-data', 'ApiController@surveyType'); // done
	Route::post('submit-survey', '\App\Http\Controllers\Api\Buyer\ApiController@submitSurvey');
	Route::post('logout', 'ApiController@logout'); // done
	Route::get('get-monitoring-details', 'ApiController@getMonitoringDetails'); // done
});

Route::group(['namespace' => 'Buyer', 'prefix' => 'buyer'], function () {

	Route::middleware('auth:api')->group(function () {
		Route::get('view-offer', 'ApiController@viewOffer');
		Route::get('get-offer-details', 'ApiController@offerDetails');
		Route::post('submit-offer', 'ApiController@submitOffer');
		Route::post('submit-financial-credentials', 'ApiController@submitFinancialCredentials');
		Route::post('update-offer-status', 'ApiController@updateOfferStatus');
		Route::post('optin-out', 'ApiController@optinOut');
		Route::post('cancel-offer', 'ApiController@cancelOffer');
		Route::post('offer-interest', 'ApiController@offerInterest');
		Route::get('offer-acceptance', 'ApiController@offerAcceptance');
		Route::get('counter-details', 'ApiController@counterDetails');
		Route::post('counter-offer', 'ApiController@counterOfferUpdate');
		Route::post('submit-signature', 'ApiController@submitSignature');
		Route::post('review', 'ApiController@review');
		Route::post('has-agent', 'ApiController@hasAgent');
		Route::post('get-offer-steps', 'ApiController@offerSteps');

		/* Offer individual steps*/
		Route::post('submitOffer-Step1', 'ApiController@addOfferStep1');
		Route::post('submitOffer-Step2', 'ApiController@addOfferStep2');
		Route::post('submitOffer-Step3', 'ApiController@addOfferStep3');
		Route::post('submitOffer-Step4', 'ApiController@addOfferStep4');
		Route::post('submitOffer-Step5', 'ApiController@addOfferStep5');
		Route::post('submitOffer-Step6', 'ApiController@addOfferStep6');
		Route::post('submitOffer-Step7', 'ApiController@addOfferStep7');
		Route::post('submitOffer-Step8', 'ApiController@addOfferStep8');
	});
});

Route::group(['namespace' => 'Seller', 'prefix' => 'seller'], function () {
	Route::post('generate-property-code', 'ApiController@generateCode');
	Route::post('add-property', 'ApiController@addProperty');

	Route::middleware('auth:api')->group(function () {
		Route::post('dashboard', 'ApiController@dashboard');
		Route::post('view-property', 'ApiController@viewProperty');
		Route::post('update-property', 'ApiController@updateProperty');
		Route::get('view-offer', 'ApiController@viewOffer');
		Route::post('update-offer-status', 'ApiController@updateOfferStatus');
		Route::post('optin-out', 'ApiController@optinOut');
		Route::post('counter-offer', 'ApiController@counterOfferUpdate');
		Route::post('offer-interest', 'ApiController@offerInterest');
		Route::post('notify-offer-interest', 'ApiController@notifyOfferInterest');
	});
});

Route::group(['namespace' => 'Buyer', 'prefix' => 'buyer-agent'], function () {
	Route::middleware('auth:api')->group(function () {
		Route::get('view-offer', 'ApiController@viewOffer');
		Route::post('dashboard', 'ApiController@dashboard');
		Route::post('view-property', 'ApiController@viewProperty');
		Route::get('get-offer-details', 'ApiController@offerDetails');
		Route::post('submit-offer', 'ApiController@submitOffer');
		Route::post('submit-financial-credentials', 'ApiController@submitFinancialCredentials');
		Route::post('update-offer-status', 'ApiController@updateOfferStatus');
		Route::post('cancel-offer', 'ApiController@cancelOffer');
		Route::get('offer-acceptance', 'ApiController@offerAcceptance');
		Route::get('counter-details', 'ApiController@counterDetails');
		Route::post('counter-offer', 'ApiController@counterOfferUpdate');
		Route::post('update-signature', 'ApiController@updateSignature');
		Route::post('get-offer-steps', 'ApiController@offerSteps');
	});
});

Route::group(['namespace' => 'Seller', 'prefix' => 'seller-agent'], function () {
	Route::middleware('auth:api')->group(function () {
		Route::post('dashboard', 'ApiController@dashboard');
		Route::post('view-property', 'ApiController@viewProperty');
		Route::post('update-property', 'ApiController@updateProperty');
		Route::get('view-offer', 'ApiController@viewOffer');
		Route::post('update-offer-status', 'ApiController@updateOfferStatus');
		Route::post('counter-offer', 'ApiController@counterOfferUpdate');
		Route::post('offer-interest', 'ApiController@offerInterest');
		Route::post('notify-offer-interest', 'ApiController@notifyOfferInterest');
	});
});