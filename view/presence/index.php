<?php
include_once('../includes/head.php');
$lectures = model\Lecture::where('user_id','=',Auth::user()->id)->where('date','=',date('y-m-d'))->orderBy('start_time','asc')->get();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php echo FormRepositorie::text('Selecteer datum',date('Y-m-d'),['id'=>'datetimepicker']); ?>


<div>
    <table class="table table-responsive lecture_table">
        <tr>
            <th>Datum</th>
            <th>Start</th>
            <th>Eind</th>
            <th>Vak</th>
            <th>Opties</th>
        </tr>
        <?php
        foreach($lectures as $l){
            echo "<tr class='lectures'><td>$l->date</td><td>$l->start_time</td><td>$l->end_time</td><td>".$l->Course()->name."</td><td><a href='".MapStructureRepositorie::controller()."presence/presenceController.php?get=1&id=$l->id' class='btn btn-primary'>Aanwezigheid</a></td></tr>";
        }

        ?>

    </table>
</div>

<?php
include_once('../includes/footer.php');
?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    var url = '<?php echo MapStructureRepositorie::controller()."presence/presenceController.php?get=1&id=:id" ?>';
    $( function() {
        $( "#datetimepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );

    $('#datetimepicker').change(function(){
        var date = $(this).val();
        var table = '';
        $.ajax({
            url: "<?php echo MapStructureRepositorie::controller().'lecture/lectureController.php?get=1' ?>",
            method: "POST",
            data: {date: date,'user_id':'<?php echo Auth::user()->id; ?>'},
            success: function(data){
                data = JSON.parse(data);
                $('.lectures').remove();
                $.each(data,function(index){
                    $('.lecture_table').append("<tr class='lectures'><td>"+date+"</td><td>"+data[index].start_time+"</td><td>"+data[index].end_time+"</td><td>"+data[index].course+"</td><td><a href='"+url.replace(':id',data[index].id)+"' class='btn btn-primary'>Aanwezigheid</a></td></tr>");
                });
            }
        });
    });
</script>