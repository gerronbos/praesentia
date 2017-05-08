<?php

use model\Presence;
use model\Lecture;
use NotificationRepository;

class PresenceRepository extends Repository{

    public function get($params = array())
    {
        $presence = Presence::where('id','!=',0);

        if(isset($params['byLecture']) && $params['byLecture']){
            $presence->where('lecutre_id','=',$params['byLecture']);
        }
        if(isset($params['byUser']) && $params['byUser']){
            $presence->where('user_id','=',$params['byUser']);
        }
        if(isset($params['byPresent']) && $params['byPresent']){
            $presence->where('present','=',$params['byPresent']);
        }
        return $presence;
    }

    public function create($input = array())
    {
        $presence = new Presence();
        $presence->present = $input['present'];
        $presence->user_id = $input['user_id'];
        $presence->lecture_id = $input['lecture_id'];
        $presence->save();

        ($input['present'])? $present = 'aanwezig' : $present = 'afwezig';

        NotificationRepository::create(Auth::user()->id,$input['user_id'],"Aanwezigheid op $present gezet.");
    }

    public function edit(Presence $presence, $input = array())
    {
        if(isset($input['present'])) {
            $presence->present = $input['present'];
        }
        if(isset($input['user_id'])) {
            $presence->user_id = $input['user_id'];
        }
        if(isset($input['lecture_id'])) {
            $presence->lecutre_id = $input['lecture_id'];
        }

        $presence->save();
        ($input['present'])? $present = 'aanwezig' : $present = 'afwezig';

        NotificationRepository::create(Auth::user()->id,$input['user_id'],"Aanwezigheid op $present gezet.");


    }

    public function delete(Presence $presence)
    {
        $lecture = $presence->Lecutre();
        var_dump($presence);
        $presence->delete();
        NotificationRepository::create(Auth::user()->id,$input['user_id'],"Aanwezigheid van ");
    }
}