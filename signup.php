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
	 
	// signup operation
	include "assets/includes/signup.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Sa Aaron">
	<title>Notepad - Signup</title>
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
	<div class="container" style="padding-top: 50px;">
		<div class="row">
			<div class="col-md-2 col-lg-4 col-xl-4"></div>
			<div class="col-md-8 col-lg-4 col-xl-4">
				<h3 class="text-center mb-4">Create an account</h3>
				<?php 
					// signup message
					echo $signup_msg; 
				?>
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" name="signup-form" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="d-grid gap-2">
						<div>
							<b>Full name</b>
							<input type="text" class="form-control" name="fullname" id="fullname" placeholder="What's your full name?" value="<?php if (isset($_POST['fullname'])) { echo $_POST['fullname']; } ?>" autocomplete="off">
							<div class="text-danger" id="fullname_val"><?php echo $full_name_error_msg; ?></div>
						</div>
						<div>
							<b>Email address</b>
							<input type="email" class="form-control" name="email" id="email" placeholder="yourname@domian.com" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>" autocomplete="off">
							<div class="text-danger" id="email_val"><?php echo $email_error_msg; ?></div>
						</div>
						<div>
							<b>Password</b>
							<input type="password" class="form-control" name="password" id="password" value="<?php if (isset($_POST['password'])) { echo $_POST['password']; } ?>" placeholder="6 - 50" autocomplete="off">
							<div class="text-danger" id="password_val"><?php echo $password_error_msg; ?></div>
						</div>
						<div class="d-grid mb-2">
							<button type="submit" class="btn btn-outline-dark btn-block">Signup</button>
						</div>
						<div class="text-center">
							Already have an account? <a href="login">Click here</a>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-2 col-lg-4 col-xl-4"></div>
		</div>
	</div>
	<footer class="fixed-bottom p-5">
		<div class="text-center">
			&copy; 2023 Notepad by <b>Sa Aaron</b>
		</div>
	</footer>
	<script src="assets/js/jquery-3.7.0.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/HideShowPassword.min.js"></script>
	<script src="assets/js/HideShowPass.js"></script>
	<script src="assets/js/form-validations.js"></script>
</body>
</html>