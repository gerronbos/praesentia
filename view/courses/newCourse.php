<?php
include_once('../includes/head.php');
if(!Auth::user()->can('courses')){
	header("location: ".MapStructureRepositorie::error('401'));
	exit;
}
?>

<div class="x_panel">
	<div class="x_title">
		<h2>Nieuwe vak toevoegen</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<?php
		echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'courses/courseController.php?create=1', 'method' => 'POST']);
		echo FormRepositorie::text("Vak naam", "", ["name" => "name"]);
		echo FormRepositorie::text("Jaar", "", ["name" => "year"]);
		echo FormRepositorie::text("Periode", "", ["name" => "period"]);
		echo FormRepositorie::formSaveButton("javascript:history.back()");
		echo FormRepositorie::closeForm();
		?>
	</div>
</div>

<?php 
include_once('../includes/footer.php');
?>