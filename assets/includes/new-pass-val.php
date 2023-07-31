<?php
    if(isset($_POST['new_pass'])) {
 		$response = array();

 		$new_pass = $_POST['new_pass']; // user's new password

 		if (empty(trim($new_pass))) {
        	$response['status'] = false;
        	$response['msg'] = 'New password is empty';
        } elseif (strlen($new_pass) < 6) {
			$response['status'] = false;
 			$response['msg'] = 'New password must be greater than 6 characters';
		} elseif (strlen($new_pass) > 150) {
			$response['status'] = false;
 			$response['msg'] = 'New password must be less than 50 characters';
		} else {
 			$response['status'] = true;
 			$response['msg'] = '';
 		}
 		echo json_encode($response);
    }
?>