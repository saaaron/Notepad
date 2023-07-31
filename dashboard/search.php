<?php  
	// page title
	$title = "Search";
	
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
							<h5>Search</h5>
						</div>
					</div>
					<div>
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" accept-charset="utf-8">
							<input id="search" type="text" class="form-control" placeholder="Search">
						</form>
					</div>
					<div id="result" class="d-grid gap-2">
						<div class="card p-5 border-0 text-center">
							<h1><span class="icon icon-doc-text-inv text-muted"></span></h1>
							<p class="text-muted">Search notes</p>
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