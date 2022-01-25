<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnswerQuestionForClientNotify extends Notification implements ShouldQueue, ShouldBroadcast
{
    use Queueable;
    protected $fatwa;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($fatwa)
    {
        $this->fatwa = $fatwa;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database' , 'broadcast'];

       
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'id'                => $this->fatwa->id,
            'name'              => $this->fatwa->name,
            'email'             => $this->fatwa->email,
            'message'           => $this->fatwa->message,
            // 'client_id'         => $this->fatwa->client_id,
            'created_at'        => $this->fatwa->created_at->format('d M, Y '),
        ];
    }


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data'=> [
                'id'                => $this->fatwa->id,
                'name'              => $this->fatwa->name,
                'email'             => $this->fatwa->email,
                'message'           => $this->fatwa->message,
                // 'client_id'         => $this->fatwa->client_id,
                'created_at'        => $this->fatwa->created_at->format('d M, Y '),
            ]
       
           
        ]);
    }
}