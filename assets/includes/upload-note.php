<?php  
	// start session
	session_start();

	// include database connection
	include "db_connect.php";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$id = $_SESSION['id']; // user's id

		// note validation
		if (empty(trim($_POST["new_note"]))) {
			header("location: ../../home?note=empty");
			exit();
			$error = true; // note is empty
		} elseif (strlen($_POST["new_note"]) > 1000) {
			header("location: ../../home?note=gmax");
			exit();
			$error = true; // note is too long
		}  else {
			$note = $_POST['new_note'];
			$error = false;
		}

		// if error is false
		if ($error == false) {

			// PREPARE INSERT STATEMENT
			// `notes`
			$insert = "INSERT INTO notes(note_id, by_user_id, note) VALUES(?, ?, ?)";

			if ($stmt = mysqli_prepare($db, $insert)) {

				// SET PARAMETERS
				$param_note = $note; // user's note
				$note_id = rand(100000, 999999);

				// check if note id already exist
				$check_note_id = "SELECT * FROM notes WHERE note_id = ?";
                if ($stmt = mysqli_prepare($db, $check_note_id)) {
                	mysqli_stmt_bind_param($stmt, "i", $note_id);
					mysqli_stmt_execute($stmt);
					while (mysqli_stmt_fetch($stmt)) {
						// fetch results
					}

					// if note id already exist
					if (mysqli_stmt_num_rows($stmt) == 1) {
						$note_id = $note_id.rand(100000, 999999); // add random 6 more digits to note id
					} else {
						$note_id = $note_id; // note id
					}
                }

                // `notes`
				$insert = "INSERT INTO notes(note_id, by_user_id, note) VALUES(?, ?, ?)";
				$stmt = mysqli_prepare($db, $insert);
	            mysqli_stmt_bind_param($stmt, "iis", $note_id, $id, $param_note);
	            mysqli_stmt_execute($stmt);

				// note was created successful
				header("location: ../../home?note=success");
				exit();
						
			} else {

				// error occurred
				header("location: ../../home?note=failed");
				exit();

			} 
            // close statement
            mysqli_stmt_close($stmt);
		}
		// close db connection
        mysqli_close($db);
    }
?>