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
        return ConfigRepositorie::get('url').'/build/';
    }
    public function controller()
    {
        return ConfigRepositorie::get('url').'/controller/';
    }
    public function helpers()
    {
        return ConfigRepositorie::get('url').'/helpers/';
    }
    public function model()
    {
        return ConfigRepositorie::get('url').'/model/';
    }
    public function uploads()
    {
        return ConfigRepositorie::get('url').'/uploads/';
    }
    public function repositories()
    {
        return ConfigRepositorie::get('url').'/repositories/';
    }

    public function error($error){
        return self::view()."errors/$error.php";
    }
}