<?php
	//Create User
include_once('../controller.php');
if(!isset($_GET['show']) && !isset($_GET['passwordReset']) && !isset($_POST['set_presence'])) {
    if (!Auth::user()->can('user')) {
        header("location: " . MapStructureRepositorie::error('401'));
        exit;
    }
}
if(isset($_GET['user_id'])){
    $user = model\Users::find($_GET['user_id']);
}

if(isset($_GET['create'])){
    $errors=array();
    if (model\Users::where('email','=', $_POST['email'])->first()) {
        $errors[]='Email is al in gebruik';
    }
    if (model\Users::where('user_number','=', $_POST['user_number'])->first()) {
        $errors[]='Gebruikerscode is al in gebruik';
    }
    if (count($errors)) {
        Services\SessionHandler::setSession('create_data', $_POST);
        Services\SessionHandler::setSession('errors', $errors);
        header('location:' .MapStructureRepositorie::view(). 'user/createuser.php');
        exit;
    }

    UserRepositorie::create($_POST['firstname'], $_POST['lastname'], $_POST['user_number'], $_POST['email'], $_POST['password'], $_POST['group_id']);


    Services\SessionHandler::setSession('user_add_succes', 'Gebruiker succesvol toegevoegd.');
    header('location:'.MapStructureRepositorie::view().'user/createuser.php');
    exit;
}

if (isset($_GET['passwordCheck'])) {
    echo (password_verify($_GET['password'],Auth::user()->password)) ? 1: 0;
    exit;
}
if(isset($_POST['csv'])){
    header('Content-type: text/plain; charset=utf-8');
    if(isset($_FILES['file']['name']))
        $target = MapStructureRepositorie::uploads();
    $target = $target.basename($_FILES['file']['name']);


    echo "<br />";

    $file = fopen($_FILES['file']['tmp_name'],'r');
    $data = array();
    $header = null;
    while(($entry = fgetcsv($file,'0',';')) !== FALSE){
        if($header === null){
            $header = $entry;
            continue;
        }
        $data[] = array_combine($header,$entry);
    }
    fclose($file);
    $inserted_user_ids = [];

    foreach($data as $row){
        $active = 1;
        $lastname = $row['Tussenvoegsel'].' '.$row['Achternaam'];
        if (!mb_check_encoding($lastname, 'UTF-8')){
            $lastname = utf8_encode($lastname);
        }
        $firstname = $row['Roepnaam'];
        if (!mb_check_encoding($firstname, 'UTF-8')){
            $firstname = utf8_encode($firstname);
        }
        $user_number = $row['Stud.nr.'];
        $email = $row['E-mailadres'];
        

        $user = model\Users::where('user_number','=',$user_number)->first();
        if(!$user){
            $user = UserRepositorie::create($firstname, $lastname, $user_number, $email, $password);
        }
        else{
            $user = UserRepositorie::update($user,['ignore_notification'=>1,'firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email]);
        }
        $inserted_user_ids[] = $user->id;


        $group = model\Group::where('name','=',$row['Groepsnaam'])->first();
        if(!$group){
            GroupRepository::create($row['Groepsnaam'],date('Y'),'1','1');
            $group = model\Group::where('name','=',$row['Groepsnaam'])->first();
        }

        GroupRepository::assignToGroup(intval($group->id),$user->id);
    }
    foreach(model\Users::get() as $user){
        if(!in_array($user->id,$inserted_user_ids)){
            $user->active = 0;
            $user->save();
        }
    }
    exit;
}

if(isset($_GET['update_view'])){
    Services\SessionHandler::setSession("edit_user", $user->id);
    header('location:'.MapStructureRepositorie::view().'user/updateuser.php');
    exit;
}

if(isset($_POST['jpg'])){
    if(!empty($_FILES)) {
        $tempFile = $_FILES['file']['tmp_name'];
        $target = "../../build/profilePic/";
        $targetFile = $target . basename($_FILES['file']['name']);
        if(file_exists($targetFile)){
            unlink($targetFile);
        }
        move_uploaded_file($tempFile, $targetFile);
    }
    exit;
}

if(isset($_GET['passwordReset'])){
    if (strlen($_POST['password']) < 6) {
        Services\SessionHandler::setSession('user_edit_passfail', 'Wachtwoord voldoet niet aan eisen');
        header('location:'.MapStructureRepositorie::view().'user/resetPassword.php?upr='.$_GET['upr']);
        exit;
    }

    elseif ($_POST['password2'] == $_POST['password']){
        UserRepositorie::update($user, $_POST);
        $upr = model\User_password_reset::where('id','=',$_GET['upr'])->first();
        $upr->delete();
        Services\SessionHandler::setSession('user_reset_succes', 'Nieuw wachtwoord toegepast.');
        header('location:'.MapStructureRepositorie::view().'login.php');
        exit;
    }

    elseif ($_POST['password2'] != $_POST['password']){
        Services\SessionHandler::setSession('user_edit_fail', 'Wachtwoorden komen niet overeen.');
        header('location:'.MapStructureRepositorie::view().'user/resetPassword.php?upr='.$_GET['upr']);
        exit;
    }  
}

if(isset($_GET['resetPassword'])){
    UserRepositorie::resetPassword($user);
    Services\SessionHandler::setSession('user_edit_succes', 'Wachtwoord succesvol gereset.');
    header('location:'.MapStructureRepositorie::view().'user/profile.php');
    exit;
}

if(isset($_GET['show'])) {
    $text = "Hallo";

    $mail = new \Services\Mail();
    $mail->setSendTo($user->email);
    $mail->setSubject('test');
    $mail->setBody($text);
//    $mail->send();

    Services\SessionHandler::setSession('user_data', $user->id);
    header('location:'.MapStructureRepositorie::view().'user/profile.php');
    exit;
}

if(isset($_GET['update'])){
  UserRepositorie::update($user, $_POST);
  Services\SessionHandler::setSession('user_edit_succes', 'Gebruiker succesvol gewijzigd.');
  header('location:'.MapStructureRepositorie::view().'user/updateuser.php');
  exit;
}

if(isset($_GET['updatePassword'])){
    if (strlen($_POST['password']) < 6) {
        Services\SessionHandler::setSession('user_edit_passfail', 'Wachtwoord voldoet niet aan eisen');
    }

    elseif ($_POST['password2'] == $_POST['password']){
        UserRepositorie::update($user, $_POST);
        Services\SessionHandler::setSession('user_edit_succes', 'Wachtwoord succesvol gewijzigd.');
    }

    elseif ($_POST['password2'] != $_POST['password']){
        Services\SessionHandler::setSession('user_edit_fail', 'Wachtwoorden komen niet overeen.');
    }
    
    header('location:'.MapStructureRepositorie::view().'user/changePassword.php');
    exit;
}
if(isset($_GET['delete_user'])){
  UserRepositorie::delete($user);
  Services\SessionHandler::setSession('user_delete_succes', 'Gebruiker succesvol verwijderd.');

  header("location:".MapStructureRepositorie::view()."user/allusers.php");
  exit;
}

if(isset($_POST['set_presence'])){
    PresenceRepository::setOwnPresence($_POST);

    Services\SessionHandler::setSession('present_user', 'Succesvol afgemeld');

    header("location:".MapStructureRepositorie::view()."user/presence/index.php");
    exit;
}

?>