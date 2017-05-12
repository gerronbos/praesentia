<?php
include_once('../includes/head.php');
?>
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
					echo FormRepositorie::openForm(); 
					echo FormRepositorie::password('Oude Wachtwoord', '', ['name' => 'password','id'=>'password', 'placeholder' => 'Oude Wachtwoord']);
					echo FormRepositorie::password('Nieuwe Wachtwoord', '', ['name' => 'password1', 'id' => 'password1', 'placeholder' => 'Nieuwe Wachtwoord']);
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
					echo FormRepositorie::password('Herhaal Wachtwoord', '', ['name' => 'password2', 'id' => 'password2', 'placeholder' => 'Herhaal Wachtwoord']);
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