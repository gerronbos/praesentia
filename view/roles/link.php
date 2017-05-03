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
                    echo "<tr><td><input type='checkbox' id='user_$u->id' name='users[]'> </td><td>".$u->fullname()."</td></tr>";
                }

                ?>
            </table>
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
        console.log(input);

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>