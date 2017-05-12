<?php
include_once('../includes/head.php');
?>
    <div class="x_panel">
        <div class="x_title">
            <h2>Nieuwe rechten </h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php echo FormRepositorie::openForm(); ?>
            <input type="hidden" name="role_id" value="<?php echo $_GET['role_id']; ?>">
            <button class="btn btn-primary">Opslaan</button>
            <div class="form-group">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Zoeken...">
            </div>

            <table id="myTable" class="table table-responsive">
                <tr class="header">
                    <th style="width:10%;">Selecteer</th>
                    <th style="width:90%;">Naam</th>
                </tr>
                <?php
                foreach(model\Users::get() as $u){
                    echo "<tr><td><input type='checkbox' id='user_$u->id' name='users[]' value='1'> </td><td>".$u->fullname()."</td></tr>";
                }

                ?>
            </table>
            <button class="btn btn-primary">Opslaan</button>
            <?php echo FormRepositorie::closeForm(); ?>
        </div>
    </div>
<?php
include_once('../includes/footer.php');
?>
<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                console.log(td.innerHTML.toUpperCase());
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>