<?php  
	// start session
	session_start();

	// include database connection
	include "db_connect.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$id = $_SESSION['id']; // user's id

		$note_id = $_GET['note_id']; // note's id

		// note validation
		if (empty(trim($_POST["edited_note"]))) {
			header("location: ../../".$note_id."?edited_note=empty");
			exit();
			$error = true; // note is empty
		} elseif (strlen($_POST["edited_note"]) > 1000) {
			header("location: ../../".$note_id."?edited_note=max1000");
			exit();
			$error = true; // note is too long
		}  else {
			$edited_note = $_POST['edited_note'];
			$error = false;
		}

		// if error is false
		if ($error == false) {

			// PREPARE INSERT STATEMENT
			$update = "UPDATE notes SET note = ? WHERE note_id = ? AND by_user_id = ?";

			if ($stmt = mysqli_prepare($db, $update)) {

				// SET PARAMETERS
				$param_edited_note = $edited_note; // user's edited note

                // `notes`
				$update = "UPDATE notes SET note = ? WHERE note_id = ? AND by_user_id = ?";
				$stmt = mysqli_prepare($db, $update);
	            mysqli_stmt_bind_param($stmt, "sii", $param_edited_note, $note_id, $id);
	            mysqli_stmt_execute($stmt);

				// note was created successful
				header("location: ../../".$note_id."?edited_note=success");
				exit();
			} else {

				// error occurred
				header("location: ../../".$note_id."?edited_note=failed");
				exit();

			} 
            // close statement
            mysqli_stmt_close($stmt);
		}
		// close db connection
        mysqli_close($db);
    }
?>