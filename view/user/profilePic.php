<?php
include_once('../includes/head.php');
if (!Auth::user()->can('import')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
?>
<div class="x_panel">
    <div class="x_titel">
        <h2>Profielfoto's uploaden</h2>
        <ul class="nav navbar-right panel_toolbox"></ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <?php

        echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller()."/user/userController.php",'class'=>'dropzone','id'=>'dropzone','send_type'=>'jpg']).FormRepositorie::closeForm(); ?>
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
        queuecomplete: function() {
            alert("Importeren is succesvol gelukt.");
        },
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