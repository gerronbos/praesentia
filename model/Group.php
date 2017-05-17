<?php namespace model;
use model\Users;

class Group extends model{
    protected $table = 'groups';

    public function Users()
    {
        $user_ids = $this->join('group_has_users','group_id','id')->lists('user_id');
        $users = new Users();
        $users->whereIn('id',$user_ids)->get();
        return $users->whereIn('id',$user_ids)->get();
    }
}

?>