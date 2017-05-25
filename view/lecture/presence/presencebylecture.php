<?php
include_once('../../includes/head.php');
if (!Auth::user()->can('presence')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
    $lecture_data = PresenceRepository::getPresenceByLecture(model\Lecture::find($_GET['lecture_id']))->get();
?>
<a href="javascript:history.back()" class="btn btn-default">Terug</a>
    <h3>Aanwezigheid van <?php echo $lecture_data[0]->Lecutre()->Course()->name.' '.$lecture_data[0]->Lecutre()->date; ?></h3>

    <table class="table table-bordered">
        <tr>
            <th>Gebruiker</th>
            <th>Email</th>
            <th>Aanwezig</th>
        </tr>
        <?php
        foreach($lecture_data as $ld){
            echo "<tr><td>($ld->user_number) <b>$ld->lastname</b> $ld->firstname</td><td>$ld->email</td><td>".presenttrueorfalse($ld->present)."</td></tr>";
        }
        ?>
    </table>

<?php
include_once('../../includes/footer.php');
?>