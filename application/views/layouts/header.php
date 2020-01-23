<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<title><?php echo $title; ?></title>
</head>
<body>
<main>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow mb-5">
	<h5 class="my-0 mr-md-auto font-weight-normal">Funtsup</h5>
	<nav class="my-2 my-md-0 mr-md-3">
		<a class="p-2 text-dark" href="/">Main</a></a>
		<?php
			if (isset($_SESSION['id'])) :
		?>
			<?php if ($user->role == 1) : ?>
				<a class="p-2 text-dark" href="/startup/create/<?= $_SESSION['id'] ?>">Create startup</a>
				<a class="p-2 text-dark" href="/startup/show/<?= $_SESSION['id'] ?>">Show my startups</a>
			<?php else : ?>
				<a class="p-2 text-dark" href="/startup/show/<?= $_SESSION['id'] ?>">Show startups</a>
			<?php endif; ?>
			<?php if($user->role == 3) : ?>
				<a class="p-2 text-dark" href="/category/show/<?= $_SESSION['id'] ?>">Show categories</a>
			<?php endif; ?>
				<?php if($user->role == 2) : ?>
					<a class="p-2 text-dark" href="/user/favorite/<?= $_SESSION['id'] ?>">Show my favorite</a>
				<?php endif; ?>
			<?php endif; ?>

	</nav>
	<?php if(isset($_SESSION['id'])){ ?>
		<a class="btn btn-outline-primary ml-2" href="/user/profile/<?= $_SESSION['id'] ?>">Profile</a>
		<a class="btn btn-outline-primary ml-2" href="/auth/destroy">Logout</a>
	<?php }else{ ?>
		<a class="btn btn-outline-primary ml-2" href="/auth/register">Sign up</a>
		<a class="btn btn-outline-primary ml-2" href="/auth/login">Sign in</a>
	<?php } ?>
</div>



