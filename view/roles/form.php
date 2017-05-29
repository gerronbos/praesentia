<?php
echo FormRepositorie::text('title',$role->title,['required'=>1]);
echo FormRepositorie::truefalse('Gebruikers',$role->users,['name'=>'users']);
echo "<p class='help-class'>Hierbij worden de volgende rechten verstaan:<br>Gebruikers toevoegen<br>Gebruikers wijzigen<br> Gebruikers verwijderen<br> Gebruikers inzien</p>";
echo FormRepositorie::truefalse('Aanwezigheid',$role->presence,['name'=>'presence']);
echo "<p class='help-class'>Hierbij worden de volgende rechten vestaan:<br>Aanwezigheid inzien<br>Aanweizgheid invullen voor jouw klas</p>";
echo FormRepositorie::truefalse('Colleges',$role->lectures,['name'=>'lectures']);
echo "<p class='help-class'>Hierbij worden de volgende rechten verstaan:<br>Colleges aanmaken<br>Colleges wijzigen<br> Colleges verwijderen<br> Gebruikers koppelen aan colleges<br> Colleges inzien</p>";
echo FormRepositorie::truefalse('Klassen',$role->groups,['name'=>'groups']);
echo "<p class='help-class'>Hierbij worden de volgende rechten verstaan:<br>Klassen toevoegen<br>Klassen wijzigen<br> Klassen verwijderen<br>Gebruikers koppelen aan klassen<br> Klassen inzien</p>";
echo FormRepositorie::truefalse('Lokalen',$role->rooms,['name'=>'rooms']);
echo "<p class='help-class'>Hierbij worden de volgende rechten verstaan:<br>Lokalen toevoegen<br>Lokalen wijzigen<br> Lokalen verwijderen<br>Gebruikers koppelen aan lokalen<br> Colleges koppelen aan lokalen<br> Lokalen inzien</p>";
echo FormRepositorie::truefalse('Importeren',$role->import,['name'=>'import']);
echo "<p class='help-class'>Hierbij worden de volgende rechten verstaan:<br>Gebruikers updaten doormiddel van csv bestand<br>Lessen importeren<br>Profiel fotos updaten doormiddel van een import";
?>