<?php
include_once('../controller.php');
if (!Auth::user()->can('groups')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
	if(isset($_GET['create'])){
		$group_exists = model\Group::where('name','=',$_POST['name'])->first();
        
        if($group_exists->name == $_POST['name']){
        	Services\SessionHandler::setSession('inputdata', $_POST);
            Services\SessionHandler::setSession('group_exists_or_active', 'Groep bestaat al.');
            header("location:".MapStructureRepositorie::view()."group/creategroup.php");
            exit;
        }else{
		GroupRepository::create($_POST['name'],$_POST['school_year'],$_POST['period'],$_POST['education_id']);
		}

		Services\SessionHandler::setSession('group_add_succes', 'Groep succesvol toegevoegd.');
		header("location:".MapStructureRepositorie::view()."group/allgroups.php");
		exit;
	}
	
	if(isset($_GET['update_view'])){
		Services\SessionHandler::setSession('group_data',$_GET['group_id']);

        header("location:".MapStructureRepositorie::view()."group/editgroup.php");
        exit;
	}

	if (isset($_GET['group_profile'])) {
		$group = model\Group::find($_GET['group_id']);

		header("location:".MapStructureRepositorie::view()."group/groupProfile.php");

		exit;
	}

	if(isset($_GET['delete_group'])){
		$group = model\Group::find($_GET['group_id']);
		GroupRepository::delete($group);
		Services\SessionHandler::setSession('group_delete_succes', 'Groep succesvol verwijderd.');

		header("location:".MapStructureRepositorie::view()."group/allgroups.php");
		exit;
	}

	if(isset($_GET['update'])){
		$group = model\Group::find($_GET['group_id']);
		GroupRepository::update($group, $_POST);
		Services\SessionHandler::setSession('group_edit_succes', 'Groep succesvol gewijzigd.');
		header('location:'.MapStructureRepositorie::view().'group/allgroups.php');
		exit;
	}
?>