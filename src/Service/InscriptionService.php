<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    public function __construct(
        private MailerInterface $mailer
    ){

    }

    // envoyer mail avec lien de confirmation
    public function envoyerEmailConfirmation(
        string $destinataire,
        string $urlConfirmation
    ): void
    {
    $email = (new Email())
        ->from('gamehub@exemple.com')
        ->to($destinataire)
        ->subject('Confirmez votre adresse mail')
        ->html(
            '<h1>Bienvenue au gamehub</h1>
            <p>Pour activer votre compte, cliquez sur le lien :</p>
            <p><a href="' . htmlspecialchars($urlConfirmation, ENT_QUOTES, 'UTF-8') . '">Confirmer mon </a></p>'            
        );
        $this->mailer->send($email);
    }
}