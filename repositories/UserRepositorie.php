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

    	NotificationRepository::create(Auth::user()->id, $user->id, 'Account aangemaakt.', 1);
    }

    private function makePassword($password){

        $password = password_hash($password, PASSWORD_BCRYPT);

    	return $password;
    }

    public function update($user,$firstname, $lastname, $user_number, $email){
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->user_number = $user_number;
        $user->email = $email;
        $user->save();

        NotificationRepository::create(Auth::user()->id, $user->id, 'Account aangemaakt.', 1);
    }
}