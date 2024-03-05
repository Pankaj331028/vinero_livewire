<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NoSaleAlert extends Notification {
	use Queueable, Helper;

	protected $vms_property;
	protected $user;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($vms_property, $user) {
		$this->vms_property = $vms_property;
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

		$title = "No Sale - " . $this->vms_property->vms_property_id;
		$description = "Despite our best efforts, your property " . $this->vms_property->vms_property_id . " remains unsold. Still interested in selling this property? Relist it again to avail more offers.";

		foreach ($this->user->devices as $device) {
			$fcmMsg = array(
				'title' => $title,
				'description' => $description,
				'vibrate' => 1,
				"date_time" => date("Y-m-d H:i:s"),
				'action_id' => $this->vms_property->vms_property_id,
				'notification_type' => 'no_sale',
			);

			$this->sendNotification($device->device_token, $device->device_type, $fcmMsg);
		}

		return [
			'title' => $title,
			'details' => $description,
			'notification_type' => 'no_sale',
			'action' => route("view-property", ['id' => $this->vms_property->id]),
			'action_id' => $this->vms_property->vms_property_id,
		];
	}
}
