<?php
include_once('/controller.php');
	if(isset($_POST['create'])){
		GroupRepository::create($_POST['name'],$_POST['school_year'],$_POST['period'],$_POST['education_id']);
	}
	
	if(isset($_GET['viewgroup'])){
		$group = model\Group::find($_GET['group_id']);
		$group_has_users = model\Group_has_users::find($_GET['group_id']);
		Services\SessionHandler::setSession('group_data',$group);
		Services\SessionHandler::setSession('group_has_users_data',$group_has_users);
        header("location:".MapStructureRepositorie::view()."group/viewgroup.php?group_id=".$_GET['group_id']);
        exit;
	}

?>