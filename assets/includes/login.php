<?php  
	// connect to database
	include "assets/includes/db_connect.php";

	// variables
	$login_msg = $email_error = $password_error = "";
		
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		// check if email is empty
		if (empty(trim($_POST['email']))) {
			$email_error = true; // email is empty
		} else {
			$email_error = false;
			$email = $_POST["email"]; // user's email address
		}

		// check if password is empty
		if (empty(trim($_POST['password']))) {
			$password_error = true; // password is empty
		} else {
			$password_error = false;
			$password = $_POST["password"]; // user's password
		}

		// proceed if no error
		if ($email_error == false && $password_error == false) {
			// user's query
			$query = "SELECT id, email, password FROM users WHERE email = ?"; 

			if ($stmt = mysqli_prepare($db, $query)) {

				// bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                // set parameters
                $param_email = $_POST["email"];

                // attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {

                	// store result
                    mysqli_stmt_store_result($stmt);

                    // check if email exists, if yes then verify password
                    if (mysqli_stmt_num_rows($stmt) == 1) {

                    	// bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);

                        if (mysqli_stmt_fetch($stmt)) {

                        	if (password_verify($_POST["password"], $hashed_password)) {

                        		// set cookie for 1 month
                                setcookie ("$email", $_SESSION['id'] = $id, time()+ (60 * 60 * 24 * 30), "/");
                                
                                $_SESSION['id'] = $id; // user's ID
                               
                    			// direct user to dashboard homepage
                                header("location: home");
                                exit();

                            } else {
                            	// login failed message
								$login_msg = '
								<div class="alert alert-danger alert-dismissible fade show">
									<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
									<strong>Ops!</strong> Incorrect password.
								</div>';
                            }
                        }
					} else {
                        // login failed message
						$login_msg = '
						<div class="alert alert-danger alert-dismissible fade show">
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
							<strong>Ops!</strong> Incorrect email address.
						</div>';
					}
				} else {
                    // login failed message
					$login_msg = '
					<div class="alert alert-danger alert-dismissible fade show">
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						<strong>Ops!</strong> A problem occurred, try again.
					</div>';
				}
			}
			// close statement
            mysqli_stmt_close($stmt);
        }
        // close db connection
        mysqli_close($db);
    }
?>