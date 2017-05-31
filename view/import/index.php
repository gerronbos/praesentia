<?php
include_once('../includes/head.php');
if (!Auth::user()->can('import')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}
?>
<div class="x_panel">
    <div class="x_title">
        <h2>Importeren </h2>
        <ul class="nav navbar-right panel_toolbox"></ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row" style="text-align: center">
            <div class="col-lg-4">
                <span class="fa fa-users fa-5x" style="font-size: 150px; margin-bottom: 1%"></span>
                <a href="<?php echo MapStructureRepositorie::view(); ?>user/userAddOption.php" class="btn btn-primary btn-block">Gebruikers bijwerken</a>
            </div>
            <div class="col-lg-4">
                <span class="fa fa-calendar fa-5x" style="font-size: 150px; margin-bottom: 1%"></span>
                <a href="<?php echo MapStructureRepositorie::view(); ?>lecture/importlecture.php" class="btn btn-primary btn-block">Lessen importeren</a>
            </div>
            <div class="col-lg-4">
                <span class="fa fa-camera-retro fa-5x" style="font-size: 150px; margin-bottom: 1%"></span>
                <a href="<?php echo MapStructureRepositorie::view(); ?>user/profilePic.php" class="btn btn-primary btn-block">Profiel fotos bijwerken</a>
            </div>
        </div>
    </div>
</div>
<?php
include_once('../includes/footer.php');
?>

