<?php  
	// start session
	session_start();
	
	// keep user logged in function
	include "assets/includes/keep-user-logged-in-function.php";

	// if user's ID session or cookie email is not null direct user to dashboard's homepage
	if (loggedin()) {
		header("location: home");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Sa Aaron">
	<title>Notepad</title>
	<link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/REM.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark shadow-sm">
		<div class="container-fluid">
			<a class="navbar-brand" href="welcome">
				<img src="assets/img/logo.png" alt="logo">
			</a>
		</div>
	</nav>
	<div class="container" style="padding-top: 85px;">
		<div class="d-flex justify-content-center mb-3">
			<div class="note-preview">
				<img src="assets/img/preview.jpg" class="rounded shadow-lg" alt="preview">
			</div>
		</div>
		<div class="text-center">
			<h1 id="welcome-title">Welcome to Notepad!</h1>
			<p id="welcome-desp">
				Seamlessly store your notes in our online-based platform
			</p>
		</div>
		<div class="d-flex justify-content-center">
			<a href="login" class="me-2">
				<button type="button" class="btn btn-success">Login</button>
			</a>
			<a href="signup">
				<button type="button" class="btn btn-outline-secondary">Signup</button>
			</a>		
		</div>
	</div>
	<footer class="fixed-bottom p-5">
		<div class="text-center">
			&copy; 2023 Notepad by <b>Sa Aaron</b>
		</div>
	</footer>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>