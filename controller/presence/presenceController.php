<?php
include('../controller.php');

if(!Auth::user()->can('presence')){
 header("location: ".MapStructureRepositorie::error('401'));
}

if(isset($_GET['delete'])){

}

if(isset($_GET['get'])){
    $return = [
        'lecture' => model\Lecture::find($_GET['id']),
        'presence_data' => [],
        'group' => model\Lecture::find($_GET['id'])->Group()
    ];
    $presence_data = [];
    foreach(model\Presence::where('lecture_id','=',$_GET['id'])->get() as $l){
        $presence_data[$l->user_id] = ['present'=>$l->present,'reason'=>$l->reason];
    }
    $return['presence_data'] = $presence_data;

    $cookies = Services\SessionHandler::setSession('lecture_data',$return);

    header("location:".MapStructureRepositorie::view().'presence/presenceUsers.php');
    exit;
}

if(isset($_POST['set'])){
    $lecture = Services\SessionHandler::getSession('lecture_data');
    PresenceRepository::set($lecture['lecture'],$_POST['present']);
    Services\SessionHandler::setSession('presence_alert','Aanwezigheid is succesfol opgelsagen.');
    Services\SessionHandler::save();

    Services\SessionHandler::deleteSession('lecture_data');



    $url = MapStructureRepositorie::controller().'presence/presenceController.php?get=1&id='.$lecture['lecture']->id;


    header("location:".$url);
    exit;
}







?>