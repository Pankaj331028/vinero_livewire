<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformAdminNewOffer extends Notification {
	protected $offer;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($offer) {
		$this->offer = $offer;
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
		return [
			'title' => $this->offer->property->vms_property_id . " - New offer received",
			'details' => "New offer received from buyer - " . $this->offer->buyer_name . '(' . $this->offer->owner->phone_no . ')',
			'notification_type' => 'new_offer',
			'action' => route("view-offer", ['id' => $this->offer->property_id]),
			'action_id' => $this->offer->id,
		];
	}
}
