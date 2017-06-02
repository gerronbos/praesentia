<?php
use model\User_password_reset as User_password_reset;
include_once('../../build/app.php');

$upr = model\User_password_reset::where('token','=',$_GET['token'])->first();
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
<?php
include_once('../includes/footer.php');
?>
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