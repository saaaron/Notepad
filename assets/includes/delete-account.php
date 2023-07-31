<?php  
	// start session
	session_start();

	// include database connection
	include "db_connect.php";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$id = $_SESSION['id']; // user's id

		$query = "DELETE FROM users WHERE id = ?";
		if ($stmt = mysqli_prepare($db, $query)) {
	    	mysqli_stmt_bind_param($stmt, "i", $id);
	    	mysqli_stmt_execute($stmt);

	    	$query = "DELETE FROM notes WHERE by_user_id = ?";
			$stmt = mysqli_prepare($db, $query);
	    	mysqli_stmt_bind_param($stmt, "i", $id);
	    	mysqli_stmt_execute($stmt);

			// unset session
			session_unset();

		    // destroy session
			session_destroy();

		    // destroy cookie
			setcookie ("email", "", time()- (60 * 60 * 24 * 30), "/");

			// account deleted successful
			header("location: ../../login?acct_status=deleted");
			exit();
						
		} else {

			// error occurred
			header("location: ../../delete_account?status=failed");
			exit();
		} 
        // close statement
        mysqli_stmt_close($stmt);
	}
	// close db connection
    mysqli_close($db);
?>