<?php
include('controller.php');

// Create the new notification

NotificationRepository::create(Auth::user()->id,$_POST['to_user'],$_POST['message'],'1');

// Get all notifications (Or certain ones)

	var_dump(NotificationRepository::get(Auth::user()->id)->get());


?>