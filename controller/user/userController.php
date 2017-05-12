<?php
	//Create User
	include_once('../controller.php');

	if(isset($_GET['create'])){
		UserRepositorie::create($_POST['firstname'], $_POST['lastname'], $_POST['user_number'], $_POST['email'], $_POST['password']);

		Services\SessionHandler::setSession('user_add_succes', 'Gebruiker succesvol toegevoegd.');
		header('location:'.MapStructureRepositorie::view().'user/createuser.php');
		exit;
	}

	$user = model\Users::find($_GET["user_id"]);

	if(isset($_GET['update'])){
		UserRepositorie::update($user, $_POST['firstname'], $_POST['lastname'], $_POST['user_number'], $_POST['email']);
		Services\SessionHandler::setSession('user_edit_succes', 'Gebruiker succesvol gewijzigd.');
		header('location:'.MapStructureRepositorie::view().'user/updateuser.php');
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
            $lastname = $row['Tussenvoegsel'].' '.$row['Achternaam'];
            $firstname = $row['Roepnaam'];
            $user_number = $row['Stud.nr.'];
            $email = $row['E-mailadres'];
            $password = '123';

            UserRepositorie::create($firstname, $lastname, $user_number, $email, $password);
        }
    }
?>