<?php  
	// page title
	$title = "My profile";
	
	// header
	include "../assets/includes/header.php";
?>
	<div class="container" style="padding-top: 20px;">
		<div class="row">
			<div class="col-md-2 col-lg-3 col-xl-3"></div>
			<div class="col-md-8 col-lg-6 col-xl-6">
				<div class="d-flex justify-content-start">
					<div class="navigation-link">
						<h5>My Profile</h5>
					</div>
				</div>
				<div class="mb-3">
					<div class="d-flex justify-content-center mb-1">
						<div class="profile-photo">
							<?php echo $set_profile_photo; ?>
						</div>
					</div>
					<div class="text-center">
						<a href="#" data-bs-toggle="modal" data-bs-target="#change-profile-photo">Change profile photo</a>

						<!-- modal -->
						<div class="modal fade" id="change-profile-photo">
							<div class="modal-dialog">
								<div class="modal-content">
									<!-- modal header -->
									<div class="modal-header p-2">
										<h6 class="modal-title">Change profile photo</h6>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>
									<div id="error1" class="text-danger profile-photo-error">Your profile photo must be in .jpeg, .jpg or .png format</div>
                                    <div id="error2" class="text-danger profile-photo-error">Your profile photo size must be less than 2MB</div>
									<!-- modal body -->
									<div class="modal-body">
										<div id="preview" style="color:transparent"></div>
										<div class="d-grid gap-2">
	                                        <div>
	                                            <input type="file" name="profile_photo" id="image" accept=".jpg, .png">
	                                        </div>
	                                        <div class="upload d-grid"></div>
	                                    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="profile-msg"></div>
				<div class="d-grid gap-2">
					<div>
						<input type="text" id="full-name-input" class="form-control fullname" value="<?php echo $full_name; ?>" autocomplete="off">
						<div class="text-danger" id="fullname_val"></div>
					</div>
					<div>
						<input type="email" class="form-control" placeholder="<?php echo $email; ?>" autocomplete="off" readonly>
					</div>
					<div class="d-grid">
						<button type="button" id="done" class="btn btn-secondary btn-block">Done</button>
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