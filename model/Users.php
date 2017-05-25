<?php namespace model;

use \Auth;

class Users extends model{
    protected $table = 'users';

    public function fullname($params = []){
        if(isset($params['url']) && Auth::user()->can('user')){
            $mapstructure = new \MapStructureRepositorie();
            $url = $mapstructure::controller()."user/userController.php?show=1&user_id=$this->id";
            $text = "<a target='_blank' href='$url'>$this->firstname $this->lastname</a>";
        }
        else{
            $text = $this->firstname.' '.$this->lastname;
        }
    	return $text;
    }
    public function fullnameReturned($params = []){
        if(isset($params['url']) &&Auth::user()->can('user')){
            $mapstructure = new \MapStructureRepositorie();
            $url = $mapstructure::controller()."user/userController.php?show=1&user_id=$this->id";
            $text = "<a target='_blank' href='$url'><b>$this->lastname</b> $this->firstname</a>";
        }
        else{
            $text = "<b>".$this->lastname."</b>, ".$this->firstname;
        }
        return $text;
    }

    public function Roles()
    {
        $userrole = new UserRoles();
        return $userrole->where('user_id','=',$this->id)->first();
    }

    public function getUserProfilePicture()
    {
        $path = $_SERVER['DOCUMENT_ROOT']."/build/profilePic/";
        if(file_exists($path.$this->user_number.'.jpg')){
            return \MapStructureRepositorie::build().'profilePic/'.$this->user_number.'.jpg';
        }
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