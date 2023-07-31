<?php
	// note
	$query = "SELECT favourite FROM notes WHERE note_id = ? AND by_user_id = ?";
	if ($stmt = mysqli_prepare($db, $query)) {
		mysqli_stmt_bind_param($stmt, "ii", $note_id, $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $favourite);
		while (mysqli_stmt_fetch($stmt)) {
		  	// fetch results
		}

		if ($favourite == "no") {

			// heart buton
			$notes_heart_button = '
			<div class="heart" id="note_id_'.$note_id.'">
				<button type="button" action="javascript: void(0)" class="btn p-0" title="Favourite"><span class="icon icon-heart text-muted"></span></button>
			</div>';

			$note_heart_button = '
			<button type="button" action="javascript: void(0)" class="btn p-0" title="Favourite"><span class="icon icon-heart text-muted"></span></button>';
		} else {

			// heart button
			$notes_heart_button = '
			<div class="heart" id="note_id_'.$note_id.'">
				<button type="button" action="javascript: void(0)" class="btn p-0" title="Favourite"><span class="icon icon-heart text-danger"></span></button>
			</div>';

			$note_heart_button = '
			<button type="button" action="javascript: void(0)" class="btn p-0" title="Favourite"><span class="icon icon-heart text-danger"></span></button>';
		}
	}
?>