<?php
	include_once('../includes/head.php');
	$user = Services\SessionHandler::getSession('edit_user');
	?>
	
	<?php
	if(Services\SessionHandler::has('user_edit_succes')){
		echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('user_edit_succes').'</div></div>';
	}

	echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'user/userController.php?user_id='.$user->id.'&update=1', 'file' => 1, 'method' => 'POST']);
	echo FormRepositorie::text('Voornaam', $user->firstname,['name'=>'firstname']);
	echo FormRepositorie::text('Achternaam', $user->lastname, ['name'=>'lastname']);
	echo FormRepositorie::text('Studentnummer', $user->user_number, ['name'=>'user_number']);
	echo FormRepositorie::text('Email', $user->email, ['name'=>'email']);	
	echo FormRepositorie::select('Groep', GroupRepository::getGroupsArray(), '1', ['name'=>'group_id']);
	echo FormRepositorie::formSaveButton('allusers.php');
	echo FormRepositorie::closeForm();
?>

<?php
	include_once('../includes/footer.php');
?>