<?php namespace model;

class Presence extends model{
    protected $table = 'presence';


    public function Lecutre()
    {
        $lecture = new Lecture();
        return $lecture->find($this->lecture_id);
    }
    public function User()
    {
        $user = new Users();
        return $user->find($this->user_id);
    }

}

?>