<?php
include_once('../includes/head.php');
if (!Auth::user()->can('import')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Opties</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<div style="text-align: center;">
			<?php

			echo "<a href='".MapStructureRepositorie::view()."user/createuser.php' class='btn btn-primary'>Enkel gebruiker toevoegen</a>";
			echo "<h3 style='text-align: center'>Of</h3>";

		/*echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'user/userController.php', 'file'=> 1, 'method' => 'POST']);
		
		echo FormRepositorie::formSaveButton("javascript:history.back()");
		echo FormRepositorie::closeForm();*/
		?>
	</div>

	<div id="preview-template" style="text-align: center; " >
	<div id='testdropzone'></div>

        <?php //echo FormRepositorie::select('Groep', GroupRepository::getGroupsArray(), null, ['name'=>'group_id','id'=>'group_id']);


        echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller()."/user/userController.php",'class'=>'dropzone','id'=>'dropzone','send_type'=>'csv']); 

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
        url: "<?php echo MapStructureRepositorie::controller().'/user/userController.php';?>",
        addRemoveLinks: true,
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
    });

    Dropzone.on('uploadprogress',function(file,perc,bytesent){
    console.log(perc);
    });

    Dropzone.on('sending',function(file, xhr, formData){
    	var group_id = $('#group_id option:selected').attr('value');
    	
    	formData.append('group_id',group_id);
    	formData.append('csv',1);
        NProgress.start();
    });

    Dropzone.on('success',function(file,response){
        var imgName = response;
        file.previewElement.classList.add("dz-success");
        console.log("Successfully uploaded :" + imgName);
        NProgress.done();
    });
</script>