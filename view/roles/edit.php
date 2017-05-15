<?php
include_once('../includes/head.php');
$role = Services\SessionHandler::getSession('role_data');
if(Services\SessionHandler::has('alert_roles')){
    echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('alert_roles').'</div></div>';
}
?>
    <div class="x_panel">
        <div class="x_title">
            <h2>Nieuwe rechten </h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php
            echo FormRepositorie::openForm(['method'=>'POST','url'=>MapStructureRepositorie::controller()."roles/roleController.php",'send_type'=>'update']);
            echo "<input type='hidden' name='role_id' value='$role->id'>";
            include('form.php');
            echo Formrepositorie::formSaveButton(MapStructureRepositorie::view()."roles/index.php");
            echo Formrepositorie::closeForm();

            ?>
        </div>
    </div>
<?php
include_once('../includes/footer.php');
?>