<div class="container text-center">
<div id="legend">
	<legend class="">Edit profile</legend>
</div>

<?php echo validation_errors('<div class="alert alert-danger">' , '</div>'); ?>

<form action="/user/edit/<?= $user->id ?>" method="post" class="form-horizontal">
	<?php


		if(!empty($_SESSION['error'])) : ?>
		<div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
		<?php endif; ?>
	<?php
	if(isset($error)){
	echo (string)$error;
	}
	?>

	<div class="control-group">

		<label class="control-label"  for="username">Username:</label>
		<div class="controls">
			<input type="text" id="username" name="username" placeholder="" class="input-xlarge" value="<?= $user->login ?>">
		</div>
	</div>

	<div class="control-group">

		<label class="control-label"  for="email">Email:</label>
		<div class="controls">
			<input type="text" id="email" name="email" placeholder="" class="input-xlarge" value="<?= $user->email ?>">
		</div>
	</div>


	<div class="control-group mt-2">
		<!-- Button -->
		<div class="controls ">
			<button type="submit" name="save" class="btn btn-success">Save</button>
		</div>
	</div>

</form>
</div>
