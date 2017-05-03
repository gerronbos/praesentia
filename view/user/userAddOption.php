<?php
include_once('../includes/head.php');
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Opties</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<?php

		echo "<a href='".MapStructureRepositorie::view()."user/creatuser.php' class='btn btn-primary'>Enkel gebruiker toevoegen</a>";
		echo "<h3 style='text-align: center'>Of</h3>";
		echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'user/userController.php', 'file'=> 1, 'method' => 'POST']);
			//echo FormRepositorie::
		echo FormRepositorie::formSaveButton("javascript:history.back()");
		echo FormRepositorie::closeForm();
		?>
	</div>
</div>
<?php
include_once('../includes/footer.php');
?>