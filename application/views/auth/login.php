<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="generator" content="">
	<title>Sign In</title>
	<link rel="icon" href="/assets/images/logo-polindra.png">

	<link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>

	<link href="/assets/sign-in/signin.css" rel="stylesheet">

</head>

<body class="text-center">

	<div class="form-signin">
		<img class="mb-4" src="/assets/images/logo-polindra.png" alt="" width="72" height="72">

		<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

		<label for="inputEmail" class="sr-only">Username</label>
		<input type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus>

		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

		<button class="btn btn-lg btn-primary btn-block" id="signin">Sign in</button>

		<p class="mt-5 mb-3 text-muted">&copy; <?= date("Y") ?></p>
	</div>

	<script type="text/javascript" src="/assets/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/sweetalert2/dist/sweetalert2.all.min.js"></script>

	<script src="/assets/sign-in/signin.js"></script>

</body>

</html>
