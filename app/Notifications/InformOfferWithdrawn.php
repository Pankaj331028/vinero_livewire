<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformOfferWithdrawn extends Notification {
	use Queueable, Helper;

	protected $offer;
	protected $user;
	protected $type;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($offer, $user, $type) {
		$this->data = $offer;
		$this->user = $user;
		$this->type = $type;
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
		foreach ($this->user->devices as $device) {
			$fcmMsg = array(
				'title' => "Offer Withdrawn",
				'description' => "Your offer has been withdrawn by the " . ucfirst($this->type) . "! Please continue to bid on other properties you like.",
				'vibrate' => 1,
				"date_time" => date("Y-m-d H:i:s"),
				'action_id' => $this->data->id,
				'notification_type' => 'offer_withdrawn',
			);

			$this->sendNotification($device->device_token, $device->device_type, $fcmMsg);
		}

		return [
			'title' => "Offer Withdrawn",
			'description' => "Your offer has been withdrawn by the " . ucfirst($this->type) . "! Please continue to bid on other properties you like.",
			'notification_type' => 'offer_withdrawn',
			'action' => route("view-offer", ['id' => $this->data->id]),
			'action_id' => $this->data->id,
		];
	}
}
