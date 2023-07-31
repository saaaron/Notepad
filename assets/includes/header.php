<?php 
	// start session
	session_start();

	if (isset($_SESSION["id"])) {
    	$id = $_SESSION['id'];
    }

    // connect to database
    include "../assets/includes/db_connect.php";

	// keep user logged in function
	include "../assets/includes/keep-user-logged-in-function.php";

	// if user's ID session or cookie email is null redirect user back to welcome page
	if (!loggedin()) {
		header("location: welcome");
		exit();
	}

	// note stats
	include "../assets/includes/note-stats.php";

	// user's info
	include "../assets/includes/user-info.php";

	// keep side bar options active if on current page
	$active_home = $active_profile = $active_favourite = $active_search = $active_settings = "";

	if ($title == "Home") {
		$active_home = " sidebar-option-active"; // active css class
	} elseif ($title == "My profile") {
		$active_profile = " sidebar-option-active";
	} elseif ($title == "Favourite") {
		$active_favourite = " sidebar-option-active";
	} elseif ($title == "Search") {
		$active_search = " sidebar-option-active";
	} elseif ($title == "Settings - Change password" || $title == "Settings - Delete account" || $title == "Settings - Change theme") {
		$active_settings = " sidebar-option-active";
	}

	echo '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Sa Aaron">
	<title>'.$title.'</title>
	<link rel="icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/REM.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/summernote-bs5.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/croppie.css">
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-secondary navbar-dark shadow-sm">
		<div class="container-fluid">
			<div class="d-flex justify-content-start">
				<div class="me-2">
					<button type="button" class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
		          		<span class="navbar-toggler-icon"></span>
		        	</button>
		        </div>
		        <div class="mt-1">
					<a class="navbar-brand" href="home">
						<img src="assets/img/logo.png" alt="logo">
					</a>
				</div>
			</div>
		</div>
	</nav>
	<!-- side bar -->
	<div class="offcanvas offcanvas-start" id="sidebar">
		<div class="offcanvas-header d-flex justify-content-end">
			<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
		</div>	  
		<div class="offcanvas-body">
			<div class="d-grid gap-1">
				<div>
					<div class="d-flex justify-content-center mb-1">
						<div class="profile-photo">
							'.$set_profile_photo.'
						</div>
					</div>
					<div class="text-center">
						<h4>'.$full_name.'</h4>
					</div>
				</div>
				<div class="sidebar-option p-2'.$active_profile.'">
					<a href="profile"><div><span class="icon icon-user text-muted"></span> My profile</div></a>
				</div>
				<div class="sidebar-option p-2'.$active_home.'">
					<a href="home"><div><span class="icon icon-doc-text-inv text-muted"></span> All notes <span class="badge bg-secondary">'.$total_num_of_notes.'</span></div></a>
				</div>
				<div class="sidebar-option p-2'.$active_favourite.'">
					<a href="favourite"><div><span class="icon icon-heart text-muted"></span> Favourite <span class="badge bg-secondary">'.$total_num_of_favourites.'</span></div></a>
				</div>
				<div class="sidebar-option p-2'.$active_search.'">
					<a href="search"><div><span class="icon icon-search text-muted"></span> Search</div></a>
				</div>
				<div>
					<div class="p-2'.$active_settings.'"><span class="icon icon-cog text-muted"></span> Settings</div>
					<div class="subset-link">
						<div class="ms-3"><b>Account</b></div>
						<div class="ms-3"><a href="change_password">Change password</a></div>
						<div class="ms-3"><a href="delete_account">Delete account</a></div>
					</div>
				</div>
				<div class="sidebar-option p-2">
					<a href="logout"><div><span class="icon icon-enter text-muted"></span> Logout</div></a>
				</div>
			</div>
			<div class="p-4">
				<div class="text-center">
					&copy; 2023 Notepad by <b>Sa Aaron</b>
				</div>
			</div>
		</div>      		
	</div>';
?>