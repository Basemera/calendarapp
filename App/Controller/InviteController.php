<?php namespace App\Controller;

use App\Model\Invite;
use App\Model\User;
use App\Lib\Request;
use App\Lib\Response;

class InviteController {
    public function createInvite(Request $request, Response $response) {
        $user = $request->getAuth();
        if ($user) {
            $data = $request->getJSON();
            $description = isset($data->description) ? $data->description : '';
            $accepted = isset($data->accepted) ? $data->accepted : 'awaiting';
            $active = isset($data->active) ? $data->active : "active";
            $event_time = isset($data->event_time) ? $data->event_time : '';
            $sender_id = isset($data->sender_id) ? $data->sender_id : '';
            $invitee_id = $user['user_id'];
            if ($sender_id == '' || $event_time == '') {
                return $response->status(400)->toJSON("bad request missing required fields");
            }
            $invite = new Invite(
                $invitee_id,
                $sender_id,
                $accepted,
                $event_time,
                $active,
                $description,
            );
            $res = $invite->createInvite();
            $reponseData = array(
                'message' => "Invite sent",
                'sender_id' => $sender_id,
                'invitee_id' => $invitee_id,
                'invite_id' => $res
            );
            $response->status(201)->toJSON($reponseData);
            
        }else {
            $response->status(400)->toJSON("bad request missing auth headers");
        }

    }

    public function updateInvite(Request $request, Response $response) {
        $user = $request->getAuth();
        
    }
}