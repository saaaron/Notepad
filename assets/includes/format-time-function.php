<?php  
	function format_time($timestamp) {  
      	date_default_timezone_set("Africa/Lagos"); 
    	$time_ago = strtotime($timestamp);  
      	$current_time = time();  
      	$time_difference = $current_time - $time_ago;  
      	$seconds = $time_difference;  
      	$minutes = round($seconds / 60 ); // value 60 is seconds  
      	$hours = round($seconds / 3600);  // value 3600 is 60 minutes * 60 sec  
      	$days = round($seconds / 86400);  // 86400 = 24 * 60 * 60;  
     	  $weeks = round($seconds / 604800); // 7*24*60*60;  
      	$months = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
      	$years = round($seconds / 31553280); // (365+365+365+365+366)/5 * 24 * 60 * 60  

      	// if seconds is less than equal to 60
      	if ($seconds <= 60) {  
     		return "Just now";  
   		} elseif ($minutes <= 60) { // if seconds is less than equal to 60  
     		if($minutes == 1) {  
       			return "1 min ago";  
     		} else {  
       			return "$minutes mins ago";  
     		}  
   		} elseif ($hours <= 24) { // if hour  
     		if($hours == 1) {  
       			return "1 hour ago";  
     		} else {  
       			return "$hours hours ago";  
     		}  
   		} elseif ($days <= 7) {  // if week 
     		if($days==1) {  
       			return "yesterday";  
     		} else {  
       			return "$days days ago";  
     		}  
   		} elseif($weeks <= 4.3) { // 4.3 == 52/12  
        	if($weeks == 1) {  
       			return "1 week ago";  
     		} else {  
       			return "$weeks weeks ago";  
     		}  
   		} elseif ($months <= 12) { // if months   
     		if($months==1) {  
       			return "1 month ago";  
     		} else {  
       			return "$months months ago";  
     		}  
   		} else {  
     		if($years == 1) { // if year  
       			return "1 year ago";  
     		} else {  
       			return "$years years ago";  
     		}  
   		}  
 	}  
?>