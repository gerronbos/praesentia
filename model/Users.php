<?php namespace model;

class Users extends model{
    protected $table = 'users';

    public function fullname(){
    	return $this->firstname.' '.$this->lastname;
    }

    public function Roles()
    {
        $userrole = new UserRoles();
        return $userrole->where('user_id','=',$this->id)->first();
    }

    public function getUserProfilePicture()
    {
        return \MapStructureRepositorie::build().'images/profile.png';
    }

    public function can($role){
        $userrole = new UserRoles();
        $userrole->where('user_id','=',$this->id)->first();
        if($userrole->$role){
            return true;
        }
        return false;
    }
}
?>