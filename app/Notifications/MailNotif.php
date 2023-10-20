<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Events\CommentEvent;

class MailNotif extends Notification
{
    use Queueable;

    private CommentEvent $event;

    /**
     * Create a new notification instance.
     */
    public function __construct(CommentEvent $event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Hey !')
                    ->line('tu viens de recevoir un commentaire sur ton post ' . $this->event->post->title)
                    ->line($this->event->comment->user->name . ' t\'a répondu : ' . $this->event->comment->content)
                    ->salutation('Passe lui le bonjour sur ton post !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
