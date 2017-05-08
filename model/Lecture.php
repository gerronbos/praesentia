<?php namespace model;

class Lecture extends model{
    protected $table = 'lectures';

    public function Course()
    {
        $course = new Course();
        return $course->find($this->course_id);
    }
}

?>