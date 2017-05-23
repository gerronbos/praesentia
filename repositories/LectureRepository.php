<?php
use model\Lecture;
use model\Users;
use model\Course;
use model\Lecture_has_groups;

class LectureRepository extends Repository{

    public function get($params = array())
    {
        $lecture = Lecture::where('id','!=',0);
        $lecture->join('lecture_has_groups','lecture_id','id');

        if(isset($params['byUser']) && $params['byUser']){
            $lecture->where('user_id','=',$params['byUser']);
        }
        if(isset($params['byRoom']) && $params['byRoom']){
            $lecture->where('room_id','=',$params['byRoom']);
        }
        if(isset($params['byCourse']) && $params['byCourse']){
            $lecture->where('course_id','=',$params['byCourse']);
        }
        if(isset($params['byGroup']) && $params['byGroup']){
            $lecture->where('group_id','=',$params['byGroup']);
        }
        if(isset($params['byDate']) && $params['byDate']){
            $lecture->where('date','=',$params['byDate']);
        }
        if(isset($params['q']) && $params['q']){
            foreach(explode(' ',$params['q']) as $q) {
                $users = new Users();
                $course = new Course();
                $user_ids = $users->where('firstname', 'LIKE', '%' . $q . '%')->orWhere('lastname', 'LIKE', '%' . $q . '%')->lists('id');
                $course_ids = $course->where('name', 'LIKE', '%' . $q . '%')->lists('id');
                $lecture->whereIn('user_id', $user_ids);
                $lecture->orWhereIn('course_id', $course_ids);
                $lecture->orWhere('date', '=', $q);
            }
        }


        return $lecture->select('lectures.*');
    }

    public function create($date, $start_time, $end_time, $room_id, $course_id, $user_id){
        $lecture = new model\Lecture();
        $lecture->date = date('Y-m-d',strtotime($date));
        $lecture->start_time = $start_time;
        $lecture->end_time = $end_time;
        $lecture->room_id = $room_id;
        $lecture->course_id = $course_id;
        $lecture->user_id = $user_id;

        $lecture->save();

        return $lecture;
    }

    public function assign($group,$lecture){
        $lhg = new Lecture_has_groups();
        $lhg->group_id = $group->id;
        $lhg->lecture_id = $lecture->id;
        $lhg->save();
    }

    public function edit(Lecture $lecture,$date, $start_time, $end_time, $room_id, $course_id, $user_id){
        $lecture->date = date('Y-m-d',strtotime($date));
        $lecture->start_time = $start_time;
        $lecture->end_time = $end_time;
        $lecture->room_id = $room_id;
        $lecture->course_id = $course_id;
        $lecture->user_id = $user_id;

        $lecture->save();

        return $lecture;
    }
}