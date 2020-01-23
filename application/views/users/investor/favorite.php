<?php foreach ($startups as $startup) : ?>
<div class="container">
		<div class="well">
			<div class="media">
				<a class="pull-left" href="#">

					<div id="carouselExampleIndicators<?= $startup['id'] ?>" class="carousel slide mr-2" data-ride="carousel">
						<ol class="carousel-indicators">
															<?php $active = true; ?>
							<?php foreach ($startup['photos_id'] as $str_id) : ?>
								<li data-target="#carouselExampleIndicators<?= $startup['id'] ?>" data-slide-to="<?= $str_id ?>" class="active"></li>
							<?php endforeach; ?>
						</ol>
						<div class="carousel-inner">
							<?php foreach($startup['photos_photo'] as $str_photo) : ?>
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
						<a class="carousel-control-prev" href="#carouselExampleIndicators<?= $startup['id'] ?>" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators<?= $startup['id'] ?>" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</a>
				<div class="media-body">
					<h4 class="media-heading"><?= $startup['title'] ?></h4>
					<p class="text-right">By <?= $user->login ?></p>
					<?= $startup['descriptions'] ?>

					<p class="text-right">Company: </p><h2 class="text-right"><?= $startup['company'] ?></h2>
					<h3>From: <?= $startup['country'] ?></h3>
					<p class="text-right">Category: <?= $startup['categories'] ?></p>

					<a class="text-right btn btn-success" href="/startup/showone/<?= $startup['id'] ?>">View</a>
					<a class="text-right btn btn-warning" href="/user/deletemyfavorite/<?= $user->id ?>/<?= $startup['id'] ?>">Delete from my favorite</a>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>

