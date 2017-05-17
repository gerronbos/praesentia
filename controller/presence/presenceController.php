<?php
include('../controller.php');


if(isset($_GET['delete'])){

}

if(isset($_GET['get'])){
    $return = [
        'lecture' => model\Lecture::find($_GET['id']),
        'presence_data' => model\Presence::where('lecture_id','=',$_GET['id'])->lists('present','user_id'),
        'group' => model\Lecture::find($_GET['id'])->Group()
    ];
    var_dump($return);
    exit;
    Services\SessionHandler::setSession('lecture_data',$return);
    Services\SessionHandler::save();

    header("location:".MapStructureRepositorie::view().'presence/presenceUsers.php');
    exit;
}

if(isset($_POST['set'])){
    $lecture = Services\SessionHandler::getSession('lecture_data');
    PresenceRepository::set($lecture['lecture'],$_POST['present']);
    Services\SessionHandler::setSession('presence_alert','Aanwezigheid is succesfol opgelsagen.');
    Services\SessionHandler::save();

    Services\SessionHandler::deleteSession('lecture_data');

    header("location:".MapStructureRepositorie::controller().'presence/presenceController.php?get='.$lecture->id);
    exit;
}







?>