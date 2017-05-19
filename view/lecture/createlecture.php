<?php
	include_once('../includes/head.php');
	?>
	
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

<?php
	include_once('../includes/footer.php');
?>