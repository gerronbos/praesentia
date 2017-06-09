<?php
include_once('../includes/head.php');
if(Services\SessionHandler::has('room_create')){
    echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('room_create').'</div></div>';
}
if(Services\SessionHandler::has('room_edit_succes')){
    echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('room_edit_succes').'</div></div>';
}
if(Services\SessionHandler::has('room_delete_succes')){
    echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('room_delete_succes').'</div></div>';
}
?>

<div class="x_panel">
    <div class="x_title">
        <h2>Rechten sjabloon</h2>
        <a href="<?php echo MapStructureRepositorie::view()?>room/new.php" class="btn btn-primary pull-right">Nieuwe lokaal toevoegen</a>
        <ul class="nav navbar-right panel_toolbox"></ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">

        <table class="table table-responsive">
            <tr>
                <th>Nummer</th><th>Locatie</th><th>Opties</th>
            </tr>
            <?php
            if(count(model\Room::get())) {
                foreach (model\Room::get() as $room) {
                    echo "<tr><td>$room->number</td><td>$room->locatie</td><td><a href='".MapStructureRepositorie::controller()."room/roomController.php?update_view=1&room_id=$room->id' class='btn btn-primary'>Wijzig</a><button room_id='$room->id' class='btn btn-danger delete'>Verwijderen</button></td></tr>";
                }
            }
            else{
                echo "<tr><td colspan='7'>Er zijn nog geen lokalen aangemaakt</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<?php
include_once('../includes/footer.php');
?>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-center">Lokaal Verwijderen</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Weet u zeker dat u dit lokaal wilt verwijderen?</p>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Nee</a>
                <a href="" class="btn btn-success delete_url">Ja</a>
            </div>
        </div>


        <script>

            var url = '<?php echo MapStructureRepositorie::controller()."room/roomController.php?delete=1&room_id=:id" ?>';
            var room_id = '';
            $('.delete').click(function(){
                room_id = $(this).attr('room_id');
                $('#myModal').modal();

            });
            $('#myModal').on('show.bs.modal',function(){
                console.log('hi');
                $('.delete_url').attr('href',url.replace(':id',room_id));
            });
        </script>