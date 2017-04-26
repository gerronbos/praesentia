<?php
use Services\SessionHandler;
use model\Users;
class Auth{
    public function __construct(){

    }
    public function login($params)
    {
        $user = Users::where('id','!=',0);
        foreach($params as $key=>$p){
            $user->where($key,'=',$p);
        }

        if(!is_null($user->first())){
            SessionHandler::setSession('user',$user);

            return true;
        }
        else{
            SessionHandler::setSession('error','De combinatie van email en wachtwoord is onjuist.');
            return false;
        }
    }

    public function user()
    {
        $session = new SessionHandler();
        //var_dump($session);
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