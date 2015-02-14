<?php

namespace Libraries;

class Mail
{   
    protected $from         = [];
    protected $cc           = [];
    protected $bcc          = [];
    protected $to           = [];
    protected $replyTo      = false;
    protected $headers      = [];
    protected $attachments  = [];
    protected $subject;
    protected $message;
    
    public function to($email, $name = null)
    {
        $this->addAddress($this->to, $email, $name);
    }
    
    public function from($email, $name = null)
    {
        $this->from = [];
        $this->addAddress($this->from, $email, $name);
    }
    
    public function cc($email, $name = null)
    {
        $this->addAddress($this->cc, $email, $name);
    }
    
    public function bcc($email, $name = null)
    {
        $this->addAddress($this->bcc, $email, $name);
    }
    
    public function replyTo($email)
    {
        $this->replyTo = $email;
    }
    
    protected function addAddress(array &$array, $email, $name)
    {
        if (is_null($name)) {
            $array[] = ['mail' => $email];
        } else {
            $array[] = ['address' => $email, 'name' => $name];
        }
    }
    
    public function subject($subject)
    {
        $this->subject = $subject;
    }
    
    public function message($message)
    {
        $this->message = $message;
    }
    
    public function attachment($file)
    {
        $this->attachments[] = $file;
    }
    
    public function send()
    {
        
        $to = $this->buildAddress($this->to);
        
        if (count($this->from) > 0) {
            $this->headers['from'] = 'From: ' . $this->buildAddress($this->from);   
        }
        if (count($this->cc) > 0) {
            $this->headers['cc']    = 'Cc: ' . $this->buildAddress($this->cc);
        }
        if (count($this->bcc) > 0) {
            $this->headers['bcc']   = 'Bcc: ' . $this->buildAddress($this->bcc);
        }
        if ($this->replyTo !== false) {
            $this->headers['replyto'] = 'Reply-To: ' . $this->replyTo;
        }
        
        // php mail function
        if (count($this->headers) > 0) {
            $headers = join("\r\n", $this->headers);
        } else {
            $headers = '';
        }
        
        return mail($to, $this->subject, $this->message, $headers);   
    }
    
    protected function buildAddress(array $addressList)
    {
        $addresses = [];
        
        foreach($addressList as $address) {
            
            if (isset($address['name'])) {
                $addresses[] = $address['name'] . '<' . $address['address'] . '>';
            } else {   
                $addresses[] = $address['address'];
            }
        }
        
        return join(',', $addresses);
    }
}