<?php namespace model;

class Users extends model{
    protected $table = 'users';

    public function fullname(){
    	return $this->firstname.' '.$this->lastname;
    }

    public function Roles()
    {
        $userrole = new UserRoles();
        return $userrole->find($this->user_id);
    }

    public function getUserProfilePicture()
    {
        return \MapStructureRepositorie::build().'images/profile.png';
    }
}
?>