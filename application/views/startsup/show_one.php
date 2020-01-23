<div class="container">
	<div class="container">
		<div class="well">
			<div class="media">
				<div id="carouselExampleIndicators" class="carousel slide mr-2" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php foreach ($photos as $photo) : ?>
							<li data-target="#carouselExampleIndicators" data-slide-to="<?= $photo['id'] ?>" class="active"></li>
						<?php endforeach; ?>
					</ol>
					<div class="carousel-inner">
					<?php $active = true; ?>

						<?php foreach ($photos as $photo) : ?>
							<?php if($active) : ?>
								<div class="carousel-item active">
									<img width="200" height="200" src="<?= site_url('/uploads/'.$photo['photo']) ?>" class="d-block h-200 w-200 media-object" alt="...">
								</div>
								<?php $active = false; ?>
							<?php else : ?>
								<div class="carousel-item">
									<img width="200" height="200" src="<?= site_url('/uploads/'.$photo['photo']) ?>" class="d-block h-200 w-200 media-object" alt="...">
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
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

					<?php elseif ($user->role == 3) : ?>
						<a class="text-right btn btn-info" href="/startup/edit/<?= $startup->id ?>/<?= $_SESSION['id'] ?>">Edit</a>
						<a class="text-right btn btn-danger" href="/startup/destroy/<?= $startup->id ?>/<?= $_SESSION['id'] ?>">Delete</a>
						<?php if($startup->status == 0) : ?>
							<a class="text-right btn btn-warning" href="/startup/dovisible/<?= $startup->id ?>/<?= $_SESSION['id'] ?>">Do visible</a>
						<?php else : ?>
							<a class="text-right btn btn-warning" href="/startup/showone/<?= $startup->id ?>/<?= $_SESSION['id'] ?>">Hide</a>
						<?php endif; ?>

					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</div>
