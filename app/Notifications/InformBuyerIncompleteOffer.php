<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformBuyerIncompleteOffer extends Notification {
	use Queueable, Helper;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	protected $offer;
	protected $revision_count;
	protected $incomplete;
	protected $user;

	public function __construct($offer, $revision_count, $incomplete = '', $user) {
		$this->offer = $offer;
		$this->revision_count = $revision_count;
		$this->incomplete = $incomplete;
		$this->user = $user;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable) {
		return ['mail', 'database'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {
		return (new MailMessage)->subject('Incomplete Offer')->view(
			'emails.incomplete_offer', ['data' => $this->offer, 'revision_count' => $this->revision_count, 'incomplete' => $this->incomplete]
		);
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
				'title' => "Incomplete Offer",
				'description' => "Incomplete offer - " . $this->offer->property->vms_property_id,
				'vibrate' => 1,
				"date_time" => date("Y-m-d H:i:s"),
				'action_id' => '',
				// 'revision' => $this->revision_count,
				'notification_type' => 'incomplete_offer',
				'incomplete' => $this->incomplete,
			);

			$this->sendNotification($device->device_token, $device->device_type, $fcmMsg);
		}

		return [
			'title' => "Incomplete Offer",
			'details' => "Incomplete offer - " . $this->offer->property->vms_property_id,
			'notification_type' => 'incomplete_offer',
			'action' => '',
			// 'revision' => $this->revision_count,
			'action_id' => $this->offer->property->vms_property_id,
			'incomplete' => $this->incomplete,
		];
	}
}
