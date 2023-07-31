<?php  
	// page title
	$title = "Settings - Delete account";
	
	// header
	include "../assets/includes/header.php";

	// deleted account msg
	if (isset($_GET['status'])) {
		if ($_GET['status'] == "failed") {
			$d_msg = '
			<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				<strong>Ops!</strong> A problem occurred.
			</div>';
		} else {
			$d_msg = "";
		}
	} else  {
		$d_msg = "";
	}
?>
	<div class="container" style="padding-top: 20px;">
		<div class="row">
			<div class="col-md-2 col-lg-3 col-xl-3"></div>
			<div class="col-md-8 col-lg-6 col-xl-6">
				<div class="d-grid gap-2">
					<div class="d-flex justify-content-start">
						<div class="navigation-link">
							<h5>Settings > <b>Delete account</b></h5>
						</div>
					</div>
					<div>
						<p>
							By deleting your account, you will lose all your notes and your account itself.  
						</p>
						<?php echo $d_msg; ?>
						<form method="POST" action="assets/includes/delete-account.php" name="new-note-form" enctype="multipart/form-data" accept-charset="utf-8">
							<div class="d-grid">
								<button type="submit" class="btn btn-danger btn-block">Delete</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-2 col-lg-3 col-xl-3"></div>
		</div>
	</div>
<?php
	// footer
	include "../assets/includes/footer.php";
?>