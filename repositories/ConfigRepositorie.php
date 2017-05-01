<?php

class ConfigRepositorie extends Repository{
    private $config = null;


    public function get($index)
    {
        return self::init()->__get($index);
    }
    public function set($index,$value)
    {
        return self::init()->__set($index,$value);
    }
    public function save()
    {
        if(isset($this) && is_object($this)){
            $config = null;
            $items = $this->config;
            foreach($items as $key=>$c){
                if($config) {
                    $config .= ",\n '$key' => '$c'";
                }
                else{
                    $config = " '$key' => '$c'";
                }

            }
            if(file_exists('../build/config.php')) {
                $config_doc = fopen($_SERVER['DOCUMENT_ROOT'].'/build/config.php', 'w');
                fwrite($config_doc, "<?php  \nreturn[\n$config\n]\n?>");
                fclose($config_doc);

            }
            else{
                echo "<h3 style='color: red'>File bestaad niet!</h3>";
            }
        }
        else{
            self::init()->save();
        }
    }


    public function __construct(){
        $this->config = include($_SERVER['DOCUMENT_ROOT'].'/build/config.php');

        return $this;
    }


    public function __get($index)
    {
        if(isset($this->config[$index])){
            return $this->config[$index];
        }
        return null;
    }

    public function __set($index, $value)
    {
        $config = $this->config;
        $config[$index] = $value;

        $this->config = $config;

        return $this->init();

    }

}

?>