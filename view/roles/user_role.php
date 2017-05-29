<?php
include_once('../includes/head.php');
$user = model\Users::find(Services\SessionHandler::getSession('user_data'));
$role = Services\SessionHandler::getSession('userRole_data');
if (!is_null($role)) {
    $role = model\UserRoles::find($role);
}else{
    $role = new model\UserRoles();
}

if(Services\SessionHandler::has('alert_roles')){
    echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('alert_roles').'</div></div>';
}
?>

    <div class="x_panel">
        <div class="x_title">
            <h2>Gebruikers rechten voor <?php echo $user->fullname(); ?> </h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php
            echo FormRepositorie::openForm(['method'=>'POST','url'=>MapStructureRepositorie::controller()."roles/roleController.php",'send_type'=>'user_roles']);
            echo "<input type='hidden' name='user_id' value='$user->id'>";
            include_once('form.php');
            echo Formrepositorie::formSaveButton(MapStructureRepositorie::controller()."user/userController.php?show=1&user_id=".$user->id);
            echo Formrepositorie::closeForm();

            ?>
        </div>
    </div>
<?php
include_once('../includes/footer.php');
?>