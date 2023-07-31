<?php  
	// include database connection
	include "assets/includes/db_connect.php";

	// variables
	$full_name_error = $full_name_error_msg = $email_error = $email_error_msg = $password_error = $password_error_msg = $signup_msg = ""; 
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// full name validation
		if (empty(trim($_POST["fullname"]))) {
			$full_name_error_msg = "Full name is empty"; // full name error message
			$full_name_error = true;
		} elseif (strlen(preg_replace('/[^a-zA-Z]/m', '', $_POST["fullname"])) < 3) {
			$full_name_error_msg = 'Full name must be greater than 3';
			$full_name_error = true;
		} elseif (strlen($_POST["fullname"]) > 20) {
			$full_name_error_msg = 'Full name must be less than 20';
			$full_name_error = true;
		} elseif (!preg_match("/^[a-zA-Z\s]{3,20}+$/ ", $_POST["fullname"])) {
			$full_name_error_msg = 'Full name must be in letters with either a space';
			$full_name_error = true;
		} else {
			$full_name = ucwords($_POST['fullname']);
			$full_name_error = false;
		}

		// email validation
		if (empty(trim($_POST["email"]))) {
			$email_error_msg = 'Email address is empty'; // email address error message
			$email_error = true;
		} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			$email_error_msg = 'Email address is invalid';
			$email_error = true;
		} else {
			// prepare select statement
			$check_email = "SELECT * FROM users WHERE email = ?";
			if($stmt = mysqli_prepare($db, $check_email)) {

				// bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                // set parameters
                $param_email = $_POST["email"];

                // attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){

                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                      	$email_error_msg = '<b>'.$_POST["email"].'</b> is already in use';
                      	$email_error = true;
                    } else{
                        $email = $_POST["email"];
                        $email_error = false;
                    }
                } else{
                    $email_error_msg = '<b>Oops!</b> Something went wrong. Please try again later';
                    $email_error = true;
                }
			}
		}

		// password validation
		if (empty($_POST['password'])) {
			$password_error_msg = "Password is empty"; // password error message
			$password_error = true;
		} elseif (strlen($_POST['password']) < 6) {
			$password_error_msg = 'Password must be greater than 6 characters';
			$password_error = true;
		} elseif (strlen($_POST['password']) > 50) {
			$password_error_msg = 'Password must be less than 50 characters';
			$password_error = true;
		} else {
			$password = $_POST['password'];
			$password_error = false;
		}

		// check errors are all false before inserting into database
		if ($full_name_error == false && $email_error == false && $password_error == false) {

			// PREPARE INSERT STATEMENT
			// `users`
			$insert = "INSERT INTO users(full_name, email, password) VALUES(?, ?, ?)";

			if ($stmt = mysqli_prepare($db, $insert)) {

				// SET PARAMETERS
				$param_full_name = $full_name; // user's full name
                $param_email = $email; // user's email address
                $param_password = password_hash($password, PASSWORD_DEFAULT); // user's password (hashed)

                // `users`
				$insert = "INSERT INTO users(full_name, email, password) VALUES(?, ?, ?)";
				$stmt = mysqli_prepare($db, $insert);
	            mysqli_stmt_bind_param($stmt, "sss", $param_full_name, $param_email, $param_password);
	            mysqli_stmt_execute($stmt);

				
				// if signup was successful, redirect user to dashboard homepage
				// header("location: home");
				// exit();
				$signup_msg = '
				<div class="alert alert-success alert-dismissible fade show">
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					Signup was successful.
				</div>';	
						
			} else {
				// signup failed message
				$signup_msg = '
				<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					<strong>Ops!</strong> Signup failed, try again.
				</div>';		
			} 
            // close statement
            mysqli_stmt_close($stmt);
		}
		// close db connection
        mysqli_close($db);
    }
?>