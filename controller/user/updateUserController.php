<?php
	include_once('../controller.php');

	$user = model\Users::find($_GET["user_id"]);

	if(isset($_GET['update'])){
		UserRepositorie::update($user, $_POST['firstname'], $_POST['lastname'], $_POST['user_number'], $_POST['email']);
		Services\SessionHandler::setSession('user_edit_succes', 'Gebruiker succesvol gewijzigd.');
	}
	else{
		Services\SessionHandler::deleteSession("edit_user");
		Services\SessionHandler::setSession("edit_user", $user);

		header("location:".MapStructureRepositorie::view()."user/updateuser.php");
	}

	
	header('location:'.MapStructureRepositorie::view().'user/updateuser.php')
?>