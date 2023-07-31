<?php 
	// start session
    session_start();

	// connect to database
	include 'db_connect.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$id = $_SESSION["id"]; // user's id

		$note_id = $_POST['note_id']; // note's id

		// notes
		$notes = "SELECT * FROM notes WHERE note_id = ? AND by_user_id = ?";
	    if($stmt = mysqli_prepare($db, $notes)) {
			mysqli_stmt_bind_param($stmt, "ii", $note_id, $id);
			mysqli_stmt_execute($stmt);
			while (mysqli_stmt_fetch($stmt)) {
				// fetch results
			}

			// if note exist
			if (mysqli_stmt_num_rows($stmt) > 0) {
				// delete note
				$delete = "DELETE FROM notes WHERE note_id = ? AND by_user_id = ?";
			    $stmt = mysqli_prepare($db, $delete);
				mysqli_stmt_bind_param($stmt, "ii", $note_id, $id);
				mysqli_stmt_execute($stmt);

				echo 1; // Deleted
			} else {
				echo 0; // Ops! A problem occurred
			}
		}
		// close statement
		mysqli_stmt_close($stmt);
	}
	// close db connection
  	mysqli_close($db);
?>