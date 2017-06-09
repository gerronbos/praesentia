<?php

include_once('../controller.php');

if(isset($_POST['create'])){
    RoomRepository::create($_POST);

    Services\SessionHandler::setSession('room_create','Lokaal succesvol aangemaakt!');
    header('location: '.MapStructureRepositorie::view().'room/index.php');
}

if(isset($_GET['update_view'])){
		Services\SessionHandler::setSession('room_data',$_GET['room_id']);

        header("location:".MapStructureRepositorie::view()."room/editRoom.php");
        exit;
	}

if(isset($_GET['update'])){
		$room = model\Room::find($_GET['room_id']);
		RoomRepository::update($room, $_POST);

		Services\SessionHandler::setSession('room_edit_succes', 'Lokaal succesvol gewijzigd.');
		header('location:'.MapStructureRepositorie::view().'room/index.php');
		exit;
	}

if(isset($_GET['delete'])){
		$room = model\Room::find($_GET['room_id']);
		RoomRepository::delete($room);
		Services\SessionHandler::setSession('room_delete_succes', 'Lokaal succesvol verwijderd.');

		header("location:".MapStructureRepositorie::view()."room/index.php");
		exit;
	}