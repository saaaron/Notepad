<?php  
	// page title
	$title = "Settings - Change password";
	
	// header
	include "../assets/includes/header.php";
?>
	<div class="container" style="padding-top: 20px;">
		<div class="row">
			<div class="col-md-2 col-lg-3 col-xl-3"></div>
			<div class="col-md-8 col-lg-6 col-xl-6">
				<div class="d-grid gap-2">
					<div class="d-flex justify-content-start">
						<div class="navigation-link">
							<h5>Settings > <b>Change password</b></h5>
						</div>
					</div>
					<div>
						<p>
							Change password by inputting your old password and new password.  
						</p>
						<div id="msg"></div>
						<div class="d-grid gap-2">
							<div>
								<input type="password" id="old-pass" class="form-control old-pass" placeholder="Old password">
								<div id="old-pass-val" class="text-danger"></div>
							</div>
							<div>
								<input type="password" id="new-pass" class="form-control new-pass" placeholder="New password">
								<div id="new-pass-val" class="text-danger"></div>
							</div>
							<div class="d-grid">
								<button type="button" id="done" class="btn btn-secondary btn-block">Done</button>
							</div>
						</div>
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