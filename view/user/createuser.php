<?php
	include_once('../includes/head.php');
if(!Auth::user()->can('user')){
    header("location: ".MapStructureRepositorie::error('401'));
    exit;
}
	?>
	
	<?php
	if(Services\SessionHandler::has('user_add_succes')){
		echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('user_add_succes').'</div></div>';
	}

	echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'user/userController.php?create=1', 'file' => 1, 'method' => 'POST']);
	echo FormRepositorie::text('Voornaam', '',['name'=>'firstname', 'required' => 1]);
	echo FormRepositorie::text('Achternaam', '', ['name'=>'lastname', 'required' => 1]);
	echo FormRepositorie::text('Studentnummer', '', ['name'=>'user_number', 'required' => 1]);
	echo FormRepositorie::text('Email', '', ['name'=>'email', 'required' => 1]);
	echo FormRepositorie::password('Wachtwoord', '', ['name'=>'password', 'required' => 1]);	
	echo FormRepositorie::formSaveButton("javascript:history.back()");
	echo FormRepositorie::closeForm();
?>

<?php
	include_once('../includes/footer.php');
?>