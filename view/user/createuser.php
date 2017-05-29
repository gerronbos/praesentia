<?php
include_once('../includes/head.php');
if(!Auth::user()->can('user')){
	header("location: ".MapStructureRepositorie::error('401'));
	exit;
}
?>

<div class="x_panel">
	<div class="x_title">
		<h2>Gebruiker aanmaken</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
		<?php
		if(Services\SessionHandler::has('user_add_succes')){
			echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('user_add_succes').'</div></div>';
		}
		if(Services\SessionHandler::has('errors')){
			$errors = Services\SessionHandler::getAndDelete('errors');
			foreach($errors as $error){
				echo '<div class="col-lg-12"><div class="alert alert-danger" role="alert">'.$error.'</div></div>';
			}
			
		}

		echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'user/userController.php?create=1', 'file' => 1, 'method' => 'POST', 'id' => 'create']);
		echo FormRepositorie::text('Voornaam', '',['name'=>'firstname', 'required' => 1, 'data-remote' => '/validate']);
		echo FormRepositorie::text('Achternaam', '', ['name'=>'lastname', 'required' => 1]);
		echo FormRepositorie::text('Studentnummer', '', ['name'=>'user_number', 'required' => 1]);
		echo FormRepositorie::text('Email', '', ['name'=>'email', 'required' => 1]);
		echo FormRepositorie::password('Wachtwoord', '', ['name'=>'password', 'required' => 1]);	
		echo FormRepositorie::select('Groep', GroupRepository::getGroupsArray(), '1', ['name'=>'group_id']);
		echo FormRepositorie::formSaveButton("javascript:history.back()");
		echo FormRepositorie::closeForm();
		?>
	</div>
</div>

<?php
include_once('../includes/footer.php');
?>