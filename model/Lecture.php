<?php namespace model;

class Lecture extends model{
    protected $table = 'lectures';

    public function Course()
    {
        $course = new Course();
        return $course->find($this->course_id);
    }
    public function Group()
    {
        $group = new Group();
        return $group->find($this->group_id);
    }

    public function User()
    {
        $group = new Users();
        return $group->find($this->user_id);
    }
}

?>