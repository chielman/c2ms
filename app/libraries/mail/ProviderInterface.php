<?php
namespace Libraries\Mail;

interface ProviderInterface
{
    public function send(MailBuilder $mail);
}