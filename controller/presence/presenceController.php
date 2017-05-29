<?php
include('../controller.php');

if(!Auth::user()->can('presence')){
 header("location: ".MapStructureRepositorie::error('401'));
}

if(isset($_GET['show'])){
    $id = $_GET['id'];
    $url_present = MapStructureRepositorie::view()."presence/presenceUsers.php?id=$id";
    $url_show = MapStructureRepositorie::view()."lecture/presence/presencebylecture.php?lecture_id=$id";

    if(count(PresenceRepository::getPresenceByLecture(model\Lecture::find($id))->get())){
        header("location: $url_show");
        exit;
    }
    header("location: $url_present");
    exit;
}

if(isset($_POST['set'])){
    $lecture = Services\SessionHandler::getSession('lecture_data');
    PresenceRepository::set(model\Lecture::find($lecture['lecture']),$_POST['present']);
    Services\SessionHandler::setSession('presence_alert','Aanwezigheid is succesfol opgelsagen.');
    Services\SessionHandler::save();

    Services\SessionHandler::deleteSession('lecture_data');



    $url = MapStructureRepositorie::controller().'presence/presenceController.php?get=1&id='.$lecture['lecture']->id;


    header("location:".$url);
    exit;
}







?>