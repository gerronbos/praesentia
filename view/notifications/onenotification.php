<?php
    include_once('../includes/head.php');
    use model\Notifications;
    $notification = Notifications::find($_GET['id']);
    echo '<a href="allnotifications.php" class="btn btn-primary">Naar Overzicht</a>';
    echo '<div class="panel panel-info"><div class="panel-heading">';
    echo '<b>'.$notification->from_user()->fullname().'</b>';
    echo '</div><div class="panel-body">';
    echo $notification->message;
    echo '</div><div class="panel-footer">';
	echo "
	<form action='../../controller/notificationController.php' method='POST'>
	<input type='hidden' name='id' value='".$notification->id."'>
	<button name='delete' type='submit' class='btn btn-xs btn-danger'>Delete</button>
	</form>
	";
	echo "</div></div>";
    NotificationRepository::setSeen($notification); 

?>

<?php
    include_once('../includes/footer.php');
?>