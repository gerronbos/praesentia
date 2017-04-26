<?php
	include_once('includes/head.php');

	echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'createUserController.php', 'file' => 1, 'method' => 'POST']);
	echo FormRepositorie::text('Voornaam', '',['name'=>'firstname']);
	echo FormRepositorie::text('Achternaam', '', ['name'=>'lastname']);
	echo FormRepositorie::text('Studentnummer', '', ['name'=>'user_number']);
	echo FormRepositorie::text('Email', '', ['name'=>'email']);
	echo FormRepositorie::text('Wachtwoord', '', ['name'=>'password']);	
	echo FormRepositorie::formSaveButton('#');
	echo FormRepositorie::closeForm();
?>

<?php
	include_once('includes/footer.php');
?>