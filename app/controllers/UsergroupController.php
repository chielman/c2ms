<?php

namespace Controllers;

use Libraries\Router;
use Models\Usergroup;

class UsergroupController extends BaseController
{
    protected $model;
    
    public function __construct(Router $route) {
        parent::__construct($route);
        
        $this->model = new Usergroup();
    }
    
    public function getIndex()
    {
        $groups = $this->model->all();
        
        if ($groups === false) { $this->abort(); }
        
        // fetch permissions for all groups
        $permissions = $this->model->getPermissions();
        
        // ccreate empty group array
        $permissionDefault = [];
        foreach ($groups as $group) {
            $permissionDefault[$group['id']] = false;
        }
        
        // create table
        $table = [];
        
        foreach($permissions as $permission) {
            $table[$permission['id']] = $permission;
            $table[$permission['id']]['_value'] = array_merge([], $permissionDefault);
        }
        
        $groupPermissions = $this->model->getGroupPermissions( array_keys($permissionDefault) );
        
        foreach ($groupPermissions as $permission) {
            $table[$permission['permission_id']]['_value'][$permission['usergroup_id']] = true;
        }
        
        
        // build permission table
        $this->layout('usergroup/groups', ['title' => 'Groepen', 'groups' => $groups, 'permissions' => $table]);
        
    }
    
    public function getShow($slug)
    {
        $group = $this->model->get($slug);
        
        if ($group === false) { $this->abort(); }
        
        // get permissions
        $this->model->getPermissions($group['id']);
        
        // get users
        $this->model->getUsers($group['id']);
        
        $this->layout('usergroup/group', ['group' => $group]);
    }
    
}
