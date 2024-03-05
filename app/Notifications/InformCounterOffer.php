<?php

namespace App\Notifications;

use App\Models\CounterOffer;
use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformCounterOffer extends Notification {
	use Queueable, Helper;

	protected $data;
	protected $type;
	protected $notify_user;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($data, $type, $notify_user) {
		$this->data = $data;
		$this->type = $type;
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

	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {
		//$offer_data = DB::select("CALL GetOfferDetail('" . $this->data->offer_id . "')")[0];
		$multiple = $this->data->multiple_counter;

		if ($this->type == 'buyer') {
			$details = $this->data->offer->buyer_name . '(' . $this->data->offer->owner->phone_no . ')';
			$counter = CounterOffer::where('offer_id', $this->data->offer->id)->where('user_id', $this->data->offer->property->user_id)->first();

			if (isset($counter->id)) {
				$multiple = $counter->multiple_counter;
			}

		} else {
			$details = $this->data->user->name . '(' . $this->data->user->phone_no . ')';
		}

		foreach ($this->notify_user->devices as $device) {
			$fcmMsg = array(
				'title' => ucfirst($this->type) . " has counter offer for property - " . $this->data->offer->property->vms_property_id,
				'description' => "Counter offer by  - " . $details . ' Click here for more details.',
				'vibrate' => 1,
				'type' => $this->type,
				"date_time" => date("Y-m-d H:i:s"),
				'action_id' => $this->data->offer->id,
				'multiple_counter' => $multiple,
				'notification_type' => 'counter_offer',
			);

			$this->sendNotification($device->device_token, $device->device_type, $fcmMsg);
		}

		return [
			'title' => ucfirst($this->type) . " has counter offer for property - " . $this->data->offer->property->vms_property_id,
			'details' => "Counter offer by  - " . $details . ' Click here for more details.',
			'notification_type' => 'counter_offer',
			'action' => route("view-offer", ['id' => $this->data->offer->id]),
			'action_id' => $this->data->offer->id,
			'multiple_counter' => $multiple,
		];
	}
}
