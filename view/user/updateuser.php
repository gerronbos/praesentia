<?php
include_once('../includes/head.php');
if (!Auth::user()->can('user')) {
	header("location: " . MapStructureRepositorie::error('401'));
	exit;
}
$user = model\Users::find(Services\SessionHandler::getSession('edit_user'));
?>
<div class="x_panel">
	<div class="x_titel">
		<h2>Gebruiker wijzigen</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	
	<div class="x_content">
		<?php
		if(Services\SessionHandler::has('user_edit_succes')){
			echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('user_edit_succes').'</div></div>';
		}
        $group_id = 1;
        if($user->Group()){
            $group_id = $user->Group()->id;
        }

		echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'user/userController.php?user_id='.$user->id.'&update=1', 'file' => 1, 'method' => 'POST']);
		echo FormRepositorie::text('Voornaam', $user->firstname,['name'=>'firstname']);
		echo FormRepositorie::text('Achternaam', $user->lastname, ['name'=>'lastname']);
		echo FormRepositorie::text('Studentnummer', $user->user_number, ['name'=>'user_number']);
		echo FormRepositorie::text('Email', $user->email, ['name'=>'email']);	
		echo FormRepositorie::select('Groep', GroupRepository::getGroupsArray(),$group_id , ['name'=>'group_id']);
		echo FormRepositorie::formSaveButton('allusers.php');
		echo FormRepositorie::closeForm();
		?>
	</div>
</div>

<?php
include_once('../includes/footer.php');
?>