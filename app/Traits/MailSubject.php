<?php

namespace App\Traits;

trait MailSubject {

	public function getSubject($slug) {
		$data = [
			'forgot_password' => env('APP_NAME') . ' - Forgot Password',
			'new_login' => 'New Device Login',
			'new_account' => env('APP_NAME') . ' - New Subadmin Account',
		];

		return $data[$slug];
	}
	public function getDescription($slug) {
		$data = [
			'new_login' => 'You have logged into another device. Logging you out from this device',
		];

		return $data[$slug];
	}
}
