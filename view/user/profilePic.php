<?php
include_once('../includes/head.php');
if (!Auth::user()->can('user')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
?>

<div id='testdropzone'></div>

        <?php 

        echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller()."/user/userController.php",'class'=>'dropzone','id'=>'dropzone','send_type'=>'jpg']); 

		echo FormRepositorie::closeForm(); ?>
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
    	formData.append('jpg',1);
        NProgress.start();
    });

    Dropzone.on('success',function(file,response){
        var imgName = response;
        file.previewElement.classList.add("dz-success");
        console.log("Successfully uploaded :" + imgName);
        NProgress.done();
    });
</script>