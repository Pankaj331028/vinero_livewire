<?php

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

//cron jobs
use App\Models\UserDevice;

Route::get('expire-otp', 'CronJobController@otptimeLimit');
Route::get('notify-incomplete-offer', 'CronJobController@incompleteOffer');
Route::get('highest-bid', 'CronJobController@highestBidAlert');
Route::get('no-sale', 'CronJobController@notifyNoSale');

Route::get('/clear-cache', function () {
	Artisan::call('config:clear');
	Artisan::call('view:clear');
	Artisan::call('route:clear');
	Artisan::call('cache:clear');
});

Route::get('/', 'WebsiteController@index')->name('web');
//faq
Route::get('faq', 'WebsiteController@faq')->name('web-faq');
// web seller
Route::get('seller', 'WebsiteController@seller')->name('web-seller');
//web buyer
Route::get('buyer', 'WebsiteController@buyer')->name('web-buyer');
//web contact-us
Route::get('contact-us', 'WebsiteController@contactus')->name('web-contact-us');
//web resources
Route::get('resource', 'WebsiteController@resources')->name('web-resources');
// User Agreement
Route::get('user-agreement', 'WebsiteController@userAgreement')->name('user-agreement');
Route::get('agreement', 'WebsiteController@agreement')->name('agreement');
//Buyer Advisory
Route::get('buyer-advisory', 'WebsiteController@buyerAdvisory')->name('buyer-advisory');
//Privacy Policy
Route::get('privacy-policy', 'WebsiteController@privacyPolicy')->name('privacy-policy');

//craete Account
Route::get('create-account', 'WebsiteController@createAccount')->name('create-account');
//sign in
Route::get('login', 'WebsiteController@login')->name('weblogin');
// forget Password
Route::get('forgot-password', 'WebsiteController@forgotPassword')->name('forgot-password');

//google login
Route::get('auth/google', 'WebsiteController@redirectToGoogle')->name('auth.google');
Route::get('auth/google/callback', 'WebsiteController@handleGoogleCallback');

//facebook login
Route::get('auth/facebook', 'WebsiteController@redirectToFacebook')->name('auth.facebook');
Route::get('auth/facebook/callback', 'WebsiteController@handleFacebookCallback');

//apple login
Route::get('/apple-login', 'WebsiteController@appleLogin')->name('auth.apple');
Route::post('/apple-callback', 'WebsiteController@appleCallback');

//email confirmation when user social media login without eamil
Route::get('/email-confirmation', 'WebsiteController@emailConfirmation')->name('email-confirmation');

Route::middleware(['loginAuth:accounts', 'preventBack', 'web'])->group(function () {

	Route::get('add-property', 'WebsiteController@property_index')->name('property');
	Route::get('logout', function () {

		if (auth()->guard('web')->user()) {
			$user = auth()->guard('web')->user();
			UserDevice::where([
				'user_id' => $user->id,
				'device_type' => 'pc/laptop',
				'device_token' => Session::get('current_token'),
				'status' => 'AC',
			])->update(['status' => 'DL']);
		}

		Auth::guard('web')->logout();
		Auth::guard('accounts')->logout();
		return redirect()->route('weblogin');
	})->name('weblogout');

});

Route::middleware(['loginAuth', 'preventBack', 'web'])->group(function () {

	Route::get('offer', 'WebsiteController@offer')->name('offer');
	Route::get('my-offer', 'WebsiteController@offer')->name('my-offer');
	Route::get('seller-dashboard', 'WebsiteController@seller_dashboard')->name('seller-dashboard');
	Route::get('buyer-dashboard', 'WebsiteController@buyer_dashboard')->name('buyer-dashboard');
	Route::get('offers', function () {
		return view('web.seller_offers');
	})->name('offers');
	Route::get('offer-detail/{id}', function ($id) {
		return view('web.seller_offers', compact('id'));
	})->name('offer-detail');
	Route::get('offer-status/{status}/{id}', 'WebsiteController@updateOfferStatus')->name('update-offer-status');
	Route::get('notify-offerIntrest/{id}', 'WebsiteController@notifyOfferInterest')->name('notifyOfferInterest');
	Route::get('user-key', 'WebsiteController@userDeviceKey');
	Route::get('download-pdf', 'WebsiteController@download_pdf')->name('download-pdf');
	Route::get('bid-modification', 'WebsiteController@bid_modification')->name('bid-modification');
	Route::get('control-monitor', 'WebsiteController@buyerAgentMode')->name('control-monitor');
	Route::get('offer-of-interest', 'WebsiteController@offerOfInterest')->name('offer-of-interest');

	Route::get('incomplete-offer', 'WebsiteController@buyerIncompleteOffer')->name('buyer-incomplete-offer');
	Route::get('offer-cancellation', 'WebsiteController@buyerOfferCancellation')->name('buyer-offer-cancellation');
	Route::get('view-seller-counter', 'WebsiteController@buyerViewSellersCounter')->name('buyer-view-sellers-counter');
	Route::get('counter-offer/{id}', function ($id) {
		return view('web.seller-counter-offer', compact('id'));
	})->name('counter-offer');
	Route::get('counter-to-counter', 'WebsiteController@CounterToCounter')->name('counter-to-counter');
	Route::get('higher-offer-received', 'WebsiteController@higherOfferReceived')->name('higher-offer-received');
	Route::get('offer-not-approved', 'WebsiteController@offerNotAccepted')->name('offer-not-accepted');
	Route::get('offer-deadline-extension', 'WebsiteController@offerDeadlineExtension')->name('offer-deadline-extension');
	Route::get('update-credentials', 'WebsiteController@updateCredentials')->name('update-credentials');
	Route::get('survey', 'WebsiteController@survey')->name('buyer-survey');
	Route::get('congratulations', 'WebsiteController@congratulations')->name('congratulations');
	Route::get('bid-final-best', 'WebsiteController@bidFinalBest')->name('bid-final-best');
	// web notification
	Route::post('/store-token', 'WebNotificationController@storeToken')->name('store.token');

	Route::get('docusign', 'DocusignController@index')->name('docusign');
	Route::get('connect-docusign', 'DocusignController@connectDocusign')->name('connect.docusign');
	Route::get('docusign/callback', 'DocusignController@callback')->name('docusign.callback');
	Route::get('sign-document', 'DocusignController@signDocument')->name('docusign.sign');
});
