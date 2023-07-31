<?php
	// Note stats
	// Get total of user's notes
	$query = "SELECT * FROM notes WHERE by_user_id = ?";
	if ($stmt = mysqli_prepare($db, $query)) {
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		while (mysqli_stmt_fetch($stmt)) {
			// fetch results
		}

		$total_num_of_notes = number_format(mysqli_stmt_num_rows($stmt));
	}

	// Get total of user's favourite
	$queryf = "SELECT * FROM notes WHERE favourite = 'yes' AND by_user_id = ?";
	if ($stmt = mysqli_prepare($db, $queryf)) {
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		while (mysqli_stmt_fetch($stmt)) {
			// fetch results
		}

		$total_num_of_favourites = number_format(mysqli_stmt_num_rows($stmt));
	}
?>