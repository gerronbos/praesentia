<?php

include('../controller.php');



if(isset($_POST['create'])){
    RoleRepository::create($_POST);

    Services\SessionHandler::setSession('alert_roles','Rechten Sjabloon succesvol toegevoegd!');
    Header('location:'.MapStructureRepositorie::view()."roles/index.php");
    exit;
}

if(isset($_GET['update'])){
    $role = \model\Role::find($_GET['role_id']);

    Services\SessionHandler::setSession('role_data',$role);
    Header('location:'.MapStructureRepositorie::view()."roles/edit.php");
    exit;
}

if(isset($_POST['update'])){
    $role = \model\Role::find($_POST['role_id']);
    RoleRepository::update($role,$_POST);

    Services\SessionHandler::setSession('alert_roles','Rechten Sjabloon succesvol gewijzigd!');
    Header('location:'.MapStructureRepositorie::controller()."roles/roleController.php?update=1&role_id=".$role->id);
    exit;
}

if(isset($_POST['delete'])){
    $role = \model\Role::find($_POST['id']);
    RoleRepository::delete($role);

    Services\SessionHandler::setSession('alert_roles','Rechten Sjabloon succesvol verwijderd!');
    Header('location:'.MapStructureRepositorie::view()."roles/index.php");
    exit;
}

if(isset($_POST['assignToRole'])){

    foreach($_POST['users'] as $user_id){
    $user_role = \model\UserRoles::where('user_id','=',$user_id)->first();
    $role = \model\Role::find($_POST['role_id']);

    if(!$user_role){
        $user_role = new model\UserRoles();
    }
    $user_role->user_id = $user_id;
    if($role->users){
        $user_role->user = 1;
    }
    if($role->presence){
        $user_role->presence = 1;
    }
    if($role->lectures){
        $user_role->lectures = 1;
    }
    if($role->groups){
        $user_role->groups = 1;
    }
    if($role->courses){
        $user_role->courses = 1;
    }
    if($role->rooms){
        $user_role->rooms = 1;
    }
    if($role->import){
        $user_role->import = 1;
    }
    if ($role->courses) {
        $user_role->courses = 1;
    }

    if(is_null($user_role->title)){$user_role->title = $role->title;}else{$user_role->title = $user_role->title.', '.$role->title;}
    $user_role->save();
    header("location:".MapStructureRepositorie::view()."roles/index.php");
    exit;
    }
}

if(isset($_GET['user_roles'])){

    $user_role = new \model\UserRoles();
    $user_role->where('user_id','=',$_GET['user_id'])->first();

    Services\SessionHandler::setSession('user_data', $_GET['user_id']);
    Services\SessionHandler::setSession('userRole_data',($user_role) ? $user_role->id : null);

    header("location:".MapStructureRepositorie::view()."roles/user_role.php");
    exit;
}

if(isset($_POST['user_roles'])){
    $user = new \model\Users();
    $user->find($_POST['user_id']);

    $user_role = \model\UserRoles::where('user_id','=',$_POST['user_id'])->first();

    if(is_null($user_role)){
        $user_role = new \model\UserRoles();
        $user_role->user_id = $user->id;
    }

    RoleRepository::updateUserRole($user_role,$_POST);

    Services\SessionHandler::setSession('alert_roles','Rechten van gebruikers zijn gewijzigd!');
    header("location:".MapStructureRepositorie::controller()."roles/roleController.php?user_roles=1&user_id=".$user->id);
    exit;
}