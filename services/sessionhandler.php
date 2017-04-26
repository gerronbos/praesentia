<?php
namespace Services;
class SessionHandler{
    public function __construct()
    {
        $this->buildSession();
    }
    public function __get($key){
        if(property_exists($this,$key)){
            return $this->$key;
        }
        else{
            return null;
        }
    }
    public function __set($key,$value){
        $this->{$key} = $value;

        return $this;
    }

    public function setSession($key,$value){

        self::init()->__set($key,$value)->save();
        return $this;
    }

    public function getSession($key)
    {
        return self::init()->__get($key);

    }

    public function deleteSession($key)
    {
        if(isset($this) && is_object($this)) {
            if (isset($_COOKIE[$key])) {
                setcookie($key,null,time() - 3600, '/');
            }
            if (property_exists($this, $key)) {
                unset($this->{$key});
            }
            return $this->buildSession();
        }
        return self::init()->deleteSession($key);
    }

    public function buildSession()
    {

        foreach($_COOKIE as $key=>$c){
            if($this->is_serialized($c)) {
                $this->{$key} = unserialize($c);
            }
            else{
                $this->{$key} = $c;
            }
        }
        return $this;
    }

    public function save()
    {
        if(isset($this) && is_object($this)) {
            foreach (get_object_vars($this) as $key => $i) {
                if (is_array($i) || is_object($i)) {
                    setcookie($key, serialize($i), time()+15*60, '/');
                } else {
                    setcookie($key, $i, time()+15*60, '/');
                }
            }

            return $this;
        }
        else{
            Self::init()->save();
        }
    }

    public function has($key)
    {
        if(isset($_COOKIE[$key])) {
            return self::getSession($key);
        }
        else{
            return false;
        }
    }

    public function getAndDelete($key)
    {
        $session = self::getSession($key);
        self::deleteSession($key);
        return $session;

    }

    private function is_serialized($data){
        return (is_string($data) && preg_match("#^((N;)|((a|O|s):[0-9]+:.*[;}])|((b|i|d):[0-9.E-]+;))$#um", $data));
    }

    private function init($params = array()){
        if(isset($this) && is_object($this)){
            return $this;
        }
        $class = get_called_class();

        return new $class($params);
    }


}