<?php
    include_once('../includes/head.php');
?>

<a href="createnotification.php" class="btn btn-primary">Nieuw bericht</a>

<div class="list-group">
<?php
foreach(NotificationRepository::get(Auth::user()->id)->orderBy('id','DESC')->get() as $entry){
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
    echo '</h4>';
    echo '<p class="list-group-item-text">';
    echo $entry->message;
    echo '</p>';
	echo "</a>";
}
?>
</div>

<?php
    include_once('../includes/footer.php');
?>