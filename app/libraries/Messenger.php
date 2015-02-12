<?php

namespace Libraries;

class Messenger
{
    const INFO = 1;
    const WARNING = 2;
    
    protected $messages = [];
    
    public function info($message)
    {
        return $this->message(self::INFO, $message);
    }
    
    public function warning($message)
    {
        return $this->message(self::WARNING, $message);
    }
    
    public function message($level, $message)
    {
        $this->messages[] = ['level' => $level, 'message' => $message];
    }
    
    public function get()
    {
        return $this->messages;
    }
}