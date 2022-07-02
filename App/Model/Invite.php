<?php namespace App\Model;
use PDO;
use App\Database\DatabaseConfig;

class Invite extends DatabaseConfig {
    protected $invitee_id;
    protected $sender_id;
    protected $description;
    protected $accepted;
    protected $event_time;
    protected $active;
    public function __construct($invitee_id, $sender_id, $accepted, $event_time, $active, $description='',)
    {
        $this->invitee_id = $invitee_id;
        $this->sender_id = $sender_id;
        $this->description = $description;
        $this->accepted = $accepted;
        $this->event_time = $event_time;
        $this->active = $active;
    }
    public function createInvite() {
        $q = 'insert into invites (invitee_id, sender_id, description, active, accepted, event_time) values(?, ?, ?, ?, ?, ?)';

        $params = array(
            $this->invitee_id => PDO::PARAM_INT,
            $this->sender_id => PDO::PARAM_INT,
            $this->description => PDO::PARAM_STR,
            $this->active => PDO::PARAM_STR,
            $this->accepted => PDO::PARAM_STR,
            $this->event_time => PDO::PARAM_STR
        );
        return $this->insert($q, $params);
    }
}