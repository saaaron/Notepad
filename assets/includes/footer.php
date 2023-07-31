<?php  
	echo '
	<script src="assets/js/jquery-3.7.0.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>';
	
	if ($title == "Home") {
		echo '
	<script src="assets/js/summernote-bs5.min.js"></script>
	<script src="assets/js/jquery.livequery.js"></script>
	<script type="text/javascript">
      	$(document).ready(function() {
        	$(".summernote").summernote({
         	 	height: 300,
          		tabsize: 2,
          		toolbar: [
          			["font", ["bold","underline","clear"]],
          			["para", ["ul","ol"]],
          		]
        	});
      	});

      	$(".heart > button").livequery("click",function(e){
			var parent  = $(this).parent();

			// get post id from id="p_id_[id]" 
			var getID   =  parent.attr("id").replace("note_id_","");
			
			// like post
			$.post("assets/includes/heart.php?note_id="+getID, {
				
			}, function(response){
								
				$("#note_id_"+getID).html($(response).fadeIn("fast"));
			});
		});

		$(".note_delete_button").click(function(){
	        var el = this;
	        var id = this.id;
	        var splitid = id.split("_");

	        // id
	        var deleteid = splitid[1];
	        
	        $.ajax({
	            url: "assets/includes/deletejs.php",
	            type: "POST",
	            data: { note_id:deleteid },
	            success: function(response) {
	                if (response == 1) {
	                    $(el).closest(".note_to_delete").fadeOut(500, function(){
	                        $(this).remove();
	                    });
	                } else {
	                    alert("Ops! Something went wrong, please try again");
	                }
	            }
	        });
	    });
    </script>';
    } elseif ($title == "Note") {
    	echo '
    <script src="assets/js/summernote-bs5.min.js"></script>
    <script src="assets/js/jquery.livequery.js"></script>
	<script type="text/javascript">
		// summernote WYSIWYG editor
      	$(document).ready(function() {
        	$(".summernote").summernote({
         	 	height: 300,
          		tabsize: 2,
          		toolbar: [
          			["font", ["bold","underline","clear"]],
          			["para", ["ul","ol"]],
          		]
        	});
      	});

      	// mark as favourite
      	$(".heart > button").livequery("click",function(e){
			var parent  = $(this).parent();

			// get post id from id="p_id_[id]" 
			var getID   =  parent.attr("id").replace("note_id_","");
			
			// like post
			$.post("assets/includes/heart.php?note_id="+getID, {
				
			}, function(response){
								
				$("#note_id_"+getID).html($(response).fadeIn("fast"));
			});
		});
    </script>';
    } elseif ($title == "Favourite") {
    	echo '
	<script src="assets/js/summernote-bs5.min.js"></script>
	<script src="assets/js/jquery.livequery.js"></script>
	<script type="text/javascript">
		// summernote WYSIWYG editor
      	$(document).ready(function() {
        	$(".summernote").summernote({
         	 	height: 300,
          		tabsize: 2,
          		toolbar: [
          			["font", ["bold","underline","clear"]],
          			["para", ["ul","ol"]],
          		]
        	});
      	});

      	// mark as favourite
      	$(".heart > button").livequery("click",function(e){
			var parent  = $(this).parent();

			// get post id from id="p_id_[id]" 
			var getID   =  parent.attr("id").replace("note_id_","");
			
			// like post
			$.post("assets/includes/heart.php?note_id="+getID, {
				
			}, function(response){
								
				$("#note_id_"+getID).html($(response).fadeIn("fast"));
			});
		});

		// delete note
		$(".note_delete_button").click(function(){
	        var el = this;
	        var id = this.id;
	        var splitid = id.split("_");

	        // id
	        var deleteid = splitid[1];
	        
	        $.ajax({
	            url: "assets/includes/deletejs.php",
	            type: "POST",
	            data: { note_id:deleteid },
	            success: function(response) {
	                if (response == 1) {
	                    $(el).closest(".note_to_delete").fadeOut(500, function(){
	                        $(this).remove();
	                    });
	                } else {
	                    alert("Ops! Something went wrong, please try again");
	                }
	            }
	        });
	    });
    </script>';
    } elseif ($title == "My profile") {
    	echo '
    	<script src="assets/js/croppie.js"></script>
    	<script src="assets/js/validate-profile-photo.js"></script>
		<script type="text/javascript">
			// croppie.js change profile phto
			var $uploadCrop;

     		$uploadCrop = $("#preview").croppie({
		        viewport: {
		            width: 200,
		            height: 200,
		            type: "circle"
		        },
		        boundary: {
		            width: 200,
		            height: 200
		        }
		    });

		    $("#image").on("change", function() {
		        var reader = new FileReader();
		        reader.onload = function (event) {
		            $uploadCrop.croppie("bind", {
		                url: event.target.result
		            }).then(function() {
		                console.log("jQuery bind complete");
		            });
		        }
		        reader.readAsDataURL(this.files[0]);
		    });

		    $(".upload").on("click", function (ev) {
		        $uploadCrop.croppie("result", {
		            type: "canvas",
		            size: "viewport"
		        }).then(function (response) {
		             $.ajax({
		                url:"assets/includes/change-profile-photo.php",
		                type: "POST",
		                data: {"image": response},
		                success:function(d) {
		                    $("#change-profile-photo").modal("hide");
		                    $(".profile-photo").html(d);
		                    $(".cr-image").val("");
		                }
		            });
		        });
		    });

			// validate full name
			$(".fullname").keyup(function() {
		 		var fullname_val = $(this).val();
		 		$.post("assets/includes/fullname-val.php", {fullname: fullname_val} , function(fndata) {
		 			$("#fullname_val").html(fndata.msg);
		 		},"json");
		 	});

		 	// update profile
		    $("#done").click(function() {
		      	// input area
		      	var input = $("#full-name-input").val();

		      	$.ajax({
		        	url: "assets/includes/update-profile.php",
		        	type: "POST",
		        	data:{
		          		full_name:input
		        	},
		        	dataType: "json",
		       	 	success:function(d) {
		   				$("#profile-msg").html(d.msg);
		          	}
		        });
	      	});
    	</script>';   	
    } elseif ($title == "Search") {
    	echo '
    	<script type="text/javascript">
	    	load_data();
		
			function load_data(query) {
				$.ajax({
					url: "assets/includes/search.php",
					cache: false,
					method: "POST",
					data: {
						query:query
					},
					success:function(data) {
						$("#result").html(data);
					}
				});
			} 

			$("#search").keyup(function() {
				var search = $(this).val();

				if(search != "") {
					load_data(search);
				} else {
					load_data();
				}
			});
		</script>';
    } elseif ($title == "Settings - Change password") {
    	echo '
    	<script src="assets/js/HideShowPassword.min.js"></script>
    	<script src="assets/js/HideShowPass.js"></script>
    	<script type="text/javascript">
    		// validate old password
			$(".old-pass").keyup(function() {
		 		var old_pass_val = $(this).val();
		 		$.post("assets/includes/old-pass-val.php", {old_pass: old_pass_val} , function(opdata) {
		 			$("#old-pass-val").html(opdata.msg);
		 		},"json");
		 	});

		 	// validate new password
			$(".new-pass").keyup(function() {
		 		var new_pass_val = $(this).val();
		 		$.post("assets/includes/new-pass-val.php", {new_pass: new_pass_val} , function(npdata) {
		 			$("#new-pass-val").html(npdata.msg);
		 		},"json");
		 	});

    		$("#done").click(function() {
		      	// input area
		      	var old_pass = $("#old-pass").val();
		      	var new_pass = $("#new-pass").val();

		      	$.ajax({
		        	url: "assets/includes/change-password.php",
		        	type: "POST",
		        	data:{
		          		old_password:old_pass,
		          		new_password:new_pass
		        	},
		        	dataType: "json",
		       	 	success:function(d) {
		   				$("#msg").html(d.msg);
		          	}
		        });
	      	});
	    </script>';
    }
    echo '
</body>
</html>';
?>