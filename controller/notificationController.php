<?php
include('controller.php');

// Create the new notification

NotificationRepository::create(Auth::user()->id,$_POST['to_user'],$_POST['message'],'1');

header("Location: ../view/notificationview.php");
?>