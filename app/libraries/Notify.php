<?php

namespace Libraries;

class Notify
{
    const INFO = 1;
    const WARNING = 2;
    
    protected $messages = [];
    
    public function __construct()
    {
        // add messages from query-string if any
        if (isset($_GET['message'])) {
            $this->messages = filter_input(INPUT_GET, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }
    
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
    
    public function messages(array $messages)
    {
        $this->messages = array_merge($this->messages, $messages);
    }
    
    public function get()
    {
        return $this->messages;
    }
}