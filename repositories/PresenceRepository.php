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
                $exists = model\Presence::where('user_id','=',$u)->where('lecture_id','=',$lecture->id)->first();
                if($exists){self::edit($exists, ['user_id' => $u, 'lecture_id' => $lecture->id, 'present' => (in_array($u, $present) ? false : true)]);}else{
                self::create(['user_id' => $u, 'lecture_id' => $lecture->id, 'present' => (in_array($u, $present) ? false : true)]);
            }}
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
            $presence->lecture_id = $input['lecture_id'];
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
        $presence->user_id = $input['user'];
        $presence->lecture_id = $input['lecture_id'];
        $presence->reason = $input['reason'];
        $presence->save();

        $lecture = $presence->Lecutre();
        $course = $lecture->course();

        NotificationRepository::create(Auth::user()->id, $input['user'], "Succesvol afgemeld voor $course->name op ".date('y-m-d',strtotime($lecture->date)), 1);
    }

    public function calcPresenceByUser(Users $user,$params = array()){
        $return = [];
        $group = $user->Group();
        if($group){
            $course_ids = $group->Lectures(['dont_use_get'=>1])->lists('course_id');
        }
        else{
            $course_ids = array();
        }

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
        $date =date('d-m-Y',strtotime('-'.$days.'days'));
        $date_start = $date;
        foreach(self::getDaySet() as $key=>$data){
                $return[$key] = self::calcPresenceByUser($user, ['date' => $key, 'grouped' => 1]);
        }
        ksort($return);

        return $return;
    }

    private function getDaySet($days = 7)
    {
        $date =date('d-m-Y');
        $days_queued = $days;
        $return = [];
        while($days_queued != 0) {
            if (date('N', strtotime($date)) != 6 && date('N', strtotime($date)) != 7) {
                $return[$date] = [];
                $days_queued--;
            }
            $date = date('d-m-Y', strtotime($date.'-1days'));
        }
        return $return;
    }

    public function calcPresenceByGroup(Group $group){
        $return = [];
        $course_ids = $group->Lectures(['dont_use_get'=>1])->lists('course_id');

        foreach(Course::whereIn('id',$course_ids)->get() as $course){
            $lecture_ids = Lecture::where('course_id','=',$course->id)->
                join('lecture_has_groups','lecture_id','id')->
                where('lecture_has_groups.group_id','=',$group->id)->
                select('lectures.*')->
                lists('id');
            $amount_lectures = 0;
            $amount_lectures_present = 0;
            $amount_lectures_present_prec = 0;
            $amount_lectures = count(Presence::whereIn('lecture_id',$lecture_ids)->get());
            $amount_lectures_present = count(Presence::whereIn('lecture_id',$lecture_ids)->where('present','=',1)->get());
            if($amount_lectures > 0 && $amount_lectures_present > 0) {
                $amount_lectures_present_prec = number_format(100 / $amount_lectures * $amount_lectures_present, 0);
            }
            if($amount_lectures > 0) {
                $return[$course->id] = [
                    'title' => $course->name,
                    'amount_lectures' => $amount_lectures,
                    'amount_present' => $amount_lectures_present,
                    'amount_present_prec' => $amount_lectures_present_prec
                ];
            }




        }
        return $return;
    }

    public function calcPresenceByAllCourses(){
        $return = [];
        foreach(Course::get() as $course){
            $return[$course->id] = [
                'name' => $course->name,
                'year' => $course->year,
                'period' => $course->period,
                'data' => self::calcPresenceByCourse($course)
            ];
        }

        return $return;
    }


    public function calcPresenceByCourse(Course $course)
    {
        $lectures = self::getByCourse($course)->select('lectures.*')->groupBy('id')->lists('id');

        $return = [
            'amount_users' => 0,
            'amount_present' => 0,
            'amount_present_perc' => 0
        ];
        foreach(Presence::whereIn('lecture_id',$lectures)->get() as $present){
            $return['amount_users']++;
            if($present->present){
                $return['amount_present']++;
            }
        }

        if($return['amount_users'] > 0){
            if($return['amount_present'] > 0){
                $return['amount_present_perc'] = round(100 / $return['amount_users'] * $return['amount_present'],0) ;
            }
            else{
                $return['amount_present_perc'] = 0;
            }
        }
        else{
            $return['amount_present_perc'] = 100;
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

    public function getPresenceByCourse($course, $params = array())
    {
        $presence = Presence::join('lectures', 'id', 'lecture_id');
        $presence->where('lectures.course_id', '=', $course->id);

        if(isset($params['user_id'])){
            $presence->join('lecture_has_groups', 'lecture_has_groups.lecture_id', 'lectures.id');
            $presence->join('group_has_users', 'group_has_users.group_id', 'lecture_has_groups.group_id');
            $presence->where('presence.user_id', '=', $params['user_id']);

        }
        $presence->select('presence.*, lectures.date, lectures.start_time, lectures.end_time');
        return $presence; 
    }

    public function getPresenceByLecture($lecture, $params = array())
    {
        $presence = Presence::join('lectures', 'id', 'lecture_id');
        $presence->where('lecture_id','=',$lecture->id);
        $presence->join('users','id','user_id');

        $presence->select('presence.*, users.firstname, users.lastname, users.user_number, users.email');
        return $presence;
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