<?php
	//Create User
	include_once('../controller.php');
if(!isset($_GET['show'])) {
    if (!Auth::user()->can('user')) {
        header("location: " . MapStructureRepositorie::error('401'));
        exit;
    }
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

		UserRepositorie::create($_POST['firstname'], $_POST['lastname'], $_POST['user_number'], $_POST['email'], $_POST['password']);


		Services\SessionHandler::setSession('user_add_succes', 'Gebruiker succesvol toegevoegd.');
		header('location:'.MapStructureRepositorie::view().'user/createuser.php');
		exit;
	}

    if (isset($_GET['passwordCheck'])) {
        echo (password_verify($_GET['password'],Auth::user()->password)) ? 1: 0;
        exit;
    }
    if(isset($_POST['csv'])){
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

        foreach($data as $row){
            $active = 1;
            $lastname = $row['Tussenvoegsel'].' '.$row['Achternaam'];
            $firstname = $row['Roepnaam'];
            $user_number = $row['Stud.nr.'];
            $email = $row['E-mailadres'];
            $password = '123';

            $user = model\Users::where('user_number','=',$user_number)->first();
            if(!$user){
                $user = UserRepositorie::create($firstname, $lastname, $user_number, $email, $password);
            }

            $group = model\Group::where('name','=',$row['Groepsnaam'])->first();
            if(!$group){
                GroupRepository::create($row['Groepsnaam'],date('Y'),'1','1');
                $group = model\Group::where('name','=',$row['Groepsnaam'])->first();
            }

            GroupRepository::assignToGroup(intval($group->id),$user->id);
        }
        exit;
    }
	$user = model\Users::find($_GET["user_id"]);

    if(isset($_GET['resetPassword'])){
        UserRepositorie::resetPassword($user);
        Services\SessionHandler::setSession('user_edit_succes', 'Wachtwoord succesvol gereset.');
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
        UserRepositorie::update($user, $_POST);
        Services\SessionHandler::setSession('user_edit_succes', 'Wachtwoord succesvol gewijzigd.');
        header('location:'.MapStructureRepositorie::view().'user/changePassword.php');
        exit;
    }
	if(isset($_GET['update_view'])){
		Services\SessionHandler::deleteSession("edit_user");
		Services\SessionHandler::setSession("edit_user", $user);

		header("location:".MapStructureRepositorie::view()."user/updateuser.php");
		exit;
	}
	if(isset($_GET['delete_user'])){
		UserRepositorie::delete($user);
		Services\SessionHandler::setSession('user_delete_succes', 'Gebruiker succesvol verwijderd.');

		header("location:".MapStructureRepositorie::view()."user/allusers.php");
		exit;
	}
    if(isset($_GET['show'])){

        Services\SessionHandler::setSession('user_data',$user);

        header("location:".MapStructureRepositorie::view()."user/profile.php");
        exit;
    }
    
?>