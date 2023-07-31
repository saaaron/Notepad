// $('.upload').html("<button class='btn btn-secondary btn-block' disabled>Done</button>");
var a = 0;
$('#image').bind('change', function() {
	if ($('.upload').html("<button class='upload btn btn-secondary btn-block'>Done</button>")) {
		// $('.upload').html("<button class='btn btn-secondary btn-block' disabled>Done</button>");
	}
	var ext = $('#image').val().split('.').pop().toLowerCase();
	// accepted format (png, jpg, jpeg, PNG, JPG, JPEG)
	if ($.inArray(ext, ['png','jpg','jpeg','PNG','JPG','JPEG']) == -1) {
		$('#error1').slideDown("fast");
		$('#error2').slideUp("fast");
		a = 0;
	} else {
		var picsize = (this.files[0].size);
		// max. upload size (2MB)
		if (picsize > 2097152) {
			$('#error2').slideDown("fast");
			a = 0;
		} else {
			a = 1;
			$('#error2').slideUp("fast");
		}
		$('#error1').slideUp("fast");
		if (a == 1) {
			$('.upload').html("<button class='upload btn btn-secondary btn-block'>Done</button>");
		}
	}
});