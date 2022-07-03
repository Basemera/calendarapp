<?php namespace App\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
class Invite extends Eloquent
{
   protected $fillable = ["invitee_id", "sender_id", "description", "active", "accepted", "event_time"];
   public function invitee()
   {
    return $this->belongsTo('User', 'invitee_id');
   }

   public function sender()
   {
    return $this->belongsTo('User', 'sender_id');
   }
}