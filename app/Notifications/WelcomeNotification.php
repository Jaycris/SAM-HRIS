<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class WelcomeNotification extends Notification
{
    use Queueable;

    protected $validUntil;

    /**
     * Create a new notification instance.
     */
    public function __construct($validUntil)
    {
        $this->validUntil = $validUntil;
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
        $actionUrl = URL::temporarySignedRoute(
            'set-password', $this->validUntil, ['user' => $notifiable->id]
        );
        
        return (new MailMessage)
                    ->subject('Welcome to SAM PHREMS!')
                    ->greeting('Greetings!')
                    ->line('Welcome to SAM PHREMS (Payroll, HR, and Employee Management System). We are excited to have you on our team.')
                    ->line('You are receiving this email because an account has been created to grant you access to the SAM PHREMS.')
                    ->line('Please click the button below to set your password.')
                    ->action('Set Password', $actionUrl)
                    ->line('Thank you!')
                    ->salutation('Regards,  ' . PHP_EOL . 'SAM PHREMS Team');
                    
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
