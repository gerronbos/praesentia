<?php
use model\Lecture;
use model\Users;
use model\Course;

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
            $users = new Users();
            $course = new Course();
            $q = $params['q'];
            $user_ids = $users->where('firstname','LIKE','%'.$q.'%')->orWhere('lastname','LIKE','%'.$q.'%')->lists('id');
            $course_ids = $course->where('name','LIKE','%'.$q.'%')->lists('id');
            $lecture->whereIn('user_id',$user_ids);
            $lecture->orWhereIn('course_id',$course_ids);
        }

        return $lecture->select('lectures.*');
    }
}