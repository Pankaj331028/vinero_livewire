<?php

namespace App\Providers;

use Validator;
use App\Traits\Helper;
use App\Models\Cms;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use Helper;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
      
		$pages = Cms::whereNull('parent_id')->whereStatus('AC')->pluck('title', 'slug');
	
        Validator::extend('mod1000', function ($attribute, $value, $parameters, $validator) {
            $val = $value* 1000 / $parameters[0];

            if(is_numeric( $val ) && floor( $val ) != $val)
            {
                return false;
            }else{
                return true;
            }
        });

        $new_offers = Notification::whereJsonContains('data->notification_type', 'new_offer')->where('read_at', '=', null)->count(); //new offer submitted by buyer
        $vms_open = Notification::whereJsonContains('data->notification_type', 'new_property')->where('read_at', '=', null)->count(); //new property submitted by buyer
        $improved_offers = Notification::whereJsonContains('data->notification_type', 'offer_improve')->where('read_at', '=', null)->count();
        $total_notification = $new_offers + $vms_open + $improved_offers;
        $new_offer = Notification::whereJsonContains('data->notification_type', 'new_offer')->where('read_at', '=', null)->get(); //new offer submitted by buyer
        $new_property = Notification::whereJsonContains('data->notification_type', 'new_property')->where('read_at', '=', null)->get(); //new property submitted by buyer
        $new_offer_improve = Notification::whereJsonContains('data->notification_type', 'offer_improve')->where('read_at', '=', null)->get();
        view()->composer('*', function ($view) use ($request) {
            $view->with(['currency' => $this->getSetting('currency')]);
        });
        View::share('pages', $pages);
        View::share('total_notification', $total_notification);
        View::share('new_offer', $new_offer);
        View::share('new_property', $new_property);
        View::share('new_offer_improve', $new_offer_improve);

    }
}
