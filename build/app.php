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



Services\SessionHandler::save();
?>