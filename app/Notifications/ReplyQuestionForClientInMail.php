<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyQuestionForClientInMail extends Notification
{
    use Queueable;

    protected $fatwas;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($fatwas)
    {
        $this->fatwas = $fatwas;
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
                        ->greeting(' , اهلا بك ' .$this->fatwas->name)
                        ->line('. لقد تم الرد على طلب الفتوى الخاص بك ')
                        ->line('. برجاء مراجعة قسم اسئلة واجوبة بالموقع ')
                        ->action('اضغط هنا', url('/'))
                        ->line('!شكرا لك لاستخدام موقعنا ');
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