<?php
include_once('../includes/head.php');
$user = Services\SessionHandler::getSession('user_data');
if(!Auth::user()->can('groups') || !Auth::user()->can('presence')){
    header("location: ".MapStructureRepositorie::error('401'));
}
$group = model\Group::find($_GET['group_id']);
$data2 = PresenceRepository::getByCourse(model\Course::find(1),['group_id'=>48]);
?>

<div class="x_panel">
	<div class="x_title">
		<h2>Overzicht Aanwezigheid</h2>
		<?php
		echo "<a href='".MapStructureRepositorie::view()."group/allgroups.php' class='btn btn-default' style='float: right'>Terug</a>";
		?>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
		<section class="content invoice">
			<div class="row">
				<div class="col-xs-12 invoice-header">
					<h1>
					<i class="fa fa-paw"></i>
					Praesentia
					<small class="pull-right"><?php echo date('d M Y'); ?></small>
					
					</h1>
					<h2>Groep: <?php echo $group->name ?></h2>
					<br />
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 table">
					<table class="table taple-striped">
						<tr>
							<th>Naam</th>
							<th>Gebruikersnaam</th>
							<th>Email</th>
							<th>Opties</th>
						</tr>
						<?php
							foreach ($group->Users() as $user) {
								$data = PresenceRepository::calcPresenceByUser($user,['grouped' => 1]);
								echo "<tr><td>".$user->fullnameReturned(['url'=>1])."</td><td>$user->user_number</td><td>$user->email</td><td>";
								echo progressBar($data['amount_present_prec'])."</tr>";
							}
						?>
					</table>
				</div>
			</div>
			<div class="row no-print">
				<div class="col-xs-12">
					<a target="_blank" href="<?php echo MapStructureRepositorie::Controller() ?>pdfController.php?GroupSummary=1&gid=<?php echo $group->id ?>" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Opslaan als PDF</a>
				</div>
			</div>

		</section>
	</div>
</div>

<?php
include_once('../includes/footer.php');
?>
