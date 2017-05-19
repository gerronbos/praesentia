<?php
	include_once('../includes/head.php');
	if (!Auth::user()->can('lectures')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
	?>

<div class="x_panel">
	<div class="x_title">
		<h2>Les aanmaken </h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
	<?php

	echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'lecture/lectureController.php', 'method' => 'POST','send_type'=>'create']);
	echo FormRepositorie::text('Datum', '',['name'=>'date']);
	echo FormRepositorie::text('Begintijd', '', ['name'=>'start_time']);
	echo FormRepositorie::text('Eindtijd', '', ['name'=>'end_time']);
	echo FormRepositorie::text('Kamernummer', '', ['name'=>'room_id']);
	echo FormRepositorie::text('Vak', '', ['name'=>'vak']);
	echo FormRepositorie::text('Docentnummer', '', ['name'=>'user_id']);
	echo FormRepositorie::text('Groep', '', ['name'=>'groups']);
	echo FormRepositorie::formSaveButton("javascript:history.back()");
	echo FormRepositorie::closeForm();
?>
	</div>
	</div>

<?php
	include_once('../includes/footer.php');
?>