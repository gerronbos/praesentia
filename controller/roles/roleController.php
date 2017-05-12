<?php

include('../controller.php');



if($_POST['create']){
    RoleRepository::create($_POST);

    Services\SessionHandler::createSession('alert_roles','Rechten Sjabloon succesvol toegevoegd!');
    Header('location:'.MapStructureRepositorie::view()."roles/index.php");
    exit;
}