<?php
include_once('../../includes/head.php');
$user = Services\SessionHandler::getSession('user_data');
$presence = PresenceRepository::getPresenceByCourse(model\Course::find($_GET['course_id']), ['user_id'=>$user->id])->groupBy('lecture_id')->get();
if(Auth::user()->id != $user->id) {
	if (!Auth::user()->can('user')) {
		header("location: " . MapStructureRepositorie::error('401'));
		exit;
	}
}
?>

<div class="container">
	<div class="x_panel">
		<div class="x_title">
			<h2>Aanwezigheid van <?php echo $user->fullname(); ?></h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<table class="table table-bordered">
				<tr>
					<th>Datum</th>
					<th>Starttijd</th>
					<th>Eindtijd</th>
					<th>Aanwezig</th>
				</tr>
				<?php
					foreach ($presence as $p) {
						echo "<tr><td>$p->date</td><td>$p->start_time</td><td>$p->end_time</td><td style='text-align: center;'>".presenttrueorfalse($p->present)."</td></tr>";
					}
				?>
			</table>
			<a target="_blank" href="<?php echo MapStructureRepositorie::Controller() ?>pdfController.php?UserLectureHist=1&user_id=<?php echo $user->id ?>&course_id=<?php echo $_GET['course_id']?>" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Opslaan als PDF</a>
		</div>
	</div>
</div>


<?php include_once('../../includes/footer.php'); ?>