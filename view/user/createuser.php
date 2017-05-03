<?php
	include_once('../includes/head.php');
	?>
	
	<?php
	if(Services\SessionHandler::has('user_add_succes')){
		echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('user_add_succes').'</div></div>';
	}

	echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'user/userController.php?create=1', 'file' => 1, 'method' => 'POST']);
	echo FormRepositorie::text('Voornaam', '',['name'=>'firstname']);
	echo FormRepositorie::text('Achternaam', '', ['name'=>'lastname']);
	echo FormRepositorie::text('Studentnummer', '', ['name'=>'user_number']);
	echo FormRepositorie::text('Email', '', ['name'=>'email']);
	echo FormRepositorie::password('Wachtwoord', '', ['name'=>'password']);	
	echo FormRepositorie::formSaveButton('../index.php');
	echo FormRepositorie::closeForm();
?>

<?php
	include_once('../includes/footer.php');
?>