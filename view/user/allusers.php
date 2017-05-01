<?php
include_once('../includes/head.php');
echo "<table class='table table-bordered'><tr><th>Naam</th><th>Gebruikersnummer</th><th>Email</th><th>Opties</th></tr>";
foreach (model\Users::get() as $user) {
	echo "<tr><td>".$user->fullname()."</td><td>$user->user_number</td><td>$user->email</td><td>
		<a href='".MapStructureRepositorie::controller()."user/updateUserController.php?user_id=$user->id' class='btn btn-primary'>Wijzigen</a>
		<button type='button' class='btn btn-danger'>Verwijderen</button>
	</td></tr>";
}
echo "</table>";

?>

<?php
include_once('../includes/footer.php');
?>