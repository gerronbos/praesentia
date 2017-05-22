<?php include_once('../includes/head.php');
$user = Services\SessionHandler::getSession('user_data');
$presence_data = Services\SessionHandler::getSession('presence_data');
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
            <h4>Skills</h4>
            <ul class="list-unstyled user_data">
              <li>
                <p>Web Applications</p>
                <div class="progress progress_sm">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                </div>
              </li>
              <li>
                <p>Website Design</p>
                <div class="progress progress_sm">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                </div>
              </li>
              <li>
                <p>Automation & Testing</p>
                <div class="progress progress_sm">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                </div>
              </li>
              <li>
                <p>UI / UX</p>
                <div class="progress progress_sm">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                </div>
              </li>
            </ul>
            <!-- end of skills -->

          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">

            <div class="profile_title">
              <div class="col-md-6">
                <h2>User Activity Report</h2>
              </div>
              <div class="col-md-6">
                <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                </div>
              </div>
            </div>
            <!-- start of user-activity-graph -->
            <div id="graph_bar" style="width:100%; height:280px;"></div>
            <!-- end of user-activity-graph -->

            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Aanwezigheid per vak</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                  <!-- start recent activity -->
                  <ul class="messages">
                    <li>
                      <img src="images/img.jpg" class="avatar" alt="Avatar">
                      <div class="message_date">
                        <h3 class="date text-info">24</h3>
                        <p class="month">May</p>
                      </div>
                      <div class="message_wrapper">
                        <h4 class="heading">Desmond Davison</h4>
                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                        <br />
                        <p class="url">
                          <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                          <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                        </p>
                      </div>
                    </li>
                    <li>
                      <img src="images/img.jpg" class="avatar" alt="Avatar">
                      <div class="message_date">
                        <h3 class="date text-error">21</h3>
                        <p class="month">May</p>
                      </div>
                      <div class="message_wrapper">
                        <h4 class="heading">Brian Michaels</h4>
                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                        <br />
                        <p class="url">
                          <span class="fs1" aria-hidden="true" data-icon=""></span>
                          <a href="#" data-original-title="">Download</a>
                        </p>
                      </div>
                    </li>
                    <li>
                      <img src="images/img.jpg" class="avatar" alt="Avatar">
                      <div class="message_date">
                        <h3 class="date text-info">24</h3>
                        <p class="month">May</p>
                      </div>
                      <div class="message_wrapper">
                        <h4 class="heading">Desmond Davison</h4>
                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                        <br />
                        <p class="url">
                          <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                          <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                        </p>
                      </div>
                    </li>
                    <li>
                      <img src="images/img.jpg" class="avatar" alt="Avatar">
                      <div class="message_date">
                        <h3 class="date text-error">21</h3>
                        <p class="month">May</p>
                      </div>
                      <div class="message_wrapper">
                        <h4 class="heading">Brian Michaels</h4>
                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                        <br />
                        <p class="url">
                          <span class="fs1" aria-hidden="true" data-icon=""></span>
                          <a href="#" data-original-title="">Download</a>
                        </p>
                      </div>
                    </li>

                  </ul>
                  <!-- end recent activity -->

                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                  <!-- start user projects -->
                  <table class="data table table-striped no-margin">
                    <thead>
                      <tr>
                        <th>Vak</th>
                        <th>Aantal lessen</th>
                        <th>Aanwezig</th>
                        <th>Aanwezig</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($presence_data as $pd){
                        echo "<tr><td>".$pd['title']."</td><td>".$pd['amount_lectures']."</td><td>".$pd['amount_present']."</td><td class='vertical-align-mid'><div class='progress'><div class='progress-bar progress-bar-success' data-transitiongoal='".$pd['amount_present_prec']."'>".$pd['amount_present_prec']."%</div></div></td></tr>";
                    }
                    ?>
                    </tbody>
                  </table>
                  <!-- end user projects -->

                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                  <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                    photo booth letterpress, commodo enim craft beer mlkshk </p>
                  </div>
                </div>
              </div>
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