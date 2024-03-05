<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformBuyerDeadlineExtension extends Notification {
	use Queueable, Helper;

	protected $offer;
	protected $time;
	protected $notify_user;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($offer, $time, $notify_user) {
		$this->offer = $offer;
		$this->time = $time;
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
				'title' => "Offer deadline extended",
				'description' => "This is a courtesy message, Seller hereby extends offer deadline for additional " . $this->time . " Hours time",
				'vibrate' => 1,
				'action_id' => '',
				'time' => $this->time,
				'notification_type' => 'offer_deadline_extend',
			);

			$data = [
				'current_bid' => $this->offer->transaction->offer_price,
				'bid_per_feet' => sprintf('%0.2f', $this->offer->transaction->offer_price / $this->offer->property->square_foot_rate),
			];

			$this->sendNotification($device->device_token, $device->device_type, $fcmMsg, $data);
		}

		return [
			'title' => "Offer deadline extended",
			'details' => "This is a courtesy message, Seller hereby extends offer deadline for additional " . $this->time . " Hours time",
			'notification_type' => 'offer_deadline_extend',
			'action' => '',
		];
	}
}
