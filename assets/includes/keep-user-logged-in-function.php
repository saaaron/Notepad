<?php  
	function loggedin() {
		// if user's ID session or cookie email is not null 
		if (isset($_SESSION["id"]) || isset($_COOKIE["email"])) {
			$loggedin = true;
			return $loggedin;
		}
	}
?>