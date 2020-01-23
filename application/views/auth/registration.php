<div class="container text-center mb-5">
	<?php if(isset($_SESSION['success'])): ?>
		<div class="alert alert-success"> <?= $_SESSION['success'] ?></div>
	<?endif;?>
	<?php echo validation_errors('<div class="alert alert-danger">' , '</div>'); ?>
<form class="form-horizontal" action='' method="POST">
	<fieldset>
		<div id="legend">
			<legend class="">Register</legend>
		</div>
		<?php

		if(isset($error)){
			echo (string)$error;
		}
		?>
		<div class="control-group">
			<!-- Username -->
			<label class="control-label"  for="username">Username</label>
			<div class="controls">
				<input type="text" id="username" name="username" placeholder="" class="input-xlarge">

			</div>
		</div>

		<div class="control-group">
			<!-- E-mail -->
			<label class="control-label" for="email">E-mail</label>
			<div class="controls">
				<input type="text" id="email" name="email" placeholder="" class="input-xlarge">

			</div>
		</div>

		<div class="control-group">
			<!-- Password-->
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input type="password" id="password" name="password" placeholder="" class="input-xlarge">

			</div>
		</div>

		<div class="control-group">
			<!-- Password -->
			<label class="control-label"  for="password_confirm">Password (Confirm)</label>
			<div class="controls">
				<input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
			</div>
		</div>


		<div class="control-group mb-2">
			<!-- Password -->
			<label class="control-label"  for="role">Role</label>
			<div class="controls">
				<select name="role">
					<option value="1">Startup</option>
					<option value="2">Investor</option>
				</select>
			</div>
		</div>

		<div class="control-group">
			<!-- Button -->
			<div class="controls">
				<button type="submit" name="register" class="btn btn-success">Register</button>
			</div>
		</div>

	</fieldset>
	</form>

</div>
