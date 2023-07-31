<?php  
	// page title
	$title = "Note";
	
	// header
	include "../assets/includes/header.php";

	if (isset($_GET['note_id'])) { // if URL = http://localhost/notepad/4455434
		if ($_GET['note_id'] == null) {
			header("location: home");
		} else {
			$note_id = $_GET['note_id']; // if URL = http://localhost/notepad/4455434
		}
	} else {
		header("location: home");
	}

	// note
	include "../assets/includes/note.php";

	// heart button
	include "../assets/includes/heart-button.php";
?>
	<div class="container" style="padding-top: 20px;">
		<div class="row">
			<div class="col-md-2 col-lg-3 col-xl-3"></div>
			<div class="col-md-8 col-lg-6 col-xl-6">
				<div class="d-grid">
					<div class="d-flex justify-content-between">
						<div class="navigation-link">
							<a href="home">
								<h5><span class="icon icon-reply text-muted"></span> Go back</h5>
							</a>
						</div>
						<div class="heart ms-auto" id="note_id_<?php echo $note_id; ?>">
							<?php echo $note_heart_button; ?>
						</div>
						<div class="ms-2">
							<a href="assets/includes/delete.php?note_id=<?php echo $note_id; ?>"><button type="button" class="btn p-0" title="Delete"><span class="icon icon-trash text-muted"></span></button></a>
						</div>
					</div>
					<div>
						<div class="card p-2 border-0">
							<div class="d-flex justify-content-between">
								<div class="text-muted mb-1">
									<?php echo $created_on; ?>
								</div>
								<div>
									<a href="#" data-bs-toggle="modal" data-bs-target="#add-note">Edit</a>

									<!-- modal -->
									<div class="modal fade" id="add-note">
										<div class="modal-dialog">
											<div class="modal-content">
												<!-- modal header -->
												<div class="modal-header p-2">
													<h6 class="modal-title">Edit note (<span class="text-muted">1,000 max</span>)</h6>
													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
												</div>
												<!-- modal body -->
												<div class="modal-body">
													<form method="POST" action="assets/includes/edit-note.php?note_id=<?php echo $note_id; ?>" name="new-note-form" enctype="multipart/form-data" accept-charset="utf-8">
														<div class="d-grid gap-2">
															<div>
																<textarea class="summernote" name="edited_note"><?php echo $note; ?></textarea>
															</div>
															<div class="d-grid">
																<button type="submit" class="btn btn-secondary btn-block">Done</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
								<?php echo $note; ?>
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