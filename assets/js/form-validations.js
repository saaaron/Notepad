$(document).ready(function() {
 	// full name validation
 	$('#fullname').keyup(function() {
 		var fullname_val = $(this).val();
 		$.post("assets/includes/fullname-val.php", {fullname: fullname_val} , function(fndata) {
 			$('#fullname_val').html(fndata.msg);
 		},'json');
 	});

 	// email validation
 	$('#email').keyup(function() {
 		var email_val = $(this).val();
 		$.post("assets/includes/email-val.php", {email: email_val} , function(eadata) {
 			$('#email_val').html(eadata.msg);
 		},'json');
 	});

 	// password validation
 	$('#password').keyup(function() {
 		var password_val = $(this).val();
 		$.post("assets/includes/password-val.php", {password: password_val} , function(pwdata) {
 			$('#password_val').html(pwdata.msg);
 		},'json');
 	});
});