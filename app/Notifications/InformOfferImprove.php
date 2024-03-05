<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformOfferImprove extends Notification {
	use Queueable, Helper;

	protected $offer;
	protected $notify_user;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($offer, $notify_user) {
		$this->offer = $offer;
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
		if (isset($this->notify_user->devices)) {
			foreach ($this->notify_user->devices as $device) {
				$fcmMsg = array(
					'title' => $this->offer->property->vms_property_id . " - Offer price revised",
					'description' => "Offer price revised by buyer - " . $this->offer->buyer_name . '(' . $this->offer->owner->phone_no . ')',
					'vibrate' => 1,
					"date_time" => date("Y-m-d H:i:s"),
					'action_id' => $this->offer->id,
					'notification_type' => 'offer_improve',
				);
				$this->sendNotification($device->device_token, $device->device_type, $fcmMsg);
			}
		}

		return [
			'title' => $this->offer->property->vms_property_id . " - Offer price revised",
			'details' => "Offer price revised by buyer - " . $this->offer->buyer_name . '(' . $this->offer->owner->phone_no . ')',
			'notification_type' => 'offer_improve',
			'action' => route("view-offer", ['id' => $this->offer->id]),
			'action_id' => $this->offer->id,
		];
	}
}
