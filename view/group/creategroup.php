<?php
	include_once('../includes/head.php');
if (!Auth::user()->can('groups')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
	?>
	
	<?php

	echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'groupController.php?create=1', 'file' => 1, 'method' => 'POST']);
	echo FormRepositorie::text('Naam', '',['name'=>'name']);
	echo FormRepositorie::text('Schooljaar', '', ['name'=>'school_year']);
	echo FormRepositorie::text('Periode', '', ['name'=>'period']);
	echo FormRepositorie::text('Educatienummer', '', ['name'=>'education_id']);
	echo FormRepositorie::formSaveButton("javascript:history.back()");
	echo FormRepositorie::closeForm();
?>

<?php
	include_once('../includes/footer.php');
?>