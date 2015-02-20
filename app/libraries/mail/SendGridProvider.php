<?php

namespace Libraries\Mail;

class SendGridProvider implements PhpMailProvider
{
    const URL       = 'https://api.sendgrid.com/';
    const USER      = 'USERNAME';
    const PASSWORD  = 'PASSWORD';
    
    public function send(MailBuilder $mail)
    {

        $params = array(
            'api_user'  => self::USER,
            'api_key'   => self::PASSWORD,
            'to'        => 'example3@sendgrid.com',
            'subject'   => 'testing from curl',
            'html'      => 'testing body',
            'text'      => 'testing body',
            'from'      => 'example@sendgrid.com',
          );


        $request =  self::URL.'api/mail.send.json';

        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        curl_setopt ($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        // Tell PHP not to use SSLv3 (instead opting for TLS)
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // obtain response
        $response = curl_exec($session);
        curl_close($session);
    }
}