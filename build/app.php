<?php
ob_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

Services\SessionHandler::executeSessions();

Auth::updateLogin();

?>