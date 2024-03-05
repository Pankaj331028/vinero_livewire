<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformBuyerOfferAcceptance extends Notification
{
    use Queueable, Helper;

    protected $offer;
    protected $notify_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($offer, $notify_user)
    {
        $this->data = $offer;
        $this->notify_user = $notify_user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        foreach($this->notify_user->devices as $device)
        {
            $fcmMsg = array(
                'title' => "Offer Accepted",
                'description' => "Congratulations! The seller - ".$this->data->property->seller->name." has accepted your offer, please fund escrow and be alert to comply with important contract dates",
                'vibrate' => 1,
                "date_time" => date("Y-m-d H:i:s"),
                'action_id' => $this->data->property->id,
                'notification_type' => 'in_contract',
            );

            $this->sendNotification($device->device_token, $device->device_type ,$fcmMsg);
        }

        return [
            'title' => "Offer Accepted",
            'details' => "Congratulations! The seller - ".$this->data->property->seller->name." has accepted your offer, please fund escrow and be alert to comply with important contract dates",
            'notification_type' => 'in_contract',
            'action' => route("view-offer", ['id' => $this->data->property->id]),
            'action_id' => $this->data->property->id,
        ];
    }
}
