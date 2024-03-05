<?php

namespace App\Notifications;

use App\Traits\Helper;
use App\Traits\MailSubject;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformNewAccount extends Notification {
	use Queueable, Helper, MailSubject;

	protected $user;
	protected $pwd;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($user, $pwd) {
		$this->user = $user;
		$this->pwd = $pwd;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable) {
		return ['database', 'mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {

		return (new MailMessage)->subject($this->getSubject('new_account'))->view(
			'emails.new_account', ['admin' => $this->user, 'pwd' => $this->pwd]
		);
	}

	public function toDatabase() {
		return [
			'title' => 'New Subadmin Account',
			'details' => 'Admin has created a new account with email: ' . $this->user->email,
			'sender_id' => auth()->guard('admin')->user()->id,
			'type' => 'new_account',
		];
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {
		return [
			//
		];
	}
}
