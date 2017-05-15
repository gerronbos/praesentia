<?php namespace model;

class UserRoles extends model{
    protected $table = 'user_roles';

    public function User()
    {
        $user = new Users();
        return $user->find($this->user_id);
    }
}

?>