<?php

include_once('../controller.php');

if(isset($_POST['create'])){
    RoomRepository::create($_POST);

    Services\SessionHandler::setSession('room_create','Lokaal succesvol aangemaakt!');
    header('location: '.MapStructureRepositorie::view().'room/index.php');
}