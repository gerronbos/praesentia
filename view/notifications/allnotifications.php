<?php
    include_once('../includes/head.php');
?>

<!-- <a href="createnotification.php" class="btn btn-primary">Nieuw bericht</a> -->
<div class="clearfix"></div>

<div class="list-group">
<?php
foreach(NotificationRepository::get(Auth::user()->id)->orderBy('id','DESC')->get() as $entry){
    echo '<li class="list-group-item">';
    echo '<h4 class="list-group-item-heading">';
    echo $entry->from_user()->fullname();  
    echo "<span class='pull-right'><span style='color:black' class='btn-link glyphicon glyphicon-remove remove_item' item_id='$entry->id'></span></span>";
    echo "<span class='pull-right' style='margin-right:10px;'>".time_ago($entry->created_at)." (".$entry->created_at.")</span>";
    echo '</h4>';
    echo '<p class="list-group-item-text">';
    echo $entry->message;
    echo '</p>';
	echo "</li>";
    NotificationRepository::setSeen($entry); 
}
?>
</div>
<div class="clearfix"></div>

<?php
    include_once('../includes/footer.php');
?>

<script>
    var url = "<?php echo MapStructureRepositorie::controller().'notificationController.php' ?>";
    var form = '<form method="POST" class="delete_form" action="'+url+'"><input type="hidden" name="id" value=":id"><input type="hidden" name="delete" value="1"></form>';
    $('.remove_item').click(function(){
        $('body').append(form.replace(':id',$(this).attr('item_id')));
        if(confirm('Weet u zeker dat u deze notifiactie wilt verwijderen?')) {
            $('.delete_form').submit();
        }

    });
</script>