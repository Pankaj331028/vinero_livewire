<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HighestBidAlert extends Notification {
	use Queueable, Helper;

	protected $vms_property_id;
	protected $max_price;
	protected $offer;
	protected $user;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($vms_property_id, $max_price, $offer, $user) {
		$this->vms_property_id = $vms_property_id;
		$this->max_price = $max_price;
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
		//
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {

		$title = "Highest bid - " . $this->vms_property_id;
		$description = "Seller received multiple offers and kindly request you to submit your Highest and Best Offer";
		// dd($this->offer->owner->devices);
		// foreach ($this->offer->property->seller->devices as $device) {
		foreach ($this->user->devices as $device) {
			$fcmMsg = array(
				'title' => $title,
				'description' => $description,
				'vibrate' => 1,
				"date_time" => date("Y-m-d H:i:s"),
				'action_id' => $this->offer->id,
				'notification_type' => 'highest_bid',
			);

			$this->sendNotification($device->device_token, $device->device_type, $fcmMsg);
		}

		return [
			'title' => $title,
			'details' => $description,
			'notification_type' => 'highest_bid',
			'action' => route("view-offer", ['id' => $this->offer->property_id]),
			'action_id' => $this->offer->id,
		];
	}
}
