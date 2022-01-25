<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriberBookNotification extends Notification
{
    use Queueable;
    protected $book;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($book)
    {
        $this->book=$book; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('there is new in the website.')
                    ->greeting('Hello, Subscriber')
                    ->line('There is a new book that has been published. We hope you will like it.')
                    ->line('book Title : '.$this->book->name)
                    ->action('Click Here', url('/'))
                    ->line('Thank you for using our website!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}