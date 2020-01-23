<div class="container">
	<?php if(isset($_SESSION['id'])) : ?>
	<div class="text-center">
		<a class="btn btn-success" href="/category/create/<?= $user->id ?>">Create</a>
	</div>
		<hr>
		<table class="table">
			<thead class="thead-dark">
			<tr>
				<th scope="col">id</th>
				<th scope="col">Name</th>
				<th scope="col">Action</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($categories as $category) : ?>
			<tr>
				<th scope="row"><?= $category->id ?></th>
				<td><?= $category->name ?></td>
				<td>
					<a class="ml-2 btn btn-info" href="/category/edit/<?= $user->id ?>/<?= $category->id ?>">Edit</a>
					<a class="ml-2 btn btn-warning" href="/category/destroy/<?= $user->id ?>/<?= $category->id ?>">Destroy</a>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

	<?php endif; ?>
</div>
