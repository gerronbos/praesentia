<?php
	include_once('../controller.php');

	$user=model\User::find($_GET["user_id"]);


	Services\SessionHandler::setSession("user", serialize($user));


	header("location:".MapStructureRepositorie::view()."user/updateuser.php");
?>