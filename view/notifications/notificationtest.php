<?php
    include_once('../includes/head.php');
?>

	<div class="form-group">
	<form action="../controller/NotificationController.php" method="POST">
		<label for="to_user">to_user</label><br />
		<input class="form-control" type="text" name="to_user"><br />

		<label for="message">message</label><br />
		<input class="form-control" type="text" name="message"><br />

		<button class="btn btn-primary" type="submit">Submit</button>
	</form>
	</div>

<?php
    include_once('../includes/footer.php');
?>