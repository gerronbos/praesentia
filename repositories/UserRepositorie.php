<?php
use model\Users as User;
class UserRepositorie extends Repository{


    public function getUserById($id)
    {
        return User::find($id);
    }

}