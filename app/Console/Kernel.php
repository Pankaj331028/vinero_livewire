<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		//
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule) {
		$schedule->call('App\Http\Controllers\CronJobController@incompleteOffer')->everyFiveMinutes();
		$schedule->call('App\Http\Controllers\CronJobController@highestBidAlert')->everyMinute();
		$schedule->call('App\Http\Controllers\CronJobController@notifyNoSale')->everyMinute();
		$schedule->call('App\Http\Controllers\CronJobController@movePropertyToFarm')->everyMinute();
		$schedule->call('App\Http\Controllers\CronJobController@otptimeLimit')->everyMinute();
	}

	/**
	 * Register the commands for the application.
	 *
	 * @return void
	 */
	protected function commands() {
		$this->load(__DIR__ . '/Commands');

		require base_path('routes/console.php');
	}
}
