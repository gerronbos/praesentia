<?php
use Services\SessionHandler;
use model\Users;
class Auth{
    public function __construct(){

    }
    public function login($params,$email,$password)
    {
        $user = Users::where('email','=',$email)->first();
        if(is_null($user)){
            SessionHandler::setSession('error','Combinatie van wachtwoord en email klopt niet.');
            header('location: '.MapStructureRepositorie::view().'login.php');
            exit;
        }
        if(password_verify($password,$user->password)){
            SessionHandler::setSession('user',$user);
            header('location: '.MapStructureRepositorie::view().'index.php');
            exit;
        }
        SessionHandler::setSession('error','Combinatie van wachtwoord en email klopt niet.');
        header('location: '.MapStructureRepositorie::view().'login.php');
        exit;

    }

    public function user()
    {
        $session = new SessionHandler();
        return $session->user;
    }

    public function isLoggedIn(){
        if(isset($this) && is_object($this)){
            if($this->user()){
                return true;
            }
            $path = new MapStructureRepositorie();

            header('location:'.$path->view().'login.php');
        }
        else{
            self::init()->isLoggedIn();
        }
    }

    public function logout()
    {
        SessionHandler::deleteSession('user');
    }

    private function init($params = array()){
        if(isset($this) && is_object($this)){
            return $this;
        }
        $class = get_called_class();

        return new $class($params);
    }

    public function updateLogin()
    {
        if(SessionHandler::has('user')) {
            SessionHandler::setSession('user', self::user());
        }
    }
}