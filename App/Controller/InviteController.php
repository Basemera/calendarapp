<?php namespace App\Controller;

use App\Model\Invite;
use App\Model\User;
use App\Lib\Request;
use App\Lib\Response;
use Exception;


class InviteController {
    public function createInvite(Request $request, Response $response) {
        $user = $request->getAuth();
        if ($user) {
            $data = $request->getJSON();
            $data['sender_id'] = $user->id;
            $invite = new Invite();
            $res = $invite->Create($data);
            $response->status(201)->toJSON($res);
            
        }else {
            $response->status(400)->toJSON("bad request missing auth headers");
        }

    }

    public function updateInvite(Request $request, Response $response) {
        $user = $request->getAuth();
        try {
            $invite = Invite::findOrFail($request->params[0]);
        } catch (Exception $e) {
            return $response->status(400)->toJSON($e->getMessage());
        }
        $data = $request->getJSON();
        if (array_key_exists('active', $data) && $user->id != $invite->sender_id) {
            $res['message'] = "Not authorized";
            return $response->status(400)->toJSON($res);
        }
        elseif (array_key_exists('accepted', $data) && $user->id != $invite->invitee_id) {
            $res['message'] = "Cannot accept an invite to which you have not been invited";
            return $response->status(400)->toJSON($res);
        }
        elseif (array_key_exists('event_time', $data)) {
            if ($data['event_time'] < date("Y-m-d")) {
                $res['message'] = "date must be in the future";
                return $response->status(400)->toJSON($res);
            }
        }
        $fields = array_keys($data);
        foreach ($fields as $field) {
            if (!in_array($field, ['sender_id', 'invitee_id'])) {
                $invite->$field = $data[$field];
            }
        }
        try {
            $res = $invite->save();
        } catch (Exception $e) {
            return $response->status(400)->toJSON($e->getMessage());
        }
        return $response->status(200)->toJSON($invite);
    }
}