<?php
namespace App\Mail;

use App\Entity\Newsletter;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class NewsletterSubscribedConfirmation
{

    public function __construct(private MailerInterface $mailer, private string $adminEmail)
    {
    }


    public function send(Newsletter $newsletter)
    {
        $email = (new Email())->from($this->adminEmail)
            ->to($newsletter->getEmail())
            ->subject("Inscription à la newsletter")
            ->text("Votre email " . $newsletter->getEmail() . " a bien été enregistré, merci");

        $this->mailer->send($email);
    }
}