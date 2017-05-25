<?php
class MapStructureRepositorie extends Repository{

    public function view()
    {
        $configrepositorie = new ConfigRepositorie();
        return $configrepositorie->get('url').'/view/';
    }
    public function vendors()
    {
        return self::view().'vendors/';
    }
    public function build()
    {
        $configrepositorie = new ConfigRepositorie();
        return $configrepositorie->get('url').'/build/';
    }
    public function controller()
    {
        $configrepositorie = new ConfigRepositorie();
        return $configrepositorie->get('url').'/controller/';
    }
    public function helpers()
    {
        $configrepositorie = new ConfigRepositorie();
        return $configrepositorie->get('url').'/helpers/';
    }
    public function model()
    {
        $configrepositorie = new ConfigRepositorie();
        return $configrepositorie->get('url').'/model/';
    }
    public function uploads()
    {
        $configrepositorie = new ConfigRepositorie();
        return $configrepositorie->get('url').'/uploads/';
    }
    public function repositories()
    {
        $configrepositorie = new ConfigRepositorie();
        return ConfigRepositorie::get('url').'/repositories/';
    }

    public function error($error){
        return self::view()."errors/$error.php";
    }
}