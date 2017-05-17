<?php
include_once('../includes/head.php');
if(Services\SessionHandler::has('alert_roles')){
    echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('alert_roles').'</div></div>';
}
?>

    <div class="x_panel">
        <div class="x_title">
            <h2>Rechten sjabloon</h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <a href="<?php echo MapStructureRepositorie::view()?>roles/new.php" class="btn btn-primary pull-right">Nieuwe rechten sjabloon aanmaken</a>
            <table class="table table-responsive">
                <tr>
                    <th>Titel</th><th>Gebruikers</th><th>Aanwezigheid</th><th>Colleges</th><th>Klassen</th><th>Kamers</th><th>Opties</th>
                </tr>
                <?php
                if(count(model\Role::get())) {
                    foreach (model\Role::get() as $role) {
                        echo "<tr><td>$role->title</td><td>".trueorfalse($role->users)."</td><td>".trueorfalse($role->presence)."</td><td>".trueorfalse($role->lectures)."</td><td>".trueorfalse($role->groups)."</td><td>".trueorfalse($role->rooms)."</td><td><a href='".MapStructureRepositorie::controller()."roles/roleController.php?update=1&role_id=$role->id' class='btn btn-primary'>Wijzig</a><button class='btn btn-danger remove_item' item_id='$role->id'>Verwijder</button><a href='".MapStructureRepositorie::view()."roles/link.php?role_id=$role->id' class='btn btn-info'>Koppelen</a></td></tr>";
                    }
                }
                else{
                    echo "<tr><td colspan='7'>Er zijn nog geen rechten aangemaakt</td></tr>";
                }
                ?>
            </table>
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