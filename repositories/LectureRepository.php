<?php
use model\Lecture;

class LectureRepository extends Repository{

    public function get($params = array())
    {
        $lecture = Lecture::where('id','!=',0);

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

        return $lecture;
    }
}