<?php

namespace Libraries\Mail;

class MailBuilder
{
    const SENSITIVE_NORMAL      = 'Normal';
    const SENSITIVE_PERSONAL    = 'Personal';
    const SENSITIVE_PRIVATE     = 'Private';
    const SENSITIVE_COMPANY     = 'Company-Confidential';
    
    protected $subject;
    protected $from         = [];
    protected $to           = [];
    protected $cc           = [];
    protected $bcc          = [];
    protected $replyTo      = null;
    protected $attachments  = [];
    protected $html         = null;
    protected $text         = null;
    protected $sensitivity  = self::SENSITIVE_NORMAL;
    protected $returnPath   = null;
    
    public function setFrom($email, $name = null)
    {
        $this->from = compact('email', 'name');
        
        if (is_null($this->returnPath)) {
            $this->returnPath = $this->from;
        }
        
        return $this;
    }
    
    public function getFrom() { return $this->from; }
    
    public function setReturnPath($email)
    {
        $this->returnPath = $email;
    }
    
    public function getReturnPath() { return $this->returnPath; }
    
    public function addTo($email, $name = null)
    {
        $this->to[] = compact('email', 'name');
        return $this;
    }
    
    public function getTo() { return $this->to; }
    
    public function addCc($email, $name = null)
    {
        $this->cc[] = compact('email', 'name');
        return $this;
    }
    
    public function getCc() { return $this->cc; }
    
    public function addBcc($email, $name = null)
    {
        $this->bcc[] = compact('email', 'name');
        return $this;
    }
    
    public function getBcc() { return $this->bcc; }
    
    public function setReplyTo($email, $name = null)
    {
        $this->replyTo = compact('email', 'name');
        return $this;
    }
    
    public function getReplyTo() { return $this->replyTo; }
    
    public function setConfidential($attr)
    {
        $this->sensitivity = $attr;
    }
    
    public function getConfidential() { return $this->sensitivity; }
    
    public function setText($content)
    {
        
    }
    
    public function getText() { return $this->text; }
    
    public function setHtml($content)
    {
        
    }
    
    public function getHtml() { return $this->html; }
    
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }
    
    public function getSubject() { return $this->subject; }
    
    public function addAttachment($file)
    {
        $this->attachments[] = $file;
    }
    
    public function getAttachments() { return $this->attachments; }
}