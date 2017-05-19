<?php
include_once('../../includes/head.php');
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


    </table>
</div>

<!--

Modal maken

-->
<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Afmelden</h4>
            </div>
            <div class="modal-body">
                <?php echo FormRepositorie::textarea('Reden','',['id'=>'reason','name'=>'reason']); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save_modal" data-dismiss="modal">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!--

Modal klaar

-->

<?php echo FormRepositorie::openForm(['id'=>'form','method'=>'POST','send_type'=>'set_presence','url'=>MapStructureRepositorie::controller().'user/userController.php']).FormRepositorie::closeForm(); ?>

<?php
include_once('../../includes/footer.php');
?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    var user_id = "<?php echo Auth::user()->id; ?>";
    var url = '<?php echo MapStructureRepositorie::controller()."presence/presenceController.php?get=1&id=:id" ?>';
    $( function() {
        $( "#datetimepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );
    setRows();
    function setRows(){
        var date = $('#datetimepicker').val();
        var table = '';
        $.ajax({
            url: "<?php echo MapStructureRepositorie::controller().'lecture/lectureController.php?get_by_group=1' ?>",
            method: "POST",
            data: {date: date,'group_id':'<?php echo Auth::user()->Group()->id; ?>'},
            success: function(data){
                data = JSON.parse(data);
                $('.lectures').remove();
                $.each(data,function(index){
                    $('.lecture_table').append("<tr class='lectures'><td>"+date+"</td><td>"+data[index].start_time+"</td><td>"+data[index].end_time+"</td><td>"+data[index].course+"</td><td><button class='btn btn-primary open_modal' lecture_id='"+data[index].id+"'>Afmelden</button></td></tr>");
                });
                $('.open_modal').click(function(){
                    $('#modal').modal();
                    $('.lecture_id').remove();
                    var form = document.getElementById('form');
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'lecture_id';
                    input.className = 'lecture_id';
                    input.setAttribute('value',$(this).attr('lecture_id'));
                    form.appendChild(input);

                });
            }
        });
    }

    $('#datetimepicker').change(function(){
        setRows();
    });

    $('.save_modal').click(function(){
       var form = document.getElementById('form');
       var input = document.createElement('input');
       input.type = 'hidden';
       input.name = 'reason';
       input.className = 'form_input';
       input.setAttribute('value',$('#reason').val());

        var input_user = document.createElement('input');
        input_user.type = 'hidden';
        input_user.name = 'user';
        input_user.className = 'form_input';
        input_user.setAttribute('value',user_id);

        $('.form_input').remove();

        form.appendChild(input);
        form.appendChild(input_user);

        form.submit();
    });


</script>