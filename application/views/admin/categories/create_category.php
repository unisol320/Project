<div class="container">

	<?php echo validation_errors('<div class="alert alert-danger">' , '</div>'); ?>

	<form method="post" action="">

		<?php
		if(isset($error)){
			echo (string)$error;
		}
		?>

		<div class="text-center form-row">
			<div class="form-group col-md-4">
				<label for="category ">Category name</label>
				<input class="form-control" type="text" id="category" name="category">
			</div>
		</div>

		<div class="align-left">
			<button type="submit" name="save" class="btn btn-primary">Save</button>
		</div>

	</form>
</div>
