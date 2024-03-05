<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformSellerNewOffer extends Notification {
	use Queueable, Helper;

	public $offer;
	public $user;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($offer, $user) {
		$this->offer = $offer;
		$this->user = $user;
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
		return (new MailMessage)->subject('New offer received')->view(
			'emails.new_offer', ['data' => $this->offer]
		);
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {
		$title = "New offer received";
		$description = "New offer received from buyer - " . $this->offer->buyer_name . '(' . $this->offer->owner->phone_no . ')';

		foreach ($this->user->devices as $device) {
			$fcmMsg = array(
				'title' => $title,
				'description' => $description,
				'vibrate' => 1,
				"date_time" => date("Y-m-d H:i:s"),
				'action_id' => $this->offer->id,
				'notification_type' => 'seller_new_offer',
			);

			$this->sendNotification($device->device_token, $device->device_type, $fcmMsg);
		}

		return [
			'title' => $title,
			'details' => $description,
			'notification_type' => 'seller_new_offer',
			'action' => route("view-offer", ['id' => $this->offer->property_id]),
			'action_id' => $this->offer->id,
		];
	}
}
