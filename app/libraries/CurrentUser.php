<?php

namespace Libraries;
use Models\User;

class CurrentUser
{
    const GUEST_ID = 0;
    
    protected $rights = [];
    
    protected static $self;
    
    public function __construct()
    {
        $this->update();        
    }
    
    protected function update()
    {
        $this->rights   = [];
        $user_id        = $this->getId();
        $this->register($user_id);
    }
    
    public function getId()
    {
        $user_id = self::GUEST_ID;
        
        if (isset($_SESSION['uid'])) {
            $user_id = (int) $_SESSION['uid'];
        }
        
        return $user_id;
    }
    
    public function isGuest()
    {
        return $this->getId() == self::GUEST_ID;
    }
    
    protected function register($user_id)
    {
        $model  = new User();
        
        if ($this->isGuest()) {
            $rights = $model->getRightsByGroup(self::GUEST_ID);
        } else {
            $rights = $model->getRights($user_id);
        }
        
        // format rights for fast access
        $formatRights = [];
        foreach ($rights as $right) {
            $formatRights[$right['permission']][] = $right['category_id'];
        }
        
        $this->rights = $formatRights;
    }
    
    public function can($action, $category_id = null)
    {   
        if (isset($this->rights[$action])) {
            
            if (in_array(null, $this->rights[$action])) { return true; }
            
            return in_array($category_id, $this->rights[$action]);
            
        }
        
        return false;
    }
    
    public function rights($action = null)
    {
        if (is_null($action)) {
            return $this->rights;
        } else {
            if (isset($this->rights[$action])) {
                return $this->rights[$action];
            } else {
                return [];
            }
        }
    }
}