<?php
    include_once('includes/head.php');
?>

<a href="notificationtest.php" class="btn btn-primary">New notification</a>

<div class="form-group">
	<form action="#" method="GET">
		<label for="filter">Filter</label><br />
		<input type="radio" name="filter" id="none" value="">
		<label for="none">none</label><br />
		<input type="radio" name="filter" id="onlyUnseen" value="onlyUnseen">
		<label for="onlyUnseen">onlyUnseen</label><br />
		<input type="radio" name="filter" id="onlySeen" value="onlySeen">
		<label for="onlySeen">onlySeen</label><br />
		<input type="radio" name="filter" id="onID" value="onID">
		<label for="onID">onID</label><br />

		<button class="btn btn-primary" type="submit">Submit</button>
	</form>
</div>

<table class="table table-bordered"> 
<?php
var_dump(Auth::user());
foreach(NotificationRepository::get(Auth::user()->id)->get() as $entry){
	echo "<tr>";
	echo "<td>";
	echo $entry->from_user()->firstname;
	echo "</td>";
	echo "<td>";
	echo $entry->message;
	echo "</td>";
	echo "</tr>";
}
?>
</table>

<?php
    include_once('includes/footer.php');
?>