<div class="container">
	<form>

		<div class="form-group">
			<div id="legend">
				<legend class="">Profile: <?= $user->login ?></legend>
			</div>

			<a href="/user/edit/<?= $_SESSION['id'] ?>">Edit</a>
			<a href="/user/destroy/<?= $_SESSION['id'] ?>">Delete</a>

		</div>
	</form>
</div>
