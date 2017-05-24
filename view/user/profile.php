<?php include_once('../includes/head.php');
$user = Services\SessionHandler::getSession('user_data');
$presence_data = PresenceRepository::calcPresenceByUser($user);
$presence_data_days = PresenceRepository::getByLastDays($user);
if(Auth::user()->id != $user->id) {
    if (!Auth::user()->can('user')) {
        header("location: " . MapStructureRepositorie::error('401'));
        exit;
    }
}
?>
<?php
if(Services\SessionHandler::has('user_edit_succes')){
  echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('user_edit_succes').'</div></div>';
}
?>
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Profiel</h3>
    </div>

  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Profiel van <?php echo $user->fullname(); ?><small>Aanwezigheid</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
            <div class="profile_img">
              <div id="crop-avatar">
                <!-- Current avatar -->
                <img class="img-responsive avatar-view" src="<?php echo $user->getUserProfilePicture(); ?>" alt="Avatar" title="Change the avatar">
              </div>
            </div>
            <h3><?php echo $user->fullname(); ?></h3>

            <ul class="list-unstyled user_data">
              <li><i class="fa fa-key user-profile-icon"></i> <?php echo $user->user_number; ?>
              </li>

              <li style="font-size: 12px;">
                <i class="fa fa-envelope-o user-profile-icon"></i> <?php echo $user->email; ?>
              </li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opties <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="<?php echo MapStructureRepositorie::controller()."user/userController.php?update_view=1&user_id=".$user->id ?>">Gebruiker wijzigen</a></li>
                <li><a href="<?php echo MapStructureRepositorie::controller()."roles/roleController.php?user_roles=1&user_id=".$user->id ?>">Rechten wijzigen</a></li>
                <li>
                  <a href="<?php echo MapStructureRepositorie::view()."user/changePassword.php?resetPassword=1" ?> ">Wachtwoord veranderen</a>
                </li>
                <li>
                  <a href="#myModal" data-toggle="modal" data-target="#myModal">Wachtwoord resetten</a>
                </li>
              </ul>
            </div>
                <a href="<?php echo MapStructureRepositorie::view().'user/presence/index.php' ?>" class="btn btn-primary">Afmelden voor een college</a>
                <br />

            <!-- start skills -->
            <h4>Aanwezigheid per vak</h4>
            <ul class="list-unstyled user_data">
                <?php foreach($presence_data as $pd){
                    echo "<li><p>".$pd['title']."</p>".progressBar($pd['amount_present_prec'])."</li>";
                }
                ?>
            </ul>
            <!-- end of skills -->

          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">

            <div class="profile_title">
              <div class="col-md-6">
                <h2>Aanwezigheid afgelopen 7 dagen</h2>
              </div>
            </div>
            <!-- start of user-activity-graph -->
              <canvas id="myChart" width="400" height="200"></canvas>
            <!-- end of user-activity-graph -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../includes/footer.php'); ?>

  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title text-center">Wachtwoord resetten</h4>
        </div>
        <div class="modal-body">
          <p class="text-center">Weet u zeker dat u het wachtwoord wilt resetten?</p>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn btn-danger">Nee</a>
          <a href="<?php echo MapStructureRepositorie::controller()."user/userController.php?resetPassword=1&user_id=".$user->id ?>" class="btn btn-success">Ja</a>
        </div>
      </div>

<script>
    var labels = [];
    var data = [];
    var backgroundColor = [];
    var borderColor = [];
    <?php
        foreach($presence_data_days as $key=>$data){
            echo "labels.push('$key');";
            echo "data.push('".$data['amount_present_prec']."');";
            if($data['amount_present_prec'] == 100){
            echo "backgroundColor.push('rgba(26, 187, 156, 0.5)');";
            echo "borderColor.push('rgba(26, 187, 156, 1)');";
            }
            elseif($data['amount_present_prec'] > 50){
            echo "backgroundColor.push('rgba(240, 173, 78, 0.5)');";
            echo "borderColor.push('rgba(240, 173, 78, 1)');";
            }
            else{
            echo "backgroundColor.push('rgba(217, 83, 79, 0.5)');";
            echo "borderColor.push('rgba(217, 83, 79, 1)');";
            }

        }
    ?>
$(document).ready(function(){
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '% aanwezig',
                data: data,
                backgroundColor: backgroundColor,
                borderColor: borderColor,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
});

</script>
