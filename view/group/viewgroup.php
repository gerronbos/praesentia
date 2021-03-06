<?php
include_once('../includes/head.php');
if (!Auth::user()->can('groups')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
$group = Services\SessionHandler::getSession('group_data');

?>
<div class="x_panel">
	<div class="x_title">
		<h2>Groep: <?php echo $group->name; ?> </h2>
		<?php
			echo "<a href='".MapStructureRepositorie::view()."group/creategroup.php' class='btn btn-primary' style='float: right'>Nieuwe Groep</a>";
		?>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<?php

		if(Services\SessionHandler::has('group_delete_succes')){
			echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('group_delete_succes').'</div></div>';
		}


		echo "<table class='table table-bordered'><tr><th>Naam</th><th>Gebruikersnummer</th><th>Email</th><th>Opties</th></tr>";
		foreach($group->Users() as $user){
			echo "<tr><td>".$user->fullname()."</td><td>$user->user_number</td><td>$user->email</td><td>
			<a href='".MapStructureRepositorie::controller()."user/userController.php?update_view=1&user_id=$user->id' class='btn btn-primary'>Wijzigen</a>
			<a href='".MapStructureRepositorie::controller()."user/userController.php?delete_user=1&user_id=$user->id' class='btn btn-danger'>Verwijderen</a>
			<a href='".MapStructureRepositorie::controller()."user/userController.php?show=1&user_id=$user->id' class='btn btn-info'>Profiel</a>
		</td></tr>";
	}

		echo "</table>";
	?>
</div>
</div>
<?php
include_once('../includes/footer.php');
?>