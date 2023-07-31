<?php 
	// format time function
	include "../assets/includes/format-time-function.php";

	// varaible
	$notes = "";

	// select posts 
	$query = "SELECT * FROM notes WHERE favourite = 'yes' AND by_user_id = ? ORDER BY created_on DESC";
	$stmt = mysqli_prepare($db, $query);
	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		// fetch results 
		$note_id = $row["note_id"];
		$note = strip_tags($row["note"]);
		$favourite = $row["favourite"];
		$created_on = $row["created_on"];

		if (strlen($note) > 43) {
			$note = mb_substr($note, 0, 43).'...';
		} else {
			$note = $note;
		}

		// heart button
		include "../assets/includes/heart-button.php";

		$notes .= '
			<div class="card p-2 border-0 note_to_delete">
				<div class=" d-flex justify-content-between">
					<div class="note-link"><a href="'.$note_id.'">'.$note.'</a></div>
					'.$notes_heart_button.'
				</div>
				<div class="d-flex justify-content-start">
					<div class="text-muted me-2">'.format_time($created_on).'</div>
					<div>
						<button id="noteID_'.$note_id.'" class="btn p-0 note_delete_button" type="button" class="btn p-0" title="Delete"><span class="icon icon-trash text-muted"></span></button>
					</div>
				</div>
			</div>';
	}

	// check if any note exist
	$query = "SELECT * FROM notes WHERE favourite = 'yes' AND by_user_id = ?";
	if ($stmt = mysqli_prepare($db, $query)) {
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		while (mysqli_stmt_fetch($stmt)) {
			// fetch results
		}

		$total_num_of_notes = number_format(mysqli_stmt_num_rows($stmt));

		if (mysqli_stmt_num_rows($stmt) == 0) {
			$notes = '
				<div class="card p-5 border-0 text-center">
					<h1><span class="icon icon-doc-text-inv text-muted"></span></h1>
					<p class="text-muted">No favourite</p>
				</div>';
		}
	}
?>