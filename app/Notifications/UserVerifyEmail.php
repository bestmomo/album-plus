<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;

class UserVerifyEmail extends VerifyEmail
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject(__("Vérification d'adresse email"))
            ->line(__("Veuillez utiliser le bouton ci-dessous pour vérifier votre adresse email."))
            ->action(
                __("Vérification"),
                $this->verificationUrl($notifiable)
            )
            ->line(__("Si vous n'avez pas créé de compte aucune action supplémentaire n'est requise" ));
    }
}
