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

        return $user;

    	NotificationRepository::create(Auth::user()->id, $user->id, 'Account aangemaakt.', 1);
    }

    private function makePassword($password){

        $password = password_hash($password, PASSWORD_BCRYPT);

    	return $password;
    }
    public static function generateRandomPassword($length = 8)
    {
        $numbers = [0,1,2,3,4,5,6,7,8,9];
        $alfabeth = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];


        $options = ['number','alfabeth'];
        $password = '';

        for($i=0; $i<$length; $i++){
            //number or alfabeth
            $type = $options[rand(0,1)];
            if($type == 'number'){
                $password.= $numbers[rand(0,count($numbers)-1)];
            }
            else{
                $uppercase = rand(0,1);

                if($uppercase){
                    $password.= strtoupper($alfabeth[rand(0,count($alfabeth)-1)]);
                }
                else{
                    $password.= strtolower($alfabeth[rand(0,count($alfabeth)-1)]);
                }
            }
        }

        return $password;

    }

    public function resetPassword($user){
        $password=self::generateRandomPassword();
        $user->password=self::makePassword($password);
        $user->save();

        $user->email=$email;

        $msg="Uw wachtwoord is gereset. Log in met het volgende wachtwoord: $password";

        $msg = wordwrap($msg, 70);

        mail("erkam_s@online.nl", "Wachtwoord reset", $msg);
    }

    public function update($user ,$data = array()){
        if (isset($data['firstname'])) {
            $user->firstname = $data['firstname'];
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
        GroupRepository::assignToGroup($data['group_id'],$user->id);
        NotificationRepository::create(Auth::user()->id, $user->id, 'Account gewijzigd.', 1);
    }

    public function delete($user){
        $user->delete();

        NotificationRepository::create(Auth::user()->id, $user->id, 'Account verwijderd.', 1);
    }

    public function getWithGroupsByIds($user_ids)
    {
        $users = User::whereIn('id',$user_ids);
        $users->join('group_has_users','user_id','id');
        $users->join('groups','id','group_has_users.group_id');
        $users->groupBy('users.id');
        $users->select('users.*,groups.name,groups.school_year,groups.period,groups.education_id');
        return $users->get();
    }

    public function getUsersByRole($role){
        $users = User::join('user_roles','user_id','id');
        $users->where('user_roles.'.$role,'=',1);
        $users->select('users.*');
        return $users;

    }
}