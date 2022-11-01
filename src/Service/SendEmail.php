<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use App\Controller\AbstractController;
use Symfony\Component\Mailer\Transport;

class SendEmail extends AbstractController
{
    /** @phpstan-ignore-next-line */
    public function sendEmail($from, $to, $subject, $datas, $twigFile, $data1 = null)
    {

        $transport = Transport::fromDsn(MAILER_DNS);
        $mailer = new Mailer($transport);
        $html = $this->twig->render('Email/' . $twigFile . '.html.twig', [
            "data" => $datas,
            'data1' => $data1
        ]);
        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->html($html);
        $mailer->send($email);
    }
}
