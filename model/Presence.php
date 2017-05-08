<?php namespace model;

class Presence extends model{
    protected $table = 'presence';


    public function Lecutre()
    {
        $lecture = new Lecture();
        return $lecture->find($this->lecture_id);
    }

}

?>