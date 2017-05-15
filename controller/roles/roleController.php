<?php

include('../controller.php');



if(isset($_POST['create'])){
    RoleRepository::create($_POST);

    Services\SessionHandler::setSession('alert_roles','Rechten Sjabloon succesvol toegevoegd!');
    Header('location:'.MapStructureRepositorie::view()."roles/index.php");
    exit;
}

if(isset($_GET['user_roles'])){
    $user = new \model\Users();
    $user->find($_GET['user_id']);

    $user_role = new \model\UserRoles();
    $user_role->where('user_id','=',$_GET['user_id'])->first();

    if(is_null($user_role)){
        $user_role = new \model\UserRoles();
    }
    Services\SessionHandler::setSession('user_data',$user);
    Services\SessionHandler::setSession('userRole_data',$user_role);

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