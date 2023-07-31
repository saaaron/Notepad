<?php  
	// page title
	$title = "Home";
	
	// header
	include "../assets/includes/header.php";

	if (isset($_GET['note'])) { // if URL = http://localhost/notepad/home?note=
		if ($_GET['note'] == null) {
			$note_msg = ''; // if URL = http://localhost/notepad/home?note=
		} elseif ($_GET['note'] == 'success') {
			$note_msg = '
			<div class="alert alert-success alert-dismissible fade show p-1 mb-1">
				<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
				Note created successfully.
			</div>'; // if URL = http://localhost/notepad/home?note=success
		} elseif ($_GET['note'] == 'failed') {
			$note_msg = '
			<div class="alert alert-danger alert-dismissible fade show p-1 mb-1">
				<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
				<strong>Ops!</strong> A problem occurred.
			</div>'; // if URL = http://localhost/notepad/home?note=failed
		} elseif ($_GET['note'] == 'empty') {
			$note_msg = '
			<div class="alert alert-danger alert-dismissible fade show p-1 mb-1">
				<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
				<strong>Ops!</strong> Note is empty.
			</div>'; // if URL = http://localhost/notepad/home?note=empty
		} elseif ($_GET['note'] == 'gmax') {
			$note_msg = '
			<div class="alert alert-danger alert-dismissible fade show p-1 mb-1">
				<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
				<strong>Ops!</strong> Note is too long.
			</div>'; // if URL = http://localhost/notepad/home?note=gmax
		} elseif ($_GET['note'] == 'deleted') {
			$note_msg = '
			<div class="alert alert-success alert-dismissible fade show p-1 mb-1">
				<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
				Note has been deleted successfully.
			</div>'; // if URL = http://localhost/notepad/home?note=deleted
		} elseif ($_GET['note'] == 'delete_failed') {
			$note_msg = '
			<div class="alert alert-danger alert-dismissible fade show p-1 mb-1">
				<button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
				<strong>Ops!</strong> A problem occurred.
			</div>'; // if URL = http://localhost/notepad/home?note=delete_failed
		}
	} else {
		$note_msg = ''; // if URL = http://localhost/signup_validation/index.php
	}

	// notes
	include "../assets/includes/notes.php";
						
?>
	<div class="container" style="padding-top: 20px;">
		<div class="row">
			<div class="col-md-2 col-lg-3 col-xl-3"></div>
			<div class="col-md-8 col-lg-6 col-xl-6">
				<div class="d-grid gap-2">
					<div class="d-flex justify-content-between">
						<div>
							<h5>All notes (<?php echo $total_num_of_notes; ?>)</h5>
						</div>
						<div>
							<button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#add-note"><span class="icon icon-plus"></span> New note</button>

							<!-- modal -->
							<div class="modal fade" id="add-note">
								<div class="modal-dialog">
									<div class="modal-content">
										<!-- modal header -->
										<div class="modal-header p-2">
											<h6 class="modal-title">New note (<span class="text-muted">1,000 max</span>)</h6>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<!-- modal body -->
										<div class="modal-body">
											<form method="POST" action="assets/includes/upload-note.php" name="new-note-form" enctype="multipart/form-data" accept-charset="utf-8">
												<div class="d-grid gap-2">
													<div>
														<textarea class="summernote" name="new_note"></textarea>
													</div>
													<div class="d-grid">
														<button type="submit" class="btn btn-secondary btn-block">Add</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php 
						echo $note_msg; 
					?>
					<div class="d-grid gap-2">
					<?php 
						echo $notes; 
					?>
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