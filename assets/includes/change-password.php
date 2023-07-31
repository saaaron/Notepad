<?php  
	// header
	header('Content-Type: application/json');

	// start session
	session_start();

	// include database connection
	include "db_connect.php";

	// variables
	$msg = $error = $error1 = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$id = $_SESSION['id']; // user's id

		// old password
		$select_old_pass = "SELECT password FROM users WHERE id = ?";
	    if ($stmt = mysqli_prepare($db, $select_old_pass)) {
			mysqli_stmt_bind_param($stmt, "i", $id);
		 	mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $r_pass);
			while (mysqli_stmt_fetch($stmt)) {
			  	// fetch results
			}
		    
		   	// close statement
		    mysqli_stmt_close($stmt);
		}

	    if (!password_verify($_POST['old_password'], $r_pass)) {
			$error = true; // This is not your old password
		} else {
			$old_pass = $_POST['old_password']; // old password
	 		$error = false; 
	 	}

	 	// new password
	 	if (strlen($_POST['new_password']) < 6) {
			$error1 = true; // Your new password must be at least 6 characters
		} elseif (strlen($_POST['new_password']) > 50) {
			$error1 = true; // Your new password is too long
		} else {
	 		$new_pass = $_POST['new_password']; // new password
	 		$error1 = false;
	 	}

	 	if ($error == false && $error1 == false) {
	 		// PREPARE UPDATE STATEMENT
			// `users`
			$update = "UPDATE users SET password = ? WHERE id = ?";

			if ($stmt = mysqli_prepare($db, $update)) {

				// SET PARAMETERS
				$param_old_pass = $old_pass; // user's old password
				$param_new_pass = password_hash($new_pass, PASSWORD_DEFAULT); // user's new password hashed

				// no changes made
				if ($param_old_pass == $new_pass) {
	            	$msg = '
	            	<div class="alert alert-info alert-dismissible fade show p-1 mb-1">
						<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
							No changes made
					</div>'; // no changes made
	            } else {
	            	// BIND VARIABLES TO THE PREPARED STATEMENT AS PARAMETERS
		            // `users`
					$update = "UPDATE users SET password = ? WHERE id = ?";
					$stmt = mysqli_prepare($db, $update);
		            mysqli_stmt_bind_param($stmt, "si", $param_new_pass, $id);

		            // ATTEMPT TO EXECUTE THE PREPARED STATEMENT
		            if (mysqli_stmt_execute($stmt)) {
		            	$msg = '
	            		<div class="alert alert-success alert-dismissible fade show p-1 mb-1">
							<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
							Password changed successfully!
						</div>'; // password changed
			        } else {
			            $msg = '
			            <div class="alert alert-danger alert-dismissible fade show p-1 mb-1">
							<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
							<strong>Ops!</strong> A problem ocurred.
						</div>'; // failed
			        }
			    }		
	    	}

	    	$output = array(
				'msg' => $msg
			);

			// encode output in json
			echo json_encode($output);

			// close statement
	    	mysqli_stmt_close($stmt);
		}
 		// close db connection
    	mysqli_close($db);
	}
?>