<?php

namespace App\Notifications;

use App\Traits\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformBuyerOfferInterest extends Notification
{
    use Queueable, Helper;

    protected $user;
    protected $notify_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $notify_user)
    {
        $this->user = $user;
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
                'title' => "Offer of interest",
                'description' => "Seller wants to communicate regarding the offer. Select your suitable preference & time for the communication.",
                'vibrate' => 1,
                "date_time" => date("Y-m-d H:i:s"),
                'action_id' => 0,
                'notification_type' => 'offer_interest',
            );
            $this->sendNotification($device->device_token, $device->device_type ,$fcmMsg);
        }

        return [
            'title' => "Offer of interest",
            'details' => "Seller wants to communicate regarding the offer. Select your suitable preference & time for the communication.",
            'notification_type' => 'offer_interest',
            'action' => '',
            'action_id' => 0,
        ];
    }
}
