<?php  
	// page title
	$title = "Favourite";
	
	// header
	include "../assets/includes/header.php";

	// notes
	include "../assets/includes/favourites.php";
?>
	<div class="container" style="padding-top: 20px;">
		<div class="row">
			<div class="col-md-2 col-lg-3 col-xl-3"></div>
			<div class="col-md-8 col-lg-6 col-xl-6">
				<div class="d-grid gap-2">
					<div class="d-flex justify-content-start">
						<div class="navigation-link">
							<h5>Favourite (<?php echo $total_num_of_notes; ?>)</h5>
						</div>
					</div>
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