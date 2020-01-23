<div class="container">

	<?php echo validation_errors('<div class="alert alert-danger">' , '</div>'); ?>


	<form action="" method="POST">
		<?php

		if(!empty($_SESSION['error'])) : ?>
			<div class="alert alert-danger mb-5"><?= $_SESSION['error'] ?></div>
		<?php endif; ?>

		<?php
		if(isset($error)){
			echo (string)$error;
		}
		?>

		<div class="text-center form-row">
			<div class="form-group col-md-4">
				<label for="category ">Category name</label>
				<input class="form-control" type="text" id="category" name="category" value="<?= $category->name?>">
			</div>
		</div>

		<div class="align-left">
			<button type="submit" name="save" class="btn btn-primary">Save</button>
		</div>


	</form>
</div>
