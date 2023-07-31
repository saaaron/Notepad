<?php
	// start session
	session_start(); 

	// connect to database
	include 'db_connect.php';

    if (isset($_POST['old_pass'])) {
 		$response = array();

 		$id = $_SESSION['id']; // user's id

 		$old_pass = $_POST["old_pass"]; // user's old password
 		
 		// select password
		$select_pass = "SELECT password FROM users WHERE id = ?";
    	if ($stmt = mysqli_prepare($db, $select_pass)) {
		    mysqli_stmt_bind_param($stmt, "i", $id);
		    mysqli_stmt_execute($stmt);
		    mysqli_stmt_bind_result($stmt, $r_pass);
		    while (mysqli_stmt_fetch($stmt)) {
		  		// fetch results
		    }
	    
	    	// close statement
	    	mysqli_stmt_close($stmt);
		}

        if (empty(trim($old_pass))) {
        	$response['status'] = false;
        	$response['msg'] = 'Old password is empty';
        } elseif (!password_verify(trim($old_pass), $r_pass)) {
			$response['status'] = false;
 			$response['msg'] = 'This is not your old password';
		} else {
 			$response['status'] = true;
 			$response['msg'] = '';
 		}
 		
 		echo json_encode($response);
    }
?>