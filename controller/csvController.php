<?php
	include('controller.php');

		var_dump($_FILES);
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
		header("Location: ".MapStructureRepositorie::view()."user/allusers.php");
?>