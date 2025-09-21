<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailToAdminAfterRegistrationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $code;
    public $email;
    public function __construct($code, $email)
    {
        $this->code = $code;
        $this->email = $email;
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
                    ->subject('Création de compte administrateur')
                    ->line('Bonjour')
                    ->line('Votre compte à été crée avec succès sur la plateforme de gestion de salaires et d\'employés')
                    ->line('cliquez sur le bouton ci-dessous pour valider votre compte')
                    ->line('Saisissez le code  '.$this->code.'  et renseigner le dans le formulaire qui apparaitra')
                    ->action('Cliquez ici', url('/validate-account'.'/' .$this->email))
                    ->line('Merci pour votre utilisation!');
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
