<?php
use model\Role;
class RoleRepository extends Repository{

    public function create($input = array(), $params = array())
    {
        $role = new Role();
        $role->title = $input['title'];
        $role->users = $input['users'];
        $role->presence = $input['presence'];
        $role->lectures = $input['lectures'];
        $role->groups = $input['groups'];
        $role->rooms = $input['rooms'];

        $role->save();
    }
}