<?php namespace model;

class Notifications extends model{
    protected $table = 'notifications';

    public function from_user(){
    	return Users::find($this->from_user);
    }
    public function to_user(){
    	return Users::find($this->to_user);
    }
}
?>