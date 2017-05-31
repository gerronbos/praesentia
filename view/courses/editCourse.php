<?php
include_once('../includes/head.php');
if(!Auth::user()->can('courses')){
	header("location: ".MapStructureRepositorie::error('401'));
	exit;
}
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Vak wijzigen</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<?php
		$course = model\Course::find($_GET['course_id']);

		echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'courses/courseController.php?id='.$course->id.'&update=1', 'method' => 'POST']);
		echo FormRepositorie::text("Vak naam", $course->name, ["name" => "name"]);
		echo FormRepositorie::text("Jaar", $course->year, ["name" => "year"]);
		echo FormRepositorie::text("Periode", $course->period, ["name" => "period"]);
		echo FormRepositorie::formSaveButton("javascript:history.back()");
		echo FormRepositorie::closeForm();
		?>
	</div>
</div>

<?php 
include_once('../includes/footer.php');
?>