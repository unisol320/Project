<div class="container">

	<?php echo validation_errors('<div class="alert alert-danger">' , '</div>'); ?>


	<form action="" method="POST" enctype="multipart/form-data">
		<?php

		if(!empty($_SESSION['error'])) : ?>
			<div class="alert alert-danger mb-5"><?= $_SESSION['error'] ?></div>
		<?php endif; ?>

		<?php
		if(isset($error)){
			echo (string)$error;
		}
		?>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="company">Company name:</label>
				<input type="text" name="company" class="form-control" id="company" value="<?= $startup->company ?>">
			</div>

			<div class="form-group col-md-4">
				<label for="inputState">Country:</label>
				<select id="inputState" name="country" class="form-control">
					<option value="Ukraine">Ukraine</option>
					<option value="Russia">Russia</option>
				</select>
			</div>

		</div>

		<div>
			<div class=" form-group mb-2">
				<h2>About your project:</h2>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="title">Title:</label>
					<input type="text" name="title" class="form-control" id="title" value="<?= $startup->title ?>">
				</div>

				<div class="form-group col-md-6">
					<label for="descriptions">Description:</label>
					<textarea class="form-control" id="descriptions" name="descriptions" ><?= $startup->descriptions ?></textarea>
				</div>

			</div>
		</div>

</div>

<div class="text-center">
	<button type="submit" name="save" class="btn btn-primary">Save</button>
</div>

</form>
</div>
