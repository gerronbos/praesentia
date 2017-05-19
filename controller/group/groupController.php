<?php
include_once('../controller.php');
if (!Auth::user()->can('groups')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
	if(isset($_POST['create'])){
		GroupRepository::create($_POST['name'],$_POST['school_year'],$_POST['period'],$_POST['education_id']);
		header("location:".MapStructureRepositorie::view()."group/creategroup.php");
	}
	
	if(isset($_GET['viewgroup'])){
		$group = model\Group::find($_GET['group_id']);
		Services\SessionHandler::setSession('group_data',$group);
        header("location:".MapStructureRepositorie::view()."group/viewgroup.php");
        exit;
	}

?>