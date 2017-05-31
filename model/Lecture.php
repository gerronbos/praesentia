<?php namespace model;

class Lecture extends model{
    protected $table = 'lectures';

    public function Course()
    {
        $course = new Course();
        return $course->find($this->course_id);
    }
    public function Groups($params = array())
    {
        $groups = new Group();
        $groups->join('lecture_has_groups','group_id','id');
        $groups->where('lecture_has_groups.lecture_id','=',$this->id)->select('groups.*');
        if(isset($params['no_get'])){
            return $groups;
        }
        return $groups->get();
    }

    public function User()
    {
        $group = new Users();
        return $group->find($this->user_id);
    }
    public function Room()
    {
        $room = new Room();
        return $room->find($this->room_id);
    }
}

?>