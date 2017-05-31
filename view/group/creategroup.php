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

		if(Services\SessionHandler::has('group_exists_or_active')){
			$data = Services\SessionHandler::getAndDelete('inputdata');
			echo '<div class="col-lg-12"><div class="alert alert-danger" role="alert">'.Services\SessionHandler::getAndDelete('group_exists_or_active').'</div></div>';
		}

		echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'group/groupController.php?create=1', 'file' => 1, 'method' => 'POST']);
		echo FormRepositorie::text('Naam', (isset($data) && isset($data['name']))?$data['name'] : null, ['name'=>'name', 'required' => 1]);
		echo FormRepositorie::text('Schooljaar', (isset($data) && isset($data['school_year']))?$data['school_year'] : null, ['name'=>'school_year', 'required' => 1]);
		echo FormRepositorie::text('Periode', (isset($data) && isset($data['period']))?$data['period'] : null, ['name'=>'period', 'required' => 1]);
		echo FormRepositorie::formSaveButton("javascript:history.back()");
		echo FormRepositorie::closeForm();
		?>
	</div>
</div>

<?php
include_once('../includes/footer.php');
?>