<?php
include_once('../controller.php');
	if(isset($_POST['create'])){
		GroupRepository::create($_POST['name'],$_POST['school_year'],$_POST['period'],$_POST['education_id']);
	}
	
	if(isset($_GET['viewgroup'])){
		$group = model\Group::find($_GET['group_id']);
		Services\SessionHandler::setSession('group_data',$group);
        header("location:".MapStructureRepositorie::view()."group/viewgroup.php");
        exit;
	}

?>