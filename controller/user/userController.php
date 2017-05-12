<?php
	//Create User
	include_once('../controller.php');

	if(isset($_GET['create'])){
		UserRepositorie::create($_POST['firstname'], $_POST['lastname'], $_POST['user_number'], $_POST['email'], $_POST['password']);

		Services\SessionHandler::setSession('user_add_succes', 'Gebruiker succesvol toegevoegd.');
		header('location:'.MapStructureRepositorie::view().'user/createuser.php');
		exit;
	}

	$user = model\Users::find($_GET["user_id"]);

	if(isset($_GET['update'])){
		UserRepositorie::update($user, $_POST['firstname'], $_POST['lastname'], $_POST['user_number'], $_POST['email']);
		Services\SessionHandler::setSession('user_edit_succes', 'Gebruiker succesvol gewijzigd.');
		header('location:'.MapStructureRepositorie::view().'user/updateuser.php');
		exit;
	}
	if(isset($_GET['update_view'])){
		Services\SessionHandler::deleteSession("edit_user");
		Services\SessionHandler::setSession("edit_user", $user);

		header("location:".MapStructureRepositorie::view()."user/updateuser.php");
		exit;
	}
	if(isset($_GET['delete_user'])){
		UserRepositorie::delete($user);
		Services\SessionHandler::setSession('user_delete_succes', 'Gebruiker succesvol verwijderd.');

		header("location:".MapStructureRepositorie::view()."user/allusers.php");
		exit;
	}
	if (isset($_GET['passwordCheck'])) {
		echo 1; 
		exit;
	}
?>