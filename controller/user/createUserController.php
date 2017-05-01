<?php
	include('../controller.php');

	UserRepositorie::create($_POST['firstname'], $_POST['lastname'], $_POST['user_number'], $_POST['email'], $_POST['password']);

	Services\SessionHandler::setSession('user_add_succes', 'Gebruiker succesvol toegevoegd.');
	header('location:'.MapStructureRepositorie::view().'user/createuser.php')
?>