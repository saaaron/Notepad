<?php
	// user's info
	$query = "SELECT profile_photo, full_name, email FROM users WHERE id = ?";
	if ($stmt = mysqli_prepare($db, $query)) {
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $profile_photo, $full_name, $email);
		while (mysqli_stmt_fetch($stmt)) {
			// fetch results
		}

		// set profile photo
		if ($profile_photo == null) { // if NULL set default profile photo
			$set_profile_photo = '<img src="assets/img/default.png" alt="profile photo">';			
		} else { // else set changed profile photo
			$set_profile_photo = '<img src="assets/img/users/'.$profile_photo.'" alt="profile photo">';
		}
	}
?>