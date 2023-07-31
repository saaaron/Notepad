<?php  
	// header
	header('Content-Type: application/json');

	// start session
	session_start();

	// connect to database
	include "db_connect.php";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$id = $_SESSION['id']; // user's id

		$full_name = $_POST['full_name']; // user's full name

		// note validation
		if (empty(trim($full_name))) {
			$error = true; // Full name is empty
		} elseif (strlen(preg_replace('/[^a-zA-Z]/m', '', $full_name)) < 3) {
			$error = true; // Full name must be greater than 3
		} elseif (strlen($full_name) > 20) {
			$error = true; // Full name must be less than 20
		} elseif (!preg_match("/^[a-zA-Z\s]{3,20}+$/ ", $full_name)) {
			$error = true;  // Full name must be in letters with either a space
		} else {
			$full_name = ucwords($full_name);
			$error = false; // no error
		}

		// if error is false
		if ($error == false) {
			// PREPARE INSERT STATEMENT
			// `notes`
			$update = "UPDATE users SET full_name = ? WHERE id = ?";

			if ($stmt = mysqli_prepare($db, $update)) {

				// SET PARAMETERS
				$param_full_name = $full_name; // user's full name

				// check if updated full name is the same with stored full name
				$check_fname = "SELECT full_name FROM users WHERE id = ?";
                if ($stmt = mysqli_prepare($db, $check_fname)) {
                	mysqli_stmt_bind_param($stmt, "i", $id);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt, $s_full_name);
					while (mysqli_stmt_fetch($stmt)) {
						// fetch results
					}

					// full name not changed
					if ($s_full_name == $param_full_name) {
						$msg = '
						<div class="alert alert-info alert-dismissible fade show p-1 mb-1">
							<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
							No changes made
						</div>';
					} else {
						// users
						$update = "UPDATE users SET full_name = ? WHERE id = ?";
						$stmt = mysqli_prepare($db, $update);
			            mysqli_stmt_bind_param($stmt, "si", $full_name, $id);
			            mysqli_stmt_execute($stmt);

			            // upadte done
						$msg = '
						<div class="alert alert-success alert-dismissible fade show p-1 mb-1">
							<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
							Profile updated successfully!
						</div>';
					}
                }	
			} else {
				// update failed
				$msg = '
				<div class="alert alert-danger alert-dismissible fade show p-1 mb-1">
					<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
					<strong>Ops!</strong> A problem occurred.
				</div>';		
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