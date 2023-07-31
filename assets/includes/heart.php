<?php
	// start session
    session_start();

	// connect to database
	include 'db_connect.php';

	if (isset($_GET["note_id"])) {

		$id = $_SESSION['id']; // user's id

	    $note_id = $_GET["note_id"]; // note's id
 
	    // PREPARE INSERT STATEMENT
	    // notes
	    $query = "SELECT favourite FROM notes WHERE note_id = ? AND by_user_id = ?";

	    // update notes
	    $query = "UPDATE notes SET favourite = ? WHERE note_id = ? AND by_user_id = ?";

	    if ($stmt = mysqli_prepare($db, $query)) {

	    	// notes
	    	$query = "SELECT favourite FROM notes WHERE note_id = ? AND by_user_id = ?";
			if ($stmt = mysqli_prepare($db, $query)) {
				mysqli_stmt_bind_param($stmt, "ii", $note_id, $id);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $favourite);
				while (mysqli_stmt_fetch($stmt)) {
				  	// fetch results
				}

				$yes = "yes";
				$no = "no";

				// if note exist
				if ($favourite == "no") {
				  	// mark as favourite
				  	$query = "UPDATE notes SET favourite = ? WHERE note_id = ? AND by_user_id = ?";
					$stmt = mysqli_prepare($db, $query);
					mysqli_stmt_bind_param($stmt, "sii", $yes, $note_id, $id);
					mysqli_stmt_execute($stmt);

					// heart button
					echo '
						<button type="button" action="javascript: void(0)" class="btn p-0" title="Favourite"><span class="icon icon-heart text-danger"></span></button>';
				} else {
					// unmark as favourite
					$query = "UPDATE notes SET favourite = ? WHERE note_id = ? AND by_user_id = ?";
					$stmt = mysqli_prepare($db, $query);
					mysqli_stmt_bind_param($stmt, "sii", $no, $note_id, $id);
					mysqli_stmt_execute($stmt);

					echo '
						<button type="button" action="javascript: void(0)" class="btn p-0" title="Favourite"><span class="icon icon-heart text-muted"></span></button>';
				}
			}
			// close statement
			mysqli_stmt_close($stmt);
	    }
		// close db connection
	    mysqli_close($db);
	}
?>