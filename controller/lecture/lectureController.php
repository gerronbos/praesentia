<?php
include_once('../controller.php');

if(isset($_GET['get'])){
    $return = [];
    foreach(LectureRepository::get(['byUser'=>$_POST['user_id'],'byDate'=>$_POST['date']])->orderBy('start_time','asc')->get() as $lecture){
        $return[] = ['id'=>$lecture->id,'start_time'=>$lecture->start_time,'end_time'=>$lecture->end_time,'course'=>$lecture->Course()->name];
    }
    echo json_encode($return);
    exit;
}
if(isset($_GET['get_by_group'])){
    $return = [];
    foreach(LectureRepository::get(['byGroup'=>$_POST['group_id'],'byDate'=>$_POST['date']])->orderBy('lectures.start_time','asc')->get() as $lecture){
        $presence = model\Presence::where('lecture_id','=',$lecture->id)->where('user_id','=',Auth::user()->id)->first();

        if($presence){
            $present = 0;
        }
        else{
            $present = 1;
        }

        $return[] = ['id'=>$lecture->id,'start_time'=>$lecture->start_time,'end_time'=>$lecture->end_time,'course'=>$lecture->Course()->name,'present'=>$present];
    }
    echo json_encode($return);
    exit;
}

if(isset($_GET['get_all'])){
    $return = [];
    if(isset($_GET['q'])){
        $q = $_GET['q'];
    }
    else{
        $q = '';
    }

    header('location: '.MapStructureRepositorie::view().'lecture/all_lectures.php?q='.$q);

    exit;
}

if(isset($_POST['csv'])){
    if(isset($_FILES['file']['name']))
        $target = MapStructureRepositorie::uploads();
    $target = $target.basename($_FILES['file']['name']);


    echo "<br />";

    $file = fopen($_FILES['file']['tmp_name'],'r');
    $data = array();
    $header = null;
    while(($entry = fgetcsv($file,'0',';')) !== FALSE){
        if($header === null){
            $header = $entry;
            continue;
        }
        $data[] = array_combine($header,$entry);
    }
    fclose($file);

    foreach($data as $row){
        $date = $row['Datum'];
        $start_time = $row['Begintijd'];
        $end_time = $row['Eindtijd'];
        $room_id = model\Room::where('number','=',$row['Kamernummer'])->first()->id;
        $course_id = model\Course::where('name','=',$row['Vak'])->first()->id;
        $user_id = model\Users::where('user_number','=',$row['Docentnummer'])->first()->id;

        $lecture = LectureRepository::create($date, $start_time, $end_time, $room_id, $course_id, $user_id);

        if($row['Groep']){
        $groups = explode(',',str_replace(' ', '', $row['Groep']));
        foreach ($groups as $g){
            $group = model\Group::where('name','=',$g)->first();
            LectureRepository::assign($group,$lecture);
            }
        }

    }
    exit;
}

if(isset($_POST['create'])){
    $lecture = LectureRepository::create($_POST['date'], $_POST['start_time'], $_POST['end_time'], $_POST['room_id'], $_POST['course_id'], $_POST['user_id']);
    foreach ($_POST['groups'] as $g){
        $group = model\Group::find($g);
        LectureRepository::assign($group,$lecture);
    }
    header('location: '.MapStructureRepositorie::view().'lecture/all_lectures.php?q='.$q);
    exit;
}
if(isset($_GET['edit_lecture'])){
    Services\SessionHandler::setSession('edit_lecture',$_GET['lecture_id']);

    header("location:".MapStructureRepositorie::view().'lecture/editlecture.php');

}
if(isset($_POST['edit_lecture'])){
    $lecture = model\Lecture::find($_POST['lecture_id']);
    $lecture = LectureRepository::edit($lecture,$_POST['date'], $_POST['start_time'], $_POST['end_time'], $_POST['room_id'], $_POST['course_id'], $_POST['user_id']);
    $connected_group_ids = model\Lecture_has_groups::where('lecture_id','=',$lecture->id)->groupBy('group_id')->lists('group_id');
    foreach($connected_group_ids as $cgi){
        if(!in_array($cgi,$_POST['groups'])){
            LectureRepository::deleteGroupConnection($cgi,$lecture);
        }
    }
    foreach($_POST['groups'] as $g){
        if(!in_array($g,$connected_group_ids)){
            LectureRepository::assign($g,$lecture);
        }
    }

    Services\SessionHandler::setSession('edit_lecture',$_POST['lecture_id']);
    Services\SessionHandler::setSession('edit_lecture_success', 'Les is succesvol gewijzigd.');

    header("location:".MapStructureRepositorie::view().'lecture/all_lectures.php');
    exit;

}

if (isset($_GET['delete_lecture'])) {
    $lecture = model\Lecture::find($_GET['lecture_id']);

    LectureRepository::delete($lecture);

    Services\SessionHandler::setSession('delete_lecture', 'De les is succesvol verwijderd. ');
    header('location: '.MapStructureRepositorie::view().'lecture/all_lectures.php');
    exit;
}