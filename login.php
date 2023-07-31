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

	// login operation
	include "assets/includes/login.php";

	// deleted account messsage
	if (isset($_GET['acct_status'])) {
		if ($_GET['acct_status'] == "deleted") {
			$d_msg = '
			<div class="alert alert-success alert-dismissible fade show">
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				Account deleted successfully!
			</div>';
		} else {
			$d_msg = "";
		}
	} else  {
		$d_msg = "";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Sa Aaron">
	<title>Notepad - Login</title>
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
				<h3 class="text-center mb-3">Login</h3>
				<?php
					// login message
					echo $login_msg;

					// deleted acct message
					echo $d_msg;
				?>
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" name="signup-form" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="d-grid gap-2">
						<div>
							<input type="email" name="email" class="form-control" placeholder="Email address" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>" autocomplete="off" required>
						</div>
						<div>
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php if (isset($_POST['password'])) { echo $_POST['password']; } ?>" autocomplete="off" required>
						</div>
						<div class="d-grid mb-2">
							<button type="submit" class="btn btn-success btn-block">Login</button>
						</div>
						<div class="text-center">
							Don't have an account? <a href="signup">Click here</a>
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
</body>
</html>