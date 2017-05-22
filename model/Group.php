<?php namespace model;
use model\Users;

class Group extends model{
    protected $table = 'groups';

    public function Users($params = [])
    {
        $user_ids = $this->join('group_has_users','group_id','id')->where('id','=',$this->id)->where('group_has_users.active','=',1)->lists('user_id');

        if(isset($params['onlyIds'])){
            return $user_ids;
        }
        $users = new Users();
        $users->whereIn('id',$user_ids)->get();

        return $users->whereIn('id',$user_ids)->get();
    }

}

?>