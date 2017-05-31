<?php
include_once('../includes/head.php');
$lecture = model\Lecture::find($_GET['id']);
$user_ids = [];
foreach($lecture->Groups() as $group){
    $user_ids += $group->users(['onlyIds'=>1]);
}
$return = [
    'lecture' => $lecture,
    'presence_data' => [],
    'user_ids' => $user_ids,
];
$presence_data = [];
foreach(model\Presence::where('lecture_id','=',$_GET['id'])->get() as $l){
    $presence_data[$l->user_id] = ['present'=>$l->present,'reason'=>$l->reason];
}
$return['presence_data'] = $presence_data;

$lecture = $return['lecture'];
$user_ids = $return['user_ids'];
$user_data = $return['presence_data'];

?>
<div class="x_panel">
    <div class="x_title">
        <h2>Gebruikers </h2>
        <?php
        echo FormRepositorie::openForm(['method'=>'POST','send_type'=>'set','url'=>MapStructureRepositorie::controller().'presence/presenceController.php?lecture_id='.$_GET['id']]);
        ?>
        <table class="table table-bordered">
    <tr>
        <th></th><th>Naam</th><th>Studentnummer</th><th>Klas</th><th>Aanwezig</th>
    </tr>
    <?php
    foreach(UserRepositorie::getWithGroupsByIds($user_ids) as $users){
        echo "<tr><th style='text-align: center'><img width='60px' src='".$users->getUserProfilePicture()."'></th><th>".$users->fullname()."</th><th>$users->user_number</th><th>$users->name</th><th><input type='checkbox'";
        if(isset($user_data[$users->id]) && !$user_data[$users->id]['present']){
            echo " checked ";
        }

        echo "name='present[]' value='$users->id' data-toggle='toggle' data-on='Afwezig' data-off='Aanwezig' data-onstyle='danger' data-offstyle='success'></th></tr>";
        if(isset($user_data[$users->id]) && $user_data[$users->id]['reason']){
            echo "<tr><td colspan='4'><i>".$user_data[$users->id]['reason']."</i></td></tr>";
        }
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