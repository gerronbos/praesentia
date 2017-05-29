<?php
include_once('../includes/head.php');
if (!Auth::user()->can('groups')) {
	header("location: " . MapStructureRepositorie::error('401'));
	exit;
}
?>

<div class="x_panel">
	<div class="x_titel">
		<h2>Groep aanmaken</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
		<?php

		echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'group/groupController.php?create=1', 'file' => 1, 'method' => 'POST']);
		echo FormRepositorie::text('Naam', '',['name'=>'name', 'required' => 1]);
		echo FormRepositorie::text('Schooljaar', '', ['name'=>'school_year', 'required' => 1]);
		echo FormRepositorie::text('Periode', '', ['name'=>'period', 'required' => 1]);
		echo FormRepositorie::formSaveButton("javascript:history.back()");
		echo FormRepositorie::closeForm();
		?>
	</div>
</div>

<?php
include_once('../includes/footer.php');
?>