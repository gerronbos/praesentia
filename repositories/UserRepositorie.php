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

    public function update($user ,$data = array()){
        if (isset($data['firstname'])) {
            $user->firstname = $date['firstname'];
        }
        if (isset($data['lastname'])) {
            $user->lastname = $data['lastname'];
        }
        if (isset($data['user_number'])) {
            $user->user_number = $data['user_number'];
        }
        if (isset($data['email'])) {
            $user->email = $data['email'];
        }
        if (isset($data['password'])) {
            $user->password = self::makePassword($data['password']);
        }
        $user->save();
        NotificationRepository::create(Auth::user()->id, $user->id, 'Account gewijzigd.', 1);
    }

    public function delete($user){
        $user->delete();

        NotificationRepository::create(Auth::user()->id, $user->id, 'Account verwijderd.', 1);
    }
}