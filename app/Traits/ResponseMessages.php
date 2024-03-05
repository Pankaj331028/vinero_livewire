<?php

namespace App\Traits;

trait ResponseMessages {

	public function getMessage($code) {
		$data = [
			101 => 'Missing Parameters',
			102 => 'OTP sent to your mobile number. Please verify',
			103 => 'Incorrect OTP. Please input correct OTP',
			104 => 'Logged In Successfully',
			105 => 'You are logged out from the app.',

			200 => 'Success',
			201 => 'Property sent for verification',
			202 => 'Property already exist',
			203 => 'Property updated successfully',
			204 => 'Rights has been updated successfully',
			205 => 'Offer status updated successfully',
			206 => 'Offer withdrawn successfully',
			207 => 'Cannot extend offer deadline',
			208 => 'Survey submitted successfully',
			209 => 'Counter offer details sent successfully to buyer',
			210 => 'Counter offer details sent successfully to seller',
			211 => 'This agent is already associated with other buyer/seller for this property.',
			212 => 'All steps have been completed. The final submission of your offer is one step closer.',
			213 => 'Financial credentials have been submitted successfully.',
			214 => 'Thank you for submitting an offer. Our team will revert back soon.',
			215 => 'Offer price update successfully.',
			399 => 'No offer has been submitted',
			400 => 'User Not Found',
			401 => 'Account is not verified',
			403 => 'Access Forbidden',
			404 => 'Data Not Found',
			405 => 'Your account is blocked please contact to administrator',
			406 => "You haven't assigned any agent for this property.",
			407 => "You have reached at the end of Offer List",
			408 => "You must withdraw your current running offer in order to join a new property.",
			409 => 'You cannot bid on your own property',
			410 => 'This phone number is associated with this property as different user',
			411 => 'Please enter valid Property ID',
			412 => 'You have already withdrawn from this property',
			413 => 'This property is not yet active for sale',
			414 => 'Access Forbidden! Mobile number and Property are already linked with other account.',
			415 => 'We are unable to process your request. Please make sure you are on right track.',
			500 => 'Internal Server Error',
			501 => 'Something Went Wrong',
			502 => 'Your account is not activated. Please contact administrator',
		];

		return $data[$code];
	}
}
