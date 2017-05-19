<?php
include_once('../includes/head.php');
if (!Auth::user()->can('groups')) {
	header("location: " . MapStructureRepositorie::error('401'));
	exit;
}
?>

<?php

echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'group/groupController.php?create=1', 'file' => 1, 'method' => 'POST']);
echo FormRepositorie::text('Naam', '',['name'=>'name', 'required' => 1]);
echo FormRepositorie::text('Schooljaar', '', ['name'=>'school_year', 'required' => 1]);
echo FormRepositorie::text('Periode', '', ['name'=>'period', 'required' => 1]);
echo FormRepositorie::text('Educatienummer', '', ['name'=>'education_id', 'required' => 1]);
echo FormRepositorie::formSaveButton("javascript:history.back()");
echo FormRepositorie::closeForm();
?>

<?php
include_once('../includes/footer.php');
?>