<?php

namespace Libraries\Mail;

class PhpMailProvider implements ProviderInterface
{
    protected $headers = [];
    
    public function send(MailBuilder $mail)
    {
        $this->headers = [];
        
        $this->headers[] = 'X-Mailer: C2MS (PHP/' . phpversion() . ')';
        
        if (!is_null($mail->getFrom())) {
            $this->headers[] = 'From: ' . $this->formatAddress($mail->getFrom());
            $this->headers[] = 'Return-Path: ' . $this->formatAddress($mail->getReturnPath());
        }
        
        if (count($mail->getCc()) > 0) {
            $this->headers[] = 'Cc: ' . $this->formatAddresses($mail->getCc());
        }
        
        if (count($mail->getBcc()) > 0) {
            $this->headers[] = 'Bcc: ' . $this->formatAddresses($mail->getBcc());
        }
        
        if (!is_null($mail->getReplyTo())) {
            $this->headers[] = 'Reply-To: ' . $this->formatAddress($mail->getReplyTo());
        }
        
        if ($mail->getConfidential() != MailBuilder::SENSITIVE_NORMAL) {
            $this->headers[] = 'Sensitivity: ' . $mail->getConfidential();
        }
        
        $message = $this->generateMessage($mail);
        
        mail($mail->getTo(), $mail->getSubject(), $message, implode("\r\n" . $this->headers) );
    }
    
    protected function formatAddresses(array $addresses)
    {
        $list = [];
        
        foreach ($addresses as $address) {
            $list[] = $this->formatAddress($address);
        }
        
        return implode(',', $list);
    }
    
    protected function formatAddress(array $address)
    {
        if (isset($address['name'])) {
            return $address['name'] . '<' . $address['email'] . '>';
        } else {
            return $address['email'];
        }
    }
    
    protected function generateMessage(MailBuilder $mail)
    {
        $seperator = md5(time());
        $this->headers[] = 'MIME-Version: 1.0';
        $this->headers[] = "content-type: multipart/mixed; boundary=\"$seperator\"" . PHP_EOL;
        $this->headers[] = 'content-transfer-encoding: 7bit';
        $this->headers[] = 'This is a MIME encoded message.' . PHP_EOL;
        
        // add text
        $this->headers[] = 'content-type: text/plain; charset="iso-8859-1"';
        $this->headers[] = "content-Transfer-Encoding: 8bit\n";
        $this->headers[] = $mail->getText() . PHP_EOL;
        $this->headers[] = '--' . $seperator;
        
        // add html
        $this->headers[] = 'Content-Type: text/html; charset="iso-8859-1"';
        $this->headers[] = 'Content-Transfer-Encoding: 7bit';
        
        
        
        // add attachments
        foreach ($mail->getAttachments() as $attachment) {
            $this->attach($attachment, $seperator);
        }
    }
    
    protected function attach($filename, $seperator)
    {
        $file = $path . "/" . $filename;
        $file_size = filesize($file);
        $handle = fopen($file, "r");
        $content = fread($handle, $file_size);
        fclose($handle);
        $content = chunk_split(base64_encode($content));
        
        $this->headers[] = "content-type: application/octet-stream; name\"$filename\"";
        $this->headers[] = "content-transfer-encoding: base64";
        $this->headers[] = "content-disposition: attachment" . PHP_EOL;
        $this->headers[] = $content . PHP_EOL;
        $this->headers[] = "--" . $seperator;
    }
}