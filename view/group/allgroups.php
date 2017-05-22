<?php
include_once('../includes/head.php');
if (!Auth::user()->can('groups')) {
	header("location: " . MapStructureRepositorie::error('401'));
	exit;
}
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
		if(Services\SessionHandler::has('group_add_succes')){
			echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('group_add_succes').'</div></div>';
		}
		if(Services\SessionHandler::has('group_delete_succes')){
			echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('group_delete_succes').'</div></div>';
		}
		if(Services\SessionHandler::has('group_edit_succes')){
			echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('group_edit_succes').'</div></div>';
		}

		echo "<table class='table table-bordered'><tr><th>Naam</th><th>Schooljaar</th><th>Periode</th><th>Opties</th></tr>";
		foreach (model\Group::orderBy('name','asc')->get() as $group) {
			echo "<tr><td>".$group->name."</td><td>$group->school_year</td><td>$group->period</td><td>
			<a href='".MapStructureRepositorie::controller()."group/groupController.php?update_view=1&group_id=$group->id' class='btn btn-primary'>Wijzigen</a>
			<button group_id='$group->id' class='btn btn-danger delete_group'>Verwijderen</button>
			<a href='".MapStructureRepositorie::view()."group/groupProfile.php?group_id=$group->id' class='btn btn-info'>Weergeven</a>
		</td></tr>";
	}
	echo "</table>";


	?>
</div>
</div>
<?php
include_once('../includes/footer.php');
?>
<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title text-center">Groep Verwijderen</h4>
			</div>
			<div class="modal-body">
				<p class="text-center">Weet u zeker dat u de groep wilt verwijderen?</p>
			</div>
			<div class="modal-footer">
				<a href="#" data-dismiss="modal" class="btn btn-danger">Nee</a>
				<a href="" class="btn btn-success delete_url">Ja</a>
			</div>
		</div>
	</div>
</div>

<script>

	var url = '<?php echo MapStructureRepositorie::controller()."group/GroupController.php?delete_group=1&group_id=:id" ?>';
	var group_id = '';
	$('.delete_group').click(function(){
		group_id = $(this).attr('group_id');
		$('#myModal').modal();

	});
	$('#myModal').on('show.bs.modal',function(){
		console.log('hi');
		$('.delete_url').attr('href',url.replace(':id',group_id));
	});
</script>