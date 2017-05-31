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

		if(Services\SessionHandler::has('course_delete')){
			echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('course_delete').'</div></div>';
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
			<td><a href='".MapStructureRepositorie::view()."courses/editCourse.php?course_id=".$course->id."'class='btn btn-primary'>Wijzigen</a>
				<button course_id=".$course->id." class='btn btn-danger delete_course'>Verwijderen</button>
			</tr>";
		}
		echo "</table>"

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
				<h4 class="modal-title text-center">Vak Verwijderen</h4>
			</div>
			<div class="modal-body">
				<p class="text-center">Weet u zeker dat u dit vak wilt verwijderen?</p>
			</div>
			<div class="modal-footer">
				<a href="#" data-dismiss="modal" class="btn btn-danger">Nee</a>
				<a href="" class="btn btn-success delete_url">Ja</a>
			</div>
		</div>

		<script>

			var url = '<?php echo MapStructureRepositorie::controller()."courses/courseController.php?delete_course=1&course_id=:id" ?>';
			var course_id = '';
			$('.delete_course').click(function(){
				course_id = $(this).attr('course_id');
				$('#myModal').modal();

			});
			$('#myModal').on('show.bs.modal',function(){
				console.log('hi');
				$('.delete_url').attr('href',url.replace(':id',course_id));
			});
		</script>