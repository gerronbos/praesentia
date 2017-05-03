<?php
    include_once('../includes/head.php');
?>

	<div class="form-group">
	<form action="../controller/NotificationController.php" method="POST">
		<input type="hidden" name="to_user" value="<?php echo '2';?>">
		<button class="btn btn-primary" type="submit" name="test_notification">Send test notification</button>
		<button class="btn btn-primary" type="submit" name="new_user_created">Send New User notification</button>
		<button class="btn btn-primary" type="submit" name="user_archived">Send User Archived notification</button>
		<button class="btn btn-primary" type="submit" name="import_successful">Send Import Success notification</button>
	</form>
	</div>

<?php
    include_once('../includes/footer.php');
?>