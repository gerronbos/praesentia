<?php namespace model;

class Users extends model{
    protected $table = 'users';

    public function fullname(){
    	return $this->firstname.' '.$this->lastname;
    }
    public function fullnameReturned(){
        return "<b>".$this->lastname."</b>, ".$this->firstname;
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

    public function Group(){
        $group = new Group();
        $group->join('group_has_users','group_id','id');
        $group->where('group_has_users.user_id','=',$this->id);
        $group->where('group_has_users.active','=',1);
        $group->select('groups.*');

        return $group->first();
    }
}
?>