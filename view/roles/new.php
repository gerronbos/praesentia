<?php
include_once('../includes/head.php');
$role = new \model\Role();
?>
    <div class="x_panel">
        <div class="x_title">
            <h2>Nieuwe rechten </h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php
            echo FormRepositorie::openForm(['method'=>'POST','url'=>MapStructureRepositorie::controller()."roles/roleController.php",'send_type'=>'create']);
            include('form.php');
            echo Formrepositorie::formSaveButton(MapStructureRepositorie::view()."roles/index.php");
            echo Formrepositorie::closeForm();

            ?>
        </div>
    </div>
<?php
include_once('../includes/footer.php');
?>