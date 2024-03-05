<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformBuyerHigherOffer extends Notification {
	use Queueable, Helper;

	protected $diff;
	protected $offer;
	protected $notify_user;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($offer, $diff, $notify_user) {
		$this->diff = $diff;
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
		foreach ($this->notify_user->devices as $device) {
			$fcmMsg = array(
				'title' => "Higher Offer Received",
				'description' => "This is a courtesy message, a higher offer has been received. Do you want to improve your bid by a " . $this->getSetting('currency') . number_format($this->diff) . " minimum",
				'vibrate' => 1,
				'action_id' => '',
				'diff' => $this->diff,
				'notification_type' => 'higher_offer_received',
			);

			$data = [
				'current_bid' => $this->offer->transaction->offer_price,
				'bid_per_feet' => $this->offer->transaction->offer_price / $this->offer->property->square_foot_rate,

			];

			$this->sendNotification($device->device_token, $device->device_type, $fcmMsg, $data);
		}
		return [
			'title' => "Higher Offer Received",
			'details' => "This is a courtesy message, a higher offer has been received. Do you want to improve your bid by a " . $this->getSetting('currency') . number_format($this->diff) . " minimum",
			'notification_type' => 'higher_offer_received',
			'action' => '',
		];
	}
}
