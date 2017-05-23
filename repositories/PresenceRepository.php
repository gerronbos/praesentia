<?php

use model\Presence;
use model\Lecture;
use model\Users;
use model\Course;
use model\Group;

class PresenceRepository extends Repository{

    public function set(Lecture $lecture, $present)
    {
        foreach($lecture->Groups() as $group){
            foreach($group->Users(['onlyIds'=>1]) as $u) {
                self::create(['user_id' => $u, 'lecture_id' => $lecture->id, 'present' => (in_array($u, $present) ? false : true)]);
            }
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
        $presence->user_id = '';
        $presence->lecture_id = $input['lecture_id'];
        $presence->reason = $input['reason'];
        $presence->save();
    }

    public function calcPresenceByUser(Users $user,$params = array()){
        $return = [];
        $course_ids = $user->Group()->Lectures(['dont_use_get'=>1])->lists('course_id');

        if(isset($params['grouped'])){
           $return = [
               'amount_lectures' => 0,
               'amount_present' => 0,
               'amount_present_prec' => 0
           ];
        }

        foreach(Course::whereIn('id',$course_ids)->get() as $course){
            if(isset($params['date'])){
                $lecture_ids = Lecture::where('course_id','=',$course->id)->where('date','=',date('Y-m-d',strtotime($params['date'])))->lists('id');
            }
            else{
                $lecture_ids = Lecture::where('course_id','=',$course->id)->lists('id');
            }
            $amount_lectures = count(Presence::whereIn('lecture_id',$lecture_ids)->where('user_id','=',$user->id)->get());
            $amount_lectures_present = count(Presence::whereIn('lecture_id',$lecture_ids)->where('user_id','=',$user->id)->where('present','=',1)->get());
            if($amount_lectures == 0){
                $amount_lectures_present_prec = 100;
            }
            else {
                if($amount_lectures_present == 0){
                    $amount_lectures_present_prec = 0;
                }
                else {
                    $amount_lectures_present_prec = number_format(100 / $amount_lectures * $amount_lectures_present, 0);
                }
            }
            if(isset($params['grouped'])) {
                $return['amount_lectures'] += $amount_lectures;
                $return['amount_present'] += $amount_lectures_present;
            }
            else{
                $return[$course->id] = [
                    'title'=>$course->name,
                    'amount_lectures' => $amount_lectures,
                    'amount_present' => $amount_lectures_present,
                    'amount_present_prec' => $amount_lectures_present_prec
                ];
            }

        }
        if(isset($params['grouped'])) {
            if($return['amount_lectures'] == 0){
                $return['amount_present_prec'] = 100;
            }
            else{
                if($return['amount_present'] == 0){
                    $return['amount_present_prec'] = 0;
                }
                else{
                    $return['amount_present_prec'] += number_format(100 / $return['amount_lectures'] * $return['amount_present'],0);
                }
            }
        }

        return $return;
    }

    public function getByLastDays($user,$days = 7, $params = array()){
        $return = [];
        $date =date('d-m-Y',strtotime('-7days'));
        while($date != date('d-m-Y')){
            $return[$date] = self::calcPresenceByUser($user,['date'=>$date,'grouped'=>1]);
            $date = date('d-m-Y',strtotime($date. '+1 days'));
        }

        return $return;


    }

    public function calcPresenceByGroup(Group $group){
        $return = [];
        $course_ids = $group->Lectures(['dont_use_get'=>1])->lists('course_id');

        foreach(Course::whereIn('id',$course_ids)->get() as $course){
            $lecture_ids = Lecture::where('course_id','=',$course->id)->lists('id');
            $amount_lectures = count(Presence::whereIn('lecture_id',$lecture_ids)->get());
            $amount_lectures_present = count(Presence::whereIn('lecture_id',$lecture_ids)->where('present','=',1)->get());
            $amount_lectures_present_prec = number_format( 100/ $amount_lectures * $amount_lectures_present,0);
            $return[$course->id] = [
                'title'=>$course->name,
                'amount_lectures' => $amount_lectures,
                'amount_present' => $amount_lectures_present,
                'amount_present_prec' => $amount_lectures_present_prec
            ];

        }
        return $return;
    }

    public function getByCourse($course, $params = array())
    {
        $lecture = Lecture::join('courses','id','course_id');
        $lecture->where('courses.id','=',$course->id);
        if(isset($params['group_id']) && $params['group_id']){
            $lecture->join('lecture_has_groups','lecture_has_groups.lecture_id','id');
            $lecture->join('groups','lecture_has_groups.group_id','groups.id');
            $lecture->where('groups.id','=',$params['group_id']);
        }

        return $lecture;
    }

    public function getByLecture($lecture, $params = array())
    {
        $present = Presence::where('lecture_id','=',$lecture->id);
        $return = [
            'amount_users' => 0,
            'amount_presence' => 0,
            'amount_presence_prec' => 0
        ];

        foreach($present->get() as $p){
            $return['amount_users']++;
            if($p->present){
                $return['amount_presence']++;
            }
        }
        if($return['amount_users'] == 0){
            $return['amount_presence_prec'] = 100;
        }
        elseif($return['amount_presence'] == 0){
            $return['amount_presence_prec'] = 0;
        }
        else {
            $return['amount_presence_prec'] = number_format(100 / $return['amount_users'] * $return['amount_presence'],0);
        }
        return $return;


    }
}