<?php
use App\Models\Cms;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/clear-cache', function () {
	Artisan::call('config:clear');
	Artisan::call('view:clear');
	Artisan::call('route:clear');
	Artisan::call('cache:clear');
});

Route::prefix('admin')->group(function () {
	Route::get('/', function () {
		if (Auth::guard('admin')->check()) {
			return redirect()->route('index');
		} else {
			return view('auth.login');
		}

	})->name('login');

	Route::get('forgot-password', function () {
		return view('auth.forgot');
	})->name('forgot');

	Route::middleware(['preventBack', 'web', 'is_admin'])->group(function () {

		Route::match(['get', 'post'], 'dashboard', 'ActionController@dashboard')->name('index');

		Route::get('change-password', function () {
			return view('admin.change-password');
		})->name('change-password');

		// for subadmins
		Route::get('accounts', 'AccountController@index')->name('accounts');
		Route::get('add-account', function () {
			return view('admin.accounts.add');
		})->name('add-account');
		Route::get('edit-account/{id}', function ($id) {
			return view('admin.accounts.edit', compact('id'));
		})->name('edit-account');
		Route::get('delete-account/{id}', 'AccountController@destroy')->name('delete-account');
		Route::get('view-account/{module}/{id}', 'AccountController@show')->name('view-account');
		Route::get('status-account/{id}', 'AccountController@status')->name('status-account');

		// for byuer
		Route::get('buyers{status?}', 'BuyerController@index')->name('buyer');
		Route::get('edit-buyer/{id}/{status}', 'BuyerController@edit')->name('edit-buyer');
		Route::get('delete-buyer/{id}', 'BuyerController@destroy')->name('delete-buyer');
		Route::post('update-buyer/{id}', 'BuyerController@update')->name('update-buyer');
		Route::get('view-buyer/{id}', 'BuyerController@show')->name('view-buyer');
		Route::get('buyer-offers/{id}', 'BuyerController@getOffers')->name('buyer-offers');

		Route::get('block-buyer/{id}', 'BuyerController@block')->name('block-buyer');
		Route::post('buyer-update-block/{id}', 'BuyerController@update_block')->name('buyer-update-block');

		Route::get('sellers{status?}', 'SellerController@index')->name('seller');
		Route::get('edit-seller/{id}/{status}', 'SellerController@edit')->name('edit-seller');
		Route::get('delete-seller/{id}', 'SellerController@destroy')->name('delete-seller');
		Route::post('update-seller/{id}', 'SellerController@update')->name('update-seller');
		Route::get('view-seller/{id}', 'SellerController@show')->name('view-seller');
		Route::get('get-properties/{id}', 'SellerController@getProperties')->name('get-properties');
		Route::get('block-seller/{id}', 'SellerController@block')->name('block-seller');
		Route::post('seller-update-block/{id}', 'SellerController@update_block')->name('seller-block-update');

		Route::get('agents{status?}', 'AgentController@index')->name('agent');
		Route::get('edit-agent/{id}', 'AgentController@edit')->name('edit-agent');
		Route::get('delete-agent/{id}', 'AgentController@destroy')->name('delete-agent');
		Route::post('update-agent/{id}', 'AgentController@update')->name('update-agent');
		Route::get('view-agent/{id}', 'AgentController@show')->name('view-agent');
		Route::get('block-agent/{id}', 'AgentController@block')->name('block-agent');
		Route::post('agent-update-block/{id}', 'AgentController@update_block')->name('agent-block-update');
		Route::get('agent-offers/{id}', 'AgentController@getOffers')->name('agent-offers');

		Route::get('reports', 'ReportController@index')->name('reports');
		//Route::get('notifications', 'NotificationController@index')->name('notifications');
		Route::get('notifications', 'NotificationController@new_index')->name('notifications');
		Route::get('show-notifications', 'NotificationController@show_notification')->name('show-notifications');
		Route::get('get-notifications/{type}', 'NotificationController@getNotifications')->name('get-notifications');
		Route::get('view_notification/{id}', 'NotificationController@readNotifications')->name('view_notification');

		Route::get('properties', 'PropertiesController@index')->name('properties');
		Route::get('create-properties', 'PropertiesController@create')->name('create-properties');
		Route::post('store-properties', 'PropertiesController@store')->name('store-properties');
		Route::get('edit-properties/{id}', 'PropertiesController@edit')->name('edit-properties');
		Route::get('delete-properties/{id}', 'PropertiesController@destroy')->name('delete-properties');
		Route::get('view-property/{id}', 'PropertiesController@show')->name('view-property');
		Route::post('change-status/{id}', 'PropertiesController@change_status')->name('change-status');

		Route::get('view-offers/{id}', 'OffersController@show')->name('view-offer');
		Route::get('offer-details/{id}', 'OffersController@offer_view')->name('offer-details');
		Route::post('update-document-status', 'OffersController@updateDocStatus')->name('update-document-status');
		Route::post('update-fc-status', 'OffersController@updateFcStatus')->name('update-fc-status');

		Route::get('settings', function () {
			return view('admin.settings');
		})->name('settings');

		// admin-resources
		Route::get('resource', 'ResourcesCountroller@index')->name('resource');
		Route::get('resource-add', 'ResourcesCountroller@create')->name('add-resource');
		Route::get('resource-edit/{id?}', 'ResourcesCountroller@edit')->name('edit-resource');
		Route::get('resource-view/{id?}', 'ResourcesCountroller@show')->name('view-resource');
		Route::get('delete-resource/{id?}', 'ResourcesCountroller@delete')->name('delete-resource');
		Route::get('inactive-resource/{id?}', 'ResourcesCountroller@inactive')->name('inactive-resource');
		Route::get('active-resource/{id?}', 'ResourcesCountroller@active')->name('active-resource');
		//end

		Route::get('survey', 'SurveyController@index')->name('survey');
		Route::get('view-survey/{id}', 'SurveyController@view')->name('view-survey');
		Route::post('update-status', 'ActionController@updateStatus')->name('updateStatus');

		Route::get('reports', 'ReportController@index')->name('reports');

		//FAQ-Route
		Route::get('faq', 'FaqController@index')->name('faq');
		Route::get('faq-add', 'FaqController@create')->name('add-faq');
		Route::post('faq-store', 'FaqController@store')->name('store-faq');
		Route::get('faq-edit/{id?}', 'FaqController@edit')->name('edit-faq');
		Route::post('faq-update/{id?}', 'FaqController@update')->name('faq-update');
		Route::get('delete-faq/{id?}', 'FaqController@delete')->name('delete-faq');
		Route::get('inactive-faq/{id?}', 'FaqController@inactive')->name('inactive-faq');
		Route::get('active-faq/{id?}', 'FaqController@active')->name('active-faq');
		
		//csm
		Route::get('Cms-Home-page', 'CmsController@index')->name('home');
		Route::get('/cmsAjax', ['uses' => 'CmsController@cmsAjax'])->name('cmsAjax');
		Route::get('/editCMS/{slug?}', ['uses' => 'CmsController@editCMS'])->name('editCMS');
		Route::get('/viewCMS/{slug?}', ['uses' => 'CmsController@viewCMS'])->name('viewCMS');
		Route::post('update-about-otoo', 'CmsController@update')->name('update-about');

		Route::get('view-about-otoo', 'CmsController@about_view')->name('about-view');

		// content pages
		Route::get('content-pages/edit/{slug}', function ($slug) {
			$cms = Cms::whereSlug($slug)->first();
			return view('admin.cms.edit', compact('cms'));
		})->name('pages.edit');
		
		// sellerservice
		Route::get('service-sell-edit/{id?}', 'SellerServiceController@edit')->name('edit-sellerservice');

		// buyerservice
		Route::get('buy-edit/{id?}', 'BuyerServiceController@edit')->name('edit-buyerservice');
		
		//Contact Us
		Route::get('contactus', 'ContactUsController@index')->name('contactus');

		Route::get('logout', function () {
			Auth::guard('admin')->logout();
			return redirect()->route('login');
		})->name('logout');
	});

});
