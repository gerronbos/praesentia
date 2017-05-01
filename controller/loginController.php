<?php
include('controller.php');
if(Auth::login([],$_POST['email'],$_POST['password'])){
    header('location:../view/index.php');
    exit;
}
header('location:../view/login.php');


?>