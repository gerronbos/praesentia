<?php
include('controller.php');
if(Auth::login(['email' => $_POST['email'],'password'=>$_POST['password']])){
    header('location:../view/index.php');
    exit;
}
header('location:../view/login.php');


?>