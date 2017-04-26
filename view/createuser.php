<?php
	include_once('includes/head.php');

	echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'createUserController.php', 'file' => 1, 'method' => 'POST']);
	echo FormRepositorie::text('Voornaam', '');
	echo FormRepositorie::text('Achternaam', '');
	echo FormRepositorie::text('Studentnummer', '');
	echo FormRepositorie::text('Email', '');
	echo FormRepositorie::text('Wachtwoord', '');
	echo FormRepositorie::formSaveButton('#');
	echo FormRepositorie::closeForm();
?>

<?php
	include_once('includes/footer.php');
?>