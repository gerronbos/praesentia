<?php
include_once('../includes/head.php');
if (!Auth::user()->can('lectures')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
$lectures = Services\SessionHandler::getSession('lecture');
?>
<div class="x_panel">
	<div class="x_title">
        <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-7">
        <h2>Lessen </h2>
            </div>
		<?php
            echo "<div class='col-lg-3'>";
            echo FormRepositorie::openForm(['url'=>MapStructureRepositorie::controller().'lecture/lectureController.php','send_type'=>'get_all']).FormRepositorie::text('q','',['noLabel'=>1,'placeholder'=>'zoeken...']).FormRepositorie::closeForm();
        echo "</div><div class='col-lg-2'>";
        echo "<a href='".MapStructureRepositorie::view()."lecture/importlecture.php' class='btn btn-primary' style='float: right'>Nieuwe Les</a>";
        echo "</div>";
        ?>
        </div>
        </div>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<?php

		echo "<table class='table table-bordered'><tr><th>Vak</th><th>Datum</th><th>Begintijd</th><th>Eindtijd</th><th>Kamernummer</th><th>Docent</th><th>Opties</th></tr>";
		foreach ($lectures as $lecture) {
			echo "<tr>
					<td>".$lecture->Course()->name."</td>
					<td>".$lecture->date."</td>
					<td>$lecture->start_time</td>
					<td>$lecture->end_time</td>
					<td>$lecture->room_id</td>
					<td>".$lecture->User()->fullName()."</td>

		<td>
			<a href='".MapStructureRepositorie::controller()."lecture/lectureController.php?edit_lecture=1&lecture_id=$lecture->id' class='btn btn-primary'>Wijzigen</a>
			<a href='".MapStructureRepositorie::controller()."lecture/lectureController.php?delete_lecture=1&lecture_id=$lecture->id' class='btn btn-danger'>Verwijderen</a>
			<a href='".MapStructureRepositorie::controller()."lecture/lectureController.php?viewlecture=1&lecture_id=$lecture->id' class='btn btn-info'>Weergeven</a>
		</td></tr>";
	}
	echo "</table>";


	?>
</div>
</div>
<?php
include_once('../includes/footer.php');
?>