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
        $role->import = $input['import'];
        $role->courses = $input['courses'];

        $role->save();
    }

    public function update($role,$input){
        $role->title = $input['title'];
        $role->users = $input['users'];
        $role->presence = $input['presence'];
        $role->lectures = $input['lectures'];
        $role->groups = $input['groups'];
        $role->rooms = $input['rooms'];
        $role->import = $input['import'];
        $role->courses = $input['courses'];

        $role->save();

    }

    public function updateUserRole(\model\UserRoles  $userRole, $data = array()){

        $userRole->title = $data['title'];
        $userRole->user = $data['users'];
        $userRole->presence = $data['presence'];
        $userRole->lectures = $data['lectures'];
        $userRole->groups = $data['groups'];
        $userRole->rooms = $data['rooms'];
        $userRole->import = $data['import'];
        $userRole->courses = $input['courses'];
        $userRole->save();


        NotificationRepository::create(Auth::user()->id,$userRole->user_id,'Uw rechten zijn gewijzigd');
    }

    public function delete(Role $role)
    {
        $role->delete();
    }
}