<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    public function __construct(
        private MailerInterface $mailer
    )
    {
        
    }

    public function envoyerEmail(string $emailUtilisateur): void
    {
        $email = (new Email())
        ->from('gamehub@mail.com')
        ->to($emailUtilisateur)
        ->subject('Bienvenue au gameHub !')
        ->text('Bienvenue ! Votre compte de GameHub a été créé.');

        $this->mailer->send($email);
    }
}