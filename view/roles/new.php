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
            echo FormRepositorie::text('title','');
            echo FormRepositorie::truefalse('Gebruikers');
            echo "<p class='help-class'>Hierbij wordt verstaan de volgende dingen:<br>Gebruikers toevoegen<br>Gebruikers wijzigen<br> Gebruikers verwijderen<br> Gebruikers inzien</p>";
            echo FormRepositorie::truefalse('Aanwezigheid');
            echo "<p class='help-class'>Hierbij wordt verstaan de volgende dingen:<br>Aanwezigheid inzien<br>Aanweizgheid invullen voor joun klas</p>";
            echo FormRepositorie::truefalse('Colleges');
            echo "<p class='help-class'>Hierbij wordt verstaan de volgende dingen:<br>Colleges aanmaken<br>Colleges wijzigen<br> Colleges verwijderen<br> Gebruikers koppelen aan colleges<br> Colleges inzien</p>";
            echo FormRepositorie::truefalse('Klassen');
            echo "<p class='help-class'>Hierbij wordt verstaan de volgende dingen:<br>Klassen toevoegen<br>Klassen wijzigen<br> Klassen verwijderen<br>Gebruikers koppelen aan klassen<br> Klassen inzien</p>";
            echo FormRepositorie::truefalse('Lokalen');
            echo "<p class='help-class'>Hierbij wordt verstaan de volgende dingen:<br>Lokalen toevoegen<br>Lokalen wijzigen<br> Lokalen verwijderen<br>Gebruikers koppelen aan lokalen<br> Colleges koppelen aan lokalen<br> Lokalen inzien</p>";
            ?>
        </div>
    </div>
<?php
include_once('../includes/footer.php');
?>