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
            <?php
            echo FormRepositorie::openForm(['method'=>'POST','url'=>MapStructureRepositorie::controller()."roles/roleController.php",'send_type'=>'create']);
            echo FormRepositorie::text('title','',['required'=>1]);
            echo FormRepositorie::truefalse('Gebruikers','',['name'=>'users']);
            echo "<p class='help-class'>Hierbij worden de volgende rechten verstaan:<br>Gebruikers toevoegen<br>Gebruikers wijzigen<br> Gebruikers verwijderen<br> Gebruikers inzien</p>";
            echo FormRepositorie::truefalse('Aanwezigheid','',['name'=>'presence']);
            echo "<p class='help-class'>Hierbij worden de volgende rechten vestaan:<br>Aanwezigheid inzien<br>Aanweizgheid invullen voor jouw klas</p>";
            echo FormRepositorie::truefalse('Colleges','',['name'=>'lectures']);
            echo "<p class='help-class'>Hierbij worden de volgende rechten verstaan:<br>Colleges aanmaken<br>Colleges wijzigen<br> Colleges verwijderen<br> Gebruikers koppelen aan colleges<br> Colleges inzien</p>";
            echo FormRepositorie::truefalse('Klassen','',['name'=>'groups']);
            echo "<p class='help-class'>Hierbij worden de volgende rechten verstaan:<br>Klassen toevoegen<br>Klassen wijzigen<br> Klassen verwijderen<br>Gebruikers koppelen aan klassen<br> Klassen inzien</p>";
            echo FormRepositorie::truefalse('Lokalen','',['name'=>'rooms']);
            echo "<p class='help-class'>Hierbij worden de volgende rechten verstaan:<br>Lokalen toevoegen<br>Lokalen wijzigen<br> Lokalen verwijderen<br>Gebruikers koppelen aan lokalen<br> Colleges koppelen aan lokalen<br> Lokalen inzien</p>";
            echo Formrepositorie::formSaveButton(MapStructureRepositorie::view()."roles/index.php");
            echo Formrepositorie::closeForm();

            ?>
        </div>
    </div>
<?php
include_once('../includes/footer.php');
?>