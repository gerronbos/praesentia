<?php
include_once('../includes/head.php');
if(Services\SessionHandler::has('alert_roles')){
    echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('alert_roles').'</div></div>';
}
$room = model\Room::find(Services\SessionHandler::getSession('room_data'));
?>

<div class="x_panel">
    <div class="x_title">
        <h2>Lokaal toevoegen</h2>
        <ul class="nav navbar-right panel_toolbox"></ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <?php echo FormRepositorie::openForm(['method'=>'POST','url'=>MapStructureRepositorie::controller().'room/roomController.php?room_id='.$room->id.'&update=1']); ?>
        <?php echo FormRepositorie::text('Lokaalnummer',$room->number,['name'=>'number']); ?>
        <?php echo FormRepositorie::textarea('Locatie',$room->locatie,['name'=>'locatie']); ?>
        <?php echo FormRepositorie::formSaveButton("javascript:history.back()"); ?>
        <?php echo FormRepositorie::closeForm(); ?>
    </div>
</div>
<?php
include_once('../includes/footer.php');
?>