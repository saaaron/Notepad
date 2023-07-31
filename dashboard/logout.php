<?php 
	// start session
	session_start();

	// unset session
	session_unset();

    // destroy session
	session_destroy();

    // destroy cookie
	setcookie ("email", "", time()- (60 * 60 * 24 * 30), "/");

	// direct user to welcome page
	header("location: welcome"); 
	exit();
?>