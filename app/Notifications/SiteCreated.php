<?php

namespace App\Notifications;

use App\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SiteCreated extends Notification
{
    use Queueable;
    /**
     * @var Site
     */
    private $site;

    /**
     * Create a new notification instance.
     *
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
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
                    ->line('The following site has been created:')
                    ->action($this->site->subdomain . '.cloudstage.me', 'http://' . $this->site->subdomain . '.cloudstage.me')
                    ->line('By user ' . $this->site->user->email);
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
