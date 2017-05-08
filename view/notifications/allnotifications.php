<?php
    include_once('../includes/head.php');
?>

<a href="createnotification.php" class="btn btn-primary">New notification</a>

<?php
foreach(NotificationRepository::get(Auth::user()->id)->get() as $entry){
    echo '<div class="list-group"><a href="onenotification.php?id='.$entry->id.'" class="list-group-item">';
    echo '<h4 class="list-group-item-heading">';
	echo $entry->from_user()->fullname();
	echo '</h4>';
    echo '<p class="list-group-item-text">';
	echo $entry->message;
    echo '</p>';
	echo "<br />
	<form action='../../controller/notificationController.php' method='POST'>
	<input type='hidden' name='id' value='".$entry->id."'>
	<button name='delete' type='submit' class='btn btn-xs btn-danger'>Delete</button>
	</form>
	";
	echo "</a></div>";
}
?>

<?php
    include_once('../includes/footer.php');
?>