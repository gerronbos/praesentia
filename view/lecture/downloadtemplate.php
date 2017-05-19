<?php
include_once('../includes/head.php');
if (!Auth::user()->can('lectures')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Downloaden Template voor lessen importeren...</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
    <div style="text-align: center;">
	   <a class="btn btn-primary" href="lecture_template.csv" download>Download template-bestand</a>
       <p>Het bestand bevat de volgende kolommen en hebben tevens een bepaalde conventie wat onder de naam wordt beschreven:</p>
       </div>
       <table class='table table-bordered'>
        <tr>
            <th>Datum</th>
            <th>Begintijd</th>
            <th>Eindtijd</th>
            <th>Kamernummer</th>
            <th>Vak</th>
            <th>Docentnummer</th>
            <th>Groep</th>
        </tr>
        <tr>
            <td>YYYY-MM-DD</td>
            <td>HH:MM</td>
            <td>HH:MM</td>
            <td>N.NN</td>
            <td>Volledige naam van het vak</td>
            <td>Uw docentnummer (eg. WEX01)</td>
            <td>Groepscode (eg. WFHBOICT.V1F)</td> 
        </tr>
       </table>
    </div>
</div>

<?php
include_once('../includes/footer.php');
?>
