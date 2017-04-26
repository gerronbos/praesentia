<?php
use model\Users as User;
class UserRepositorie extends Repository{


    public function getUserById($id)
    {
        return User::find($id);
    }

    public function create($firstname, $lastname, $user_number, $email, $password){
    	$user = new User();
    	$user->firstname = $firstname;
    	$user->lastname = $lastname;
    	$user->user_number = $user_number;
    	$user->email = $email;
    	$user->password = self::makePassword($password);
    	$user->save();
    }

    private function makePassword($password){
    	return $password;
    }
}