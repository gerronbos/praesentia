<?php 
include_once('../includes/head.php');
if(!Auth::user()->can('courses')){
	header("location: ".MapStructureRepositorie::error('401'));
	exit;
}
?>

<div class="x_panel">
	<div class="x_title">
		<h2>Vakken</h2>
		<?php
		echo "<a href='".MapStructureRepositorie::view()."courses/newCourse.php' class='btn btn-primary' style='float: right'>Nieuwe vak</a>";
		?>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<?php

		if(Services\SessionHandler::has('course_edit')){
			echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('course_edit').'</div></div>';
		}

		$course = model\Course::get('course_id');

		echo 	"<table class='table table-bordered'>";
		echo 	"<tr>";
		echo 	"<th>Vaknaam</th>
				<th>Jaar</th>
				<th>Periode</th>
				<th>Opties</th>";
		echo 	"</tr>";

		foreach ($course as $course) {
			echo "<tr>
			<td>".$course->name."</td>
			<td>".$course->year."</td>
			<td>".$course->period."</td>
			<td><a href='".MapStructureRepositorie::view()."courses/editCourse.php'class='btn btn-primary'>Wijzigen</a>
			<a href='".MapStructureRepositorie::controller()."courses/courseController.php?delete_course=1&course_id=$course->id' class='btn btn-danger'>Verwijderen</a>
			</tr>";
		}
		echo "</table>"

		?>
	</div>
</div>

<?php
include_once('../includes/footer.php');
?>