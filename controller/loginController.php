<?php
include('controller.php');

if(isset($_GET['forgotPassword'])){
	$email = $_POST['email'];
    UserRepositorie::forgotPassword($email);
    Services\SessionHandler::setSession('user_forgot_success', 'Een e-mail is verstuurd met verdere instructies.');
    header('location: '.MapStructureRepositorie::view().'login.php');
    exit;
}

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