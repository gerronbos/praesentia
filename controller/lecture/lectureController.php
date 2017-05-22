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
    $lectures = LectureRepository::get(['q'=>$q])->get();
    foreach($lectures as $lecture){
        $return[] = ['id'=>$lecture->id,'course_id'=>$lecture->course_id,'date'=>$lecture->date,'start_time'=>$lecture->start_time,'end_time'=>$lecture->end_time,'1','user_id'=>$lecture->user_id,'room_id'=>$lecture->room_id];
    }
    Services\SessionHandler::setSession('lecture',$return);

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
}
if(isset($_GET['edit_lecture'])){
    $lecture = model\Lecture::find($_GET['lecture_id']);
    Services\SessionHandler::setSession('edit_lecture',$lecture);

    header("location:".MapStructureRepositorie::view().'lecture/editlecture.php');

}
if(isset($_POST['edit_lecture'])){
    $lecture = LectureRepository::create($_POST['date'], $_POST['start_time'], $_POST['end_time'], $_POST['room_id'], $_POST['course_id'], $_POST['user_id']);
    foreach ($_POST['groups'] as $g){
        $group = model\Group::find($g);
        LectureRepository::assign($group,$lecture);
    }
}