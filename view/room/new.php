<?php
include_once('../includes/head.php');
if(Services\SessionHandler::has('alert_roles')){
    echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('alert_roles').'</div></div>';
}
?>

<div class="x_panel">
    <div class="x_title">
        <h2>Rechten sjabloon</h2>
        <a href="<?php echo MapStructureRepositorie::view()?>roles/new.php" class="btn btn-primary pull-right">Nieuwe lokaal toevoegen</a>
        <ul class="nav navbar-right panel_toolbox"></ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <?php echo FormRepositorie::openForm(['method'=>'POST','send_type'=>'create','url'=>MapStructureRepositorie::controller().'room/roomController.php']); ?>
        <?php echo FormRepositorie::text('Nummber','',['name'=>'number']); ?>
        <?php echo FormRepositorie::textarea('Locatie','',['name'=>'locatie']); ?>
        <?php echo FormRepositorie::formSaveButton("javascript:history.back()"); ?>
        <?php echo FormRepositorie::closeForm(); ?>
    </div>
</div>
<?php
include_once('../includes/footer.php');
?>

<script>
    var url = "<?php echo MapStructureRepositorie::controller().'roles/roleController.php' ?>";
    var form = '<form method="POST" class="delete_form" action="'+url+'"><input type="hidden" name="id" value=":id"><input type="hidden" name="delete" value="1"></form>';
    $('.remove_item').click(function(){
        $('body').append(form.replace(':id',$(this).attr('item_id')));
        if(confirm('Weet u zeker dat u dit rechten sjabloon wilt verwijderen?')) {
            $('.delete_form').submit();
        }

    });
</script>