<div class="text-center container mb-5 mt-5">

	<?php echo validation_errors('<div class="alert alert-danger">' , '</div>'); ?>

	<form class="form-signin " method="POST" action="">
	<h1 class="h3 mb-3 font-weight-normal"><?php echo $title; ?></h1>

		<?php
			if (!empty($error)) :
		?>
				<div class="alert alert-danger"><?= $error; ?></div>
		<?php endif; ?>
	<label for="inputEmail" class="sr-only ">Login</label>
	<input type="text" name="username" id="inputEmail" class="form-control mb-5" placeholder="Login" >

	<label for="inputPassword" class="sr-only">Password</label>
	<input type="password" id="inputPassword" name="password" class="form-control mb-5" placeholder="Password">

	<button class="btn btn-lg btn-primary mb-5" type="submit" name="login">Sign in</button>
</form>
</div>
