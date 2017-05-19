<?php

use model\Presence;
use model\Lecture;

class PresenceRepository extends Repository{

    public function set(Lecture $lecture, $present)
    {
        foreach($lecture->Group()->Users() as $u){
            self::create(['user_id'=>$u->id,'lecture_id'=>$lecture->id,'present'=> (in_array($u->id,$present) ? false : true)]);
        }

    }
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
        $lecture = $presence->Lecutre();
        $course = $lecture->course();
        NotificationRepository::create(Auth::user()->id,$input['user_id'],"Aanwezigheid voor $course->name op ".date('y-m-d',strtotime($lecture->date))." is op $present gezet.");
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
        $lecture = $presence->Lecutre();
        $course = $lecture->course();
        $user = $presence->user();

        NotificationRepository::create(Auth::user()->id,$input['user_id'],"Aanwezigheid voor $course->name op ".date('y-m-d',strtotime($lecture->date))." is op $present gezet.");


    }

    public function delete(Presence $presence)
    {
        $lecture = $presence->Lecutre();
        $course = $lecture->course();
        $user = $presence->user();
        $presence->delete();
        NotificationRepository::create(Auth::user()->id,$user->id,"Aanwezigheid voor $course->name op ".date('y-m-d',strtotime($lecture->date))." is verwijderd.");
    }

    public function setOwnPresence($input){
        $presence = new Presence();
        $presence->present = 0;
        $presence->user_id = Auth::user()->id;
        $presence->lecture_id = $input['lecture_id'];
        $presence->reason = $input['reason'];
        $presence->save();
    }
}