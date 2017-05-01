<?php namespace model;

class Users extends model{
    protected $table = 'users';
    protected $protected = ['password'];

    public function fullname(){
    	return $this->firstname.' '.$this->lastname;
    }
}
?>