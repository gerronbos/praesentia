<?php
include('controller.php');
use model\Notifications;

// If it's a preset message, pick that
if(isset($_POST['test_notification'])){
	$message = "Dit is slechts een test notificatie";;
}
elseif(isset($_POST['new_user_created'])){
	$message = "Nieuwe gebruiker aangemaakt";
}
elseif(isset($_POST['teacher_assigned_to_course'])){
	$message = "Docent $docnaam is gekoppeld aan het vak $course";
}
elseif(isset($_POST['user_archived'])){
	$message = "Gebruiker is gearchiveerd";
}
elseif(isset($_POST['user_edited'])){
	$message = "Gebruiker is gewijzigd";
}
// otherwise just get the custom one.
if(isset($_POST['message'])){
	$message = $_POST['message'];
}
// If deletion is selected
if(isset($_POST['delete'])){
	$notification = Notifications::find($_POST['id']);
	$notification->delete();
}

// Create the new notification
if(isset($message)){
NotificationRepository::create(Auth::user()->id,$_POST['to_user'],$message,'1');
}

header("Location: ../view/notifications/allnotifications.php");
?>