<?php
include_once('../includes/head.php');
$lecture_data = Services\SessionHandler::getSession('lecture_data');

$lecture = $lecture_data['lecture'];
$group = $lecture_data['group'];
$user_data = $lecture_data['presence_data'];

?>
<div class="x_panel">
    <div class="x_title">
        <h2>Gebruikers </h2>
        <?php
        echo FormRepositorie::openForm(['method'=>'POST','send_type'=>'set','url'=>MapStructureRepositorie::controller().'presence/presenceController.php']);
        ?>
        <table class="table table-bordered">
    <tr>
        <th>Naam</th><th>Student nummer</th><th>klas</th><th>Aanwezig</th>
    </tr>
    <?php
    foreach($group->Users() as $users){
        echo "<tr><th>".$users->fullname()."</th><th>$users->user_number</th><th>$group->name</th><th><input type='checkbox'";
        if(isset($user_data[$users->id]) && !$user_data[$users->id]){
            echo " checked ";
        }

        echo "name='present[]' value='$users->id' data-toggle='toggle' data-on='Afwezig' data-off='Aanwezig' data-onstyle='danger' data-offstyle='success'></th></tr>";
    }


    ?>


</table>
        <?php

        echo FormRepositorie::formSaveButton();
        echo FormRepositorie::closeForm();
        ?>
</div>
    </div>
<?php
include_once('../includes/footer.php');
?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>