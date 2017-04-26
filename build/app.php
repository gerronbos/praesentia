<?php
ob_start();

/*
 * Config bestanden
 * Hier staan gegevens van de website in
 */
require_once('config.php');
/*
 * Models
 * Database connecties
 */
require_once('../model/model.php');
require_once('../model/Users.php');
require_once('../model/Course.php');
require_once('../model/Group.php');
require_once('../model/Lecture.php');
require_once('../model/Presence.php');
require_once('../model/Room.php');

/*
 * Services
 */
require_once('../services/auth.php');
require_once('../services/sessionhandler.php');

/*
 * Repositories
 * Hier worden dingen berekent of opgehaald
 */
require_once('../repositories/Repository.php');
require_once('../repositories/ConfigRepositorie.php');
require_once('../repositories/MapStructureRepositorie.php');
require_once('../repositories/FormRepositorie.php');
require_once('../repositories/UserRepositorie.php');

?>