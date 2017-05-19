<?php
include_once('../includes/head.php');
if (!Auth::user()->can('lectures')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Importeer lessenbestand...</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
	<div style="text-align: center;">
			<?php

			echo "<a href='".MapStructureRepositorie::view()."lecture/downloadtemplate.php' class='btn btn-primary'>Download Template-bestand</a>";
			echo "<a href='".MapStructureRepositorie::view()."lecture/createlecture.php' class='btn btn-primary'>Enkele les toevoegen</a>";
			echo "<h3 style='text-align: center'>Of</h3>";

		?>
	</div>

	<div id="preview-template" style="text-align: center; " >
	<div id='testdropzone'></div>

        <?php //echo FormRepositorie::select('Groep', GroupRepository::getGroupsArray(), null, ['name'=>'group_id','id'=>'group_id']);


        echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller()."/lecture/lectureController.php",'class'=>'dropzone','id'=>'dropzone','send_type'=>'csv']); 

		echo FormRepositorie::closeForm(); ?>
	</div>
</div>
</div>

<?php
include_once('../includes/footer.php');
?>

<script>
Dropzone.autoDiscover = false;
    var Dropzone = new Dropzone('#dropzone',{
        url: "<?php echo MapStructureRepositorie::controller().'/lecture/lectureController.php';?>",
        addRemoveLinks: true,
        success: function (file, response) {
            var imgName = response;
            file.previewElement.classList.add("dz-success");
            console.log("Successfully uploaded :" + imgName);
            NProgress.done();
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
    });

    Dropzone.on('sending',function(){
		NProgress.start();
    });
</script>