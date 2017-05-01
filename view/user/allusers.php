<?php
include_once('../includes/head.php');

if(Services\SessionHandler::has('user_delete_succes')){
		echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('user_delete_succes').'</div></div>';
	}

echo "<table class='table table-bordered'><tr><th>Naam</th><th>Gebruikersnummer</th><th>Email</th><th>Opties</th></tr>";
foreach (model\Users::get() as $user) {
	echo "<tr><td>".$user->fullname()."</td><td>$user->user_number</td><td>$user->email</td><td>
		<a href='".MapStructureRepositorie::controller()."user/userController.php?update_view=1&user_id=$user->id' class='btn btn-primary'>Wijzigen</a>
		<a href='".MapStructureRepositorie::controller()."user/userController.php?delete_user=1&user_id=$user->id' class='btn btn-danger'>Verwijderen</a>
	</td></tr>";
}
echo "</table>";

?>

<?php
include_once('../includes/footer.php');
?>