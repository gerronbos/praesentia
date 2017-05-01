<?php
ob_start();
/*
 * Config bestanden
 * Hier staan gegevens van de website in
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/build/config.php');
/*
 * Models
 * Database connecties
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/Users.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/Course.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/Group.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/Lecture.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/Presence.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/Room.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/Notifications.php');

/*
 * Services
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/services/auth.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/services/sessionhandler.php');

/*
 * Repositories
 * Hier worden dingen berekent of opgehaald
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/repositories/Repository.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/repositories/ConfigRepositorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/repositories/MapStructureRepositorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/repositories/FormRepositorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/repositories/NotificationRepository.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/repositories/UserRepositorie.php');



Auth::updateLogin();

?>