<?php
include_once('includes/head.php');

echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'updateUserController.php', 'file' => 1, 'method' => 'POST']);
echo FormRepositorie::text('Voornaam', $this->firstname, ['name'=>'firstname']);
?>

<?php
include_once('includes/footer.php')

?>