<?php
include_once('../includes/head.php');
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
					echo FormRepositorie::password('Oude Wachtwoord', '', ['name' => 'passwordOld','id'=>'password', 'placeholder' => 'Oude Wachtwoord', 'required' => 1]);
					echo FormRepositorie::password('Nieuwe Wachtwoord', '', ['name' => 'password', 'id' => 'password1', 'placeholder' => 'Nieuwe Wachtwoord', 'required' => 1]);
					?>
					<div class="row">
						<div class="col-sm-6">
							<span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Minimaal 6 Karakters Lang<br>
							<span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Minimaal 1 Hoofdletter
						</div>
						<div class="col-sm-6">
							<span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Minimaal 1 kleine letter<br>
							<span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Minimaal 1 Number
						</div>
					</div>
					<?php
					echo FormRepositorie::password('Herhaal Wachtwoord', '', ['name' => 'password2', 'id' => 'password2', 'placeholder' => 'Herhaal Wachtwoord', 'required' => 1]);
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