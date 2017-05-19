<?php
	include_once('../includes/head.php');
if (!Auth::user()->can('lectures')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
	$lecture = Services\SessionHandler::getSession('edit_lecture');
	?>
	<div class="x_panel">
		<div class="x_title">
			<h2>Les wijzigen</h2>
			<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
		</div>
		<div class="x_content">
	<?php


	echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'lecture/lectureController.php', 'method' => 'POST','send_type'=>'update']);
	echo FormRepositorie::text('Datum', $lecture->date,['name'=>'date']);
	echo FormRepositorie::text('Begintijd', $lecture->start_time, ['name'=>'start_time']);
	echo FormRepositorie::text('Eindtijd', $lecture->end_time, ['name'=>'end_time']);
	echo FormRepositorie::text('Kamernummer', $lecture->room_id, ['name'=>'room_id']);
	echo FormRepositorie::text('Vak', $lecture->Course()->name, ['name'=>'vak']);
	echo FormRepositorie::text('Docentnummer', $lecture->User()->number, ['name'=>'user_id']);
	echo FormRepositorie::text('Groep', '', ['name'=>'groups']);
	echo FormRepositorie::formSaveButton("javascript:history.back()");
	echo FormRepositorie::closeForm();
?>
		</div>
	</div>

<?php
	include_once('../includes/footer.php');
?>