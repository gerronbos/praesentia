<?php
include_once('../includes/head.php');
if (!Auth::user()->can('groups')) {
	header("location: " . MapStructureRepositorie::error('401'));
	exit;
}
$group = Services\SessionHandler::getSession('group_data');
?>

<?php

echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'group/groupController.php?group_id='.$group->id.'&update=1', 'file' => 1, 'method' => 'POST']);
echo FormRepositorie::text('Naam', $group->name,['name'=>'name', 'required' => 1]);
echo FormRepositorie::text('Schooljaar', $group->school_year, ['name'=>'school_year', 'required' => 1]);
echo FormRepositorie::text('Periode', $group->period, ['name'=>'period', 'required' => 1]);
echo FormRepositorie::text('Educatienummer', $group->education_id, ['name'=>'education_id', 'required' => 1]);
echo FormRepositorie::formSaveButton("javascript:history.back()");
echo FormRepositorie::closeForm();
?>

<?php
include_once('../includes/footer.php');
?>