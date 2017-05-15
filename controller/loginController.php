<?php
include('controller.php');
if(isset($_POST['stayLoggedIn'])){
    $stayLoggedIn = 1;
}
else{
    $stayLoggedIn = 0;
}
if(Auth::login(['stayloggedin'=>$stayLoggedIn],$_POST['email'],$_POST['password'])){
    header('location:../view/index.php');
    exit;
}
header('location:../view/login.php');


?>