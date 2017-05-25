<?php
include_once('../../includes/head.php');
if (!Auth::user()->can('presence')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
if(isset($_GET['group_id'])) {
    $presence_data = PresenceRepository::getByCourse(model\Course::where('name', '=', $_GET['course_name'])->first(), ['group_id' => $_GET['group_id']])->select('lectures.*, courses.name')->get();
}
else{
    $presence_data = PresenceRepository::getByCourse(model\Course::where('name', '=', $_GET['course_name'])->first())->select('lectures.*, courses.name')->get();
}
?>
    <a href="javascript:history.back()" class="btn btn-default">Terug</a>
<table class="table table-bordered">
    <tr>
        <th>Vak</th>
        <th>Datum</th>
        <th>Starttijd</th>
        <th>Eindtijd</th>
        <th>Aantal studenten</th>
        <th>Aantal aanwezig</th>
        <th>Procenten</th>
        <th>Opties</th>
    </tr>
    <?php
    foreach($presence_data as $pd){
        $lecture_data = PresenceRepository::getByLecture($pd);
        if($lecture_data['amount_users'] > 0) {
            $groups = $pd->Groups();
            $url = MapStructureRepositorie::view() . 'lecture/presence/presencebylecture.php?lecture_id=' . $pd->id;
            echo "<tr><td>$pd->name</td><td>$pd->date</td><td>$pd->start_time</td><td>$pd->end_time</td><td>" . $lecture_data['amount_users'] . "</td><td>" . $lecture_data['amount_presence'] . "</td><td>" . progressBar($lecture_data['amount_presence_prec']) . "</td><td><a href='$url' class='btn btn-primary'>Inzien</a></td></tr>";
        }
    }
    ?>
</table>

<?php
include_once('../../includes/footer.php');
?>