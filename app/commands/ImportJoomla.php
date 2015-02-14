<?php

namespace Commands;

use Libraries\IoC;
use PDO;

class ImportJoomla
{
    protected $db;
    protected $importDb;
    
    public function run()
    {
        $this->db       = IoC::resolve('database');
        $this->importDb = new PDO('mysql:host=localhost;dbname=c2ms', 'root', '', [PDO::ATTR_PERSISTENT => true]);
    }
    
    protected function importUsers()
    {
        // tdd_users
        // id, name, username, email, password, usertype, block, sendEmail, registerDate, lastvisitDate, activation, params, lastResetTime, resetCount
        $stmt = $this->importDb->prepare('SELECT * FROM tdd_users');
        $stmt->execute();
        $users = $stmt->fetchAll();
        
        foreach($users as $user) {

        }
    }
    
    protected function importContent()
    {
        // tdd_content
        // id, asset_id, title, alias, introtext, fulltext, state, sectionid, mask, catid, created, created_by, created_by_alias, modified, modified_by, checked_out, checked_out_time, publish_up, publish_down, images, urls, attribs, version, parentid, ordering, metakey, metadesc, access, hits, metadata, featured, language, xreference

    }
    
    protected function importEvent()
    {
        // tdd_jevents_vevdetail
        
    }
    
    protected function importAttendees()
    {
        // tdd_jev_attendees
        // id, at_id, user_id, rp_id, confirmed, params, created, modified, attendstate, atdcount, guestcount, didattend, lockedtemplate
    }
}