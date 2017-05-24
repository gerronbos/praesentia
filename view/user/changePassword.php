<?php
include_once('../includes/head.php');
if(!Auth::user()->can('user')){
    header("location: ".MapStructureRepositorie::error('401'));
    exit;
}
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Wachtwoord veranderen</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<?php
	if(Services\SessionHandler::has('user_edit_succes')){
		echo '<div class="col-lg-12"><div class="alert alert-success" role="alert">'.Services\SessionHandler::getAndDelete('user_edit_succes').'</div></div>';
	}
	?>
	<div class="x_content">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<?php 	
					echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'user/userController.php?user_id='.Auth::user()->id.'&updatePassword=1', 'file' => 1, 'method' => 'POST']); 
					echo FormRepositorie::password('Huidig Wachtwoord', '', ['name' => 'passwordOld','id'=>'password', 'placeholder' => 'Huidig Wachtwoord', 'required' => 1]);

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
					echo FormRepositorie::formSaveButton("javascript:history.back()");
					echo FormRepositorie::closeForm();
					?>
				</div><!--/col-sm-6--> 
			</div><!--/row-->
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