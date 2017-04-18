<?php

class Repository{
    private $instance = null;

    public function init($params = array()){
        if(isset($this) && is_object($this)){
            if(!is_null($this->instance)){
                return $this->instance;
            }
            $this->instance = $this;
            return $this->instance;
        }
        $class = get_called_class();

        return new $class($params);
    }
}

?>