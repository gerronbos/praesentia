<?php
    include_once('includes/head.php');
?>

<form enctype="multipart/form-data" action="<?php echo MapStructureRepositorie::controller();?>csvController.php" method="POST">
<input type="file" name="file"><br />
<input class="btn btn-primary" id="submit" data-loading-text="Verwerken..." type="submit" value="Importeer CSV">
</form>

<?php
    include_once('includes/footer.php');
?>