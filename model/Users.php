<?php namespace model;

class Users extends model{
    protected $table = 'users';

    public function fullname(){
    	return $this->firstname.' '.$this->lastname;
    }
}
?>