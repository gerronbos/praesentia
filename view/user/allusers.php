<?php
include_once('../includes/head.php');
if(!Auth::user()->can('user')){
	header("location: ".MapStructureRepositorie::error('401'));
	exit;
}
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Gebruikers </h2>
		<?php
		echo "<a href='".MapStructureRepositorie::view()."user/createuser.php' class='btn btn-primary' style='float: right'>Nieuwe Gebruiker</a>";
		?>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<?php

		if(Services\SessionHandler::has('user_delete_succes')){
			echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('user_delete_succes').'</div></div>';
		}
		
		echo "<div class='table-responsive'>";
		echo "<table class='table table-bordered table-responsive'><tr><th>Naam</th><th>Gebruikersnummer</th><th>Email</th><th>Opties</th></tr>";
		foreach (model\Users::orderBy('lastname','asc')->where('active','=',1)->get() as $user) {
			echo "<tr><td>".$user->fullnameReturned(['url'=>1])."</td><td>$user->user_number</td><td>$user->email</td><td>
			<a href='".MapStructureRepositorie::controller()."user/userController.php?update_view=1&user_id=$user->id' class='btn btn-primary'>Wijzigen</a>
			<button user_id='$user->id' class='btn btn-danger delete_user'>Verwijderen</button>
			<a href='".MapStructureRepositorie::controller()."user/userController.php?show=1&user_id=$user->id' class='btn btn-info'>Profiel</a>
		</td></tr>";
	}
	echo "</table>";

	echo "</div>";
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
				<h4 class="modal-title text-center">Gebruiker Verwijderen</h4>
			</div>
			<div class="modal-body">
				<p class="text-center">Weet u zeker dat u de gebruiker wilt verwijderen?</p>
			</div>
			<div class="modal-footer">
				<a href="#" data-dismiss="modal" class="btn btn-danger">Nee</a>
				<a href="" class="btn btn-success delete_url">Ja</a>
			</div>
		</div>


		<script>

			var url = '<?php echo MapStructureRepositorie::controller()."user/userController.php?delete_user=1&user_id=:id" ?>';
			var user_id = '';
			$('.delete_user').click(function(){
				user_id = $(this).attr('user_id');
				$('#myModal').modal();

			});
			$('#myModal').on('show.bs.modal',function(){
				console.log('hi');
				$('.delete_url').attr('href',url.replace(':id',user_id));
			});
		</script>