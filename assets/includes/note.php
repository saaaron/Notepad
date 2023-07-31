<?php 
	// format time function
	include "../assets/includes/format-time-function.php";

	// select posts 
	$query = "SELECT * FROM notes WHERE note_id = ? AND by_user_id = ? ORDER BY created_on DESC";
	$stmt = mysqli_prepare($db, $query);
	mysqli_stmt_bind_param($stmt, "ii", $note_id, $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		// fetch results 
		$note = $row["note"];
		$favourite = $row["favourite"];
		$created_on = date("M d, Y h:i A", strtotime($row["created_on"]));
	}

	// check if any note exist
	$query = "SELECT * FROM notes WHERE note_id = ? AND by_user_id = ?";
	if ($stmt = mysqli_prepare($db, $query)) {
		mysqli_stmt_bind_param($stmt, "ii", $note_id, $id);
		mysqli_stmt_execute($stmt);
		while (mysqli_stmt_fetch($stmt)) {
			// fetch results
		}

		if (mysqli_stmt_num_rows($stmt) == 0) {
			header("location: home");
		}
	}
?>