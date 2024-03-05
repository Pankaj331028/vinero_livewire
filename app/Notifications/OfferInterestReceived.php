<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OfferInterestReceived extends Notification
{
    use Queueable, Helper;

    protected $data;
    protected $notify_user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $notify_user)
    {
        $this->data = $data;
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

        if($this->data['type'] == 'phone')
        {
            $message = "The buyer - ".$this->data['buyer_no']. " requested to be contacted between " .$this->data['time']. " via ".ucfirst($this->data['type']);
        }else{
            $message = "The buyer - ".$this->data['buyer_no']. " requested to be contacted via ".ucfirst($this->data['type']);
        }

        foreach($this->notify_user->devices as $device)
        {
            $fcmMsg = array(
                'title' => "Offer of interest received",
                'description' => $message,
                'vibrate' => 1,
                "date_time" => date("Y-m-d H:i:s"),
                'action_id' => 0,
                'notification_type' => 'offer_interest_received',
            );

            $this->sendNotification($device->device_token, $device->device_type ,$fcmMsg);
        }

        return [
            'title' => "Offer of interest received",
            'details' => $message,
            'notification_type' => 'offer_interest_received',
            'action' => '',
            'action_id' => 0,
        ];
    }
}
