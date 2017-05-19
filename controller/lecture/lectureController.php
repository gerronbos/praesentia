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
        $return[] = ['id'=>$lecture->id,'start_time'=>$lecture->start_time,'end_time'=>$lecture->end_time,'course'=>$lecture->Course()->name];
    }
    echo json_encode($return);
    exit;
}