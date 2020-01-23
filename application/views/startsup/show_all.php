<div class="container">
	<?php if(isset($_SESSION['error'])): ?>
		<div class="alert alert-warning"> <?= $_SESSION['error'] ?></div>
	<?endif;?>
	<?php if(isset($_SESSION['success'])): ?>
		<div class="alert alert-success"> <?= $_SESSION['success'] ?></div>
	<?endif;?>
<?php if(isset($_SESSION['id'])) : ?>
	<div class="text-right mb-3">
		<div class="dropdown show">
			<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Date:
			</a>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="/startup/show/<?= $user->id ?>/asc">Down</a>
				<a class="dropdown-item" href="/startup/show/<?= $user->id ?>/desc">Up</a>
			</div>
		</div>
	</div>
	<?php if($user->role == 2 || $user->role == 3) : ?>
	<div class="text-right mb-3">
		<div class="dropdown show">
			<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Category:
			</a>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<?php foreach ($categories as $category) : ?>
					<a class="dropdown-item" href="/startup/show/<?= $user->id ?>/desc/0/<?= $category->id ?>"><?= $category->name ?></a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<form method="post" action="/startup/search/<?= $user->id ?>">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="search">Search:</label>
				<input id="search" type="text" name="search">
				<button type="submit" class="btn btn-success" name="submit">Search</button>
			</div>
		</div>
	</form>
	<?php $active = true; ?>
	<?foreach ($startups as $startup) : ?>
	<div class="container">
		<div class="well">
			<div class="media">
				<div id="carouselExampleIndicators<?= $startup->id ?>" class="carousel slide mr-2" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php foreach ($startup->photos_id as $str_id) : ?>
							<li data-target="#carouselExampleIndicators<?= $startup->id ?>" data-slide-to="<?= $str_id ?>" class="active"></li>
						<?php endforeach; ?>
					</ol>
					<div class="carousel-inner">
						<?php foreach ($startup->photos_photo as $str_photo) : ?>
							<?php if($active) : ?>
								<div class="carousel-item active">
									<img width="200" height="200" src="<?= site_url('/uploads/'.$str_photo) ?>" class="d-block h-200 w-200 media-object" alt="...">
								</div>
								<?php $active = false; ?>
							<?php else : ?>
								<div class="carousel-item">
									<img width="200" height="200" src="<?= site_url('/uploads/'.$str_photo) ?>" class="d-block h-200 w-200 media-object" alt="...">
								</div>
							<?php endif; ?>
							<?php endforeach; ?>
						<?php $active = true; ?>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators<?= $startup->id ?>" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators<?= $startup->id ?>" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading"><?= $startup->title ?></h4>
					<p class="text-right">By <?= $user->login ?></p>
					<?= $startup->descriptions ?>

					<p class="text-right">Company: </p><h2 class="text-right"><?= $startup->company ?></h2>
					<h3>From: <?= $startup->country ?></h3>

					<p class="text-right">Category: <?= $startup->categories ?></p>

					<?php if($user->role == 1 ) : ?>
						<?php if($startup->status == 0): ?>
							<p class="text-danger text-center">Status: Hidden</p>
						<?php else : ?>
							<p class="text-success text-center">Status: Visible</p>

						<?php endif; ?>
						<a class="text-right btn btn-info" href="/startup/edit/<?= $startup->id ?>/<?= $_SESSION['id'] ?>">Edit</a>
						<a class="text-right btn btn-danger" href="/startup/destroy/<?= $startup->id ?>/<?= $_SESSION['id'] ?>">Delete</a>

					<?php elseif ($user->role == 3) : ?>
						<a class="text-right btn btn-info" href="/startup/edit/<?= $startup->id ?>/<?= $_SESSION['id'] ?>">Edit</a>
						<a class="text-right btn btn-danger" href="/startup/destroy/<?= $startup->id ?>/<?= $_SESSION['id'] ?>">Delete</a>
						<?php if($startup->status == 0) : ?>
							<a class="text-right btn btn-warning" href="/startup/doStartupVisible/<?= $startup->id ?>/<?= $_SESSION['id'] ?>">Do visible</a>
						<?php else : ?>
							<a class="text-right btn btn-warning" href="/startup/showone/<?= $startup->id ?>/<?= $_SESSION['id'] ?>">Hide</a>
						<?php endif; ?>
					<?php elseif($user->role == 2) : ?>
						<a class="text-right btn btn-success" href="/user/addtomyfavorite/<?= $startup->id ?>/<?= $_SESSION['id'] ?>">Add to my favorite</a>
					<?php endif; ?>

					<a class="text-right btn btn-success" href="/startup/showEntity/<?= $startup->id ?>">View</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>

<div class="text-center">

<?php if (isset($links)){
	echo $links;
} ?>
</div>
<?php else : ?>
	<a href="/auth/login">Please login : </a>
<?php endif; ?>

</div>
