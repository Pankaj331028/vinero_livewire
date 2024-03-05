<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformOfferClosed extends Notification {
	use Queueable, Helper;

	protected $property_id;
	protected $notify_user;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($property_id, $notify_user) {
		$this->property_id = $property_id;
		$this->notify_user = $notify_user;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable) {
		return ['database'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {
		//
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {
		foreach ($this->notify_user->devices as $device) {
			$fcmMsg = array(
				'title' => "Different Offer Accepted",
				'description' => "Thank you for your offer, an offer was received with terms agreed and accepted by the Seller, the property is now in contract. we enjoyed working with you.",
				'vibrate' => 1,
				"date_time" => date("Y-m-d H:i:s"),
				'action_id' => 0,
				'notification_type' => 'sold_out',
			);
			$this->sendNotification($device->device_token, $device->device_type, $fcmMsg);
		}

		return [
			'title' => "Different Offer Accepted",
			'details' => "Thank you for your offer, an offer was received with terms agreed and accepted by the Seller, the property is now in contract. we enjoyed working with you.",
			'notification_type' => 'sold_out',
			'action' => '',
			'action_id' => 0,
		];
	}
}
