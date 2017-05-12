<?php
include_once('../includes/head.php');
?>
    <div class="x_panel">
        <div class="x_title">
            <h2>Rechten </h2>
            <a href="<?php echo MapStructureRepositorie::view()?>roles/new.php" class="btn btn-primary pull-right">Nieuwe rechten aanmaken</a>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-responsive">
                <tr>
                    <th>Titel</th><th>Gebruikers</th><th>Aanwezigheid</th><th>Colleges</th><th>Klassen</th><th>Kamers</th>
                </tr>
                <?php
                if(count(model\Role::get())) {
                    foreach (model\Role::get() as $role) {
                        echo "<tr><td>$role->title</td><td>".trueorfalse($role->users)."</td><td>".trueorfalse($role->presence)."</td><td>".trueorfalse($role->lectures)."</td><td>".trueorfalse($role->groups)."</td><td>".trueorfalse($role->rooms)."</td></tr>";
                    }
                }
                else{
                    echo "<tr><td colspan='6'>Er zijn nog geen rechten aangemaakt</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
<?php
include_once('../includes/footer.php');
?>