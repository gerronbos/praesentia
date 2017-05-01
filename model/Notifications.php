<?php namespace model;

class Notifications extends model{
    protected $table = 'notifications';

    public function from_user(){
    	$user = new Users();
    	$user->find($this->from_user);
    	return $user;
    }
    public function to_user(){
    	$user = new Users();
    	$user->find($this->to_user);
    	return $user;
    }
}
?>