<?php
    include_once('../includes/head.php');
    use model\Notifications;
    $entry = Notifications::find($_GET['id']);
    echo '<a href="allnotifications.php" class="btn btn-primary">Naar Overzicht</a>';
    echo '<a href="onenotification.php?id='.$entry->id.'" class="list-group-item">';
    echo '<h4 class="list-group-item-heading">';
    echo $entry->from_user()->fullname();
    echo "<span class='pull-right'>
	<form action='../../controller/notificationController.php' method='POST'>
	<input type='hidden' name='id' value='".$entry->id."'>
	<button name='delete' type='submit' class='btn-link glyphicon glyphicon-remove'></button>
	</form>
	</span>
	";
    echo "<span class='pull-right' style='margin-right:10px;'>".time_ago($entry->created_at)." (".$entry->created_at.")</span>";
    echo '</h4>';
    echo '<p class="list-group-item-text">';
    echo $entry->message;
    echo '</p>';
	echo "</a>";
    NotificationRepository::setSeen($entry); 

?>

<?php
    include_once('../includes/footer.php');
?>