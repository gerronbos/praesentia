<?php
include_once('../includes/head.php');
if (!Auth::user()->can('groups')) {
	header("location: " . MapStructureRepositorie::error('401'));
	exit;
}
$group = model\Group::find(Services\SessionHandler::getSession('group_data'));
?>

<div class="x_panel">
	<div class="x_title">
		<h2>Groep wijzigen</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
		<?php

		echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'group/groupController.php?group_id='.$group->id.'&update=1', 'file' => 1, 'method' => 'POST']);
		echo FormRepositorie::text('Naam', $group->name,['name'=>'name', 'required' => 1]);
		echo FormRepositorie::text('Schooljaar', $group->school_year, ['name'=>'school_year', 'required' => 1]);
		echo FormRepositorie::text('Periode', $group->period, ['name'=>'period', 'required' => 1]);
		if($group->active==0){
			echo FormRepositorie::checkbox('Status', ['Groep is actief'=>1], ['checked' => 1]);
		}else{
			echo FormRepositorie::checkbox('Status', ['Groep is actief'=>1], ['Groep is actief'], ['checked' => 1]);
		}
		echo FormRepositorie::formSaveButton("javascript:history.back()");
		echo FormRepositorie::closeForm();
		?>
	</div>
</div>

<?php
include_once('../includes/footer.php');
?>