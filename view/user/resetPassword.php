<?php
use model\User_password_reset as User_password_reset;
include_once('../../build/app.php');
if(isset($_GET['upr'])){$upr = model\User_password_reset::where('id','=',$_GET['upr'])->first();}else{
$upr = model\User_password_reset::where('token','=',$_GET['token'])->first();}
$upr_time = strtotime($upr->timestamp);
$lt1h = strtotime('-1 hour');
if(is_null($upr) || $upr_time < $lt1h){
	Services\SessionHandler::setSession('token_expired', 'Deze link is verouderd, vraag s.v.p. een nieuwe aan.');
	header('location:'.MapStructureRepositorie::view().'login.php');
    exit;
}
$user = model\Users::where('id','=',$upr->user_id)->first();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Windesheim Flevoland</title>

    <!-- Bootstrap -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo MapStructureRepositorie::build(); ?>css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div class="x_panel">
	<div class="x_title">
		<h2>Wachtwoord veranderen</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<?php 	
					if(Services\SessionHandler::has('user_edit_fail')){
						echo '<div class="col-lg-12"><div class="alert alert-danger" role="alert">'.Services\SessionHandler::getAndDelete('user_edit_fail').'</div></div>';
					}
					if(Services\SessionHandler::has('user_edit_passfail')){
						echo '<div class="col-lg-12"><div class="alert alert-danger" role="alert">'.Services\SessionHandler::getAndDelete('user_edit_passfail').'</div></div>';
					}
					echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'user/userController.php?user_id='.$user->id.'&passwordReset=1&upr='.$upr->id, 'file' => 1, 'method' => 'POST']); 

					echo FormRepositorie::password('Nieuw Wachtwoord', '', ['name' => 'password', 'id' => 'password1', 'pattern' => '^(?=(.*\d){1})(?=.*[a-zA-Z])[0-9a-zA-Z!@#$%]{5,}' , 'placeholder' => 'Nieuw Wachtwoord', 'required' => 1]);
					
					?>
					<div class="row">
						<div class="col-sm-6">
							<span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Minimaal 6 karakters <br>
							<span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Minimaal 1 hoofdletter
						</div>
						<div class="col-sm-6">
							<span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Minimaal 1 kleine letter<br>
							<span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Minimaal 1 nummer
						</div>
					</div>
					<?php
					echo FormRepositorie::password('Nieuw Wachtwoord bevestigen', '', ['name' => 'password2', 'id' => 'password2', 'placeholder' => 'Nieuw Wachtwoord bevestigen', 'required' => 1]);
					?>
					<div class="row">
						<div class="col-sm-12">
							<span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Wachtwoorden Komen Overeen
						</div>
					</div><br>
					<?php
					echo FormRepositorie::formSaveButton(MapStructureRepositorie::view(). "login.php");
					echo FormRepositorie::closeForm();
					?>
				</div><!--/col-sm-6--> 
			</div><!--/row-->
		</div>
	</div>
</div>
</div>

</div>
<!-- /page content -->

<!-- footer content -->
<footer style="margin:0;">
    <div class="pull-right">
        <?php echo ConfigRepositorie::get('title'); ?> - Aanwezigheids administratie
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>skycons/skycons.js"></script>
<!-- Flot -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Flot/jquery.flot.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Flot/jquery.flot.pie.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Flot/jquery.flot.time.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Flot/jquery.flot.stack.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>jqvmap/dist/jquery.vmap.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>moment/min/moment.min.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Password Validator -->
<script src="<?php echo MapStructureRepositorie::build(); ?>js/validator.js"></script>

<!-- Dropzone Script -->
<script src="<?php echo MapStructureRepositorie::build(); ?>js/dropzone.js"></script>

<!-- Select2 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo MapStructureRepositorie::build(); ?>js/custom.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
        $(".select2").select2({
            placeholder: "Selecteer"
        });
    });
</script>

</body>
</html>

<script>
	$("#password").keyup(function(){
		$.ajax({
			url: "<?php echo MapStructureRepositorie::controller().'user/userController.php' ?>",
			method: 'GET',
			data: {password:this.value,passwordCheck:1},
			success: function(data){
				if(data == 1){
					$('#password').parent().addClass('has-success');
					$('#password').parent().removeClass('has-error');
				}
				else{
					$('#password').parent().addClass('has-error');
					$('#password').parent().removeClass('has-success');
				}
			}
		});
	});
</script>