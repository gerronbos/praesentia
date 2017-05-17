<?php
include_once('../includes/head.php');
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Groepen </h2>
		<?php
			echo "<a href='".MapStructureRepositorie::view()."group/creategroup.php' class='btn btn-primary' style='float: right'>Nieuwe Groep</a>";
		?>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<?php

		echo "<table class='table table-bordered'><tr><th>Naam</th><th>Schooljaar</th><th>Periode</th><th>Opties</th></tr>";
		foreach (model\Group::orderBy('name','asc')->get() as $group) {
			echo "<tr><td>".$group->name."</td><td>$group->school_year</td><td>$group->period</td><td>
			<a href='".MapStructureRepositorie::controller()."group/groupController.php?update_view=1&group_id=$group->id' class='btn btn-primary'>Wijzigen</a>
			<a href='".MapStructureRepositorie::controller()."group/groupController.php?delete_group=1&group_id=$group->id' class='btn btn-danger'>Verwijderen</a>
			<a href='".MapStructureRepositorie::controller()."group/groupController.php?viewgroup=1&group_id=$group->id' class='btn btn-info'>Weergeven</a>
		</td></tr>";
	}
	echo "</table>";


	?>
</div>
</div>
<?php
include_once('../includes/footer.php');
?>