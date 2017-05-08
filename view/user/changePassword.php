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
		<?php
			/*echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'user/userController.php', 'file' => 1, 'method' => 'POST', 'data-toggle' => 'validator']);
			echo FormRepositorie::password('Oude wachtwoord', '', ['name' => 'oldPassword']);
			echo FormRepositorie::password('Nieuwe wachtwoord', '', ['name' => 'newPassword']);
			echo FormRepositorie::password('Herhaal nieuwe wachtwoord', '', ['name' => 'newPasswordHer']);
			echo FormRepositorie::formSaveButton('javascript:history.back()');
			echo FormRepositorie::closeForm();*/
			?>
			<div class="form-group">
				<label for="inputPassword" class="control-label">Password</label>
				<div class="form-inline row">
					<div class="form-group col-sm-6">
					<? echo FormRepositorie::password('Oude Wachtwoord', '', )?>
						<div class="help-block">Minimum of 6 characters</div>
					</div>
					<div class="form-group col-sm-6">
						<input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
						<div class="help-block with-errors"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once('../includes/footer.php');
	?>