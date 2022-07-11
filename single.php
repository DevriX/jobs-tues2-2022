
	<?php
		include 'header.php';
		include 'related_jobs.php';
	?>

		<?php 
			$id = $_GET["id"]; 
			$row = ShowJob($id);
			$image_path = IMAGE_PATH.$row["company_image"];

		?>
		<main class="site-main">
			<section class="section-fullwidth">
				<div class="row">
					<div class="job-single">
					
						<div class="job-main">
							<div class="job-card">
								<div class="job-primary">
									<header class="job-header">
										<h2 class="job-title"><a href="#"><?php echo  $row["title"] ?></a></h2>
										<div class="job-meta">
											<a class="meta-company" href="#"><?php echo  $row["company_name"] ?></a>
											<?php
												if($row["Date"] == 0) {
											?>
											<span class="meta-date">Today</span>
											<?php
												} else if($row["Date"] == 1){ 
											?>
											<span class="meta-date">Yesterday</span>
											<?php 
												}else {
											?>
											<span class="meta-date">Posted <?php echo  $row["Date"] ?> days ago</span>
											<?php } ?>
										</div>
										<div class="job-details">
											<span class="job-location"><?php echo  $row["company_location"] ?></span>
											<span class="job-type"><?php echo  $row["phone_number"] ?></span>
											<span class="job-price"><?php echo  $row["salary"] ?>.</span>
										</div>
									</header>

									<div class="job-body">
										<p><?php echo  $row["description"] ?></p>

										<h3>Responsibilities</h3>
										<p><?php echo  $row["responsibilities"] ?></p>
									</div>
								</div>
							</div>
						</div>
						<aside class="job-secondary">
							<div class="job-logo">
								<div class="job-logo-box">
									<img src=<?php echo $image_path ?> alt="">
								</div>
							</div>
							<a href="view-submission.php" class="button button-wide">Apply now</a>
							<a href="<?php echo  $row["company_site"] ?>" target="_blank"><?php echo  $row["company_site"] ?></a>
						</aside>
					</div>
				</div>
			</section>
			<section class="section-fullwidth">
				<div class="row">
					<h2 class="section-heading">Other related jobs:</h2>
					
					<ul class="jobs-listing">
						<?php
							$jobs = ShowRelJobs($row["id"]);
							foreach($jobs as $row){
								$image_path = IMAGE_PATH.$row["company_image"];
						?>
						<li class="job-card">
							<div class="job-primary">
								<h2 class="job-title"><a href="single.php?id=<?php echo $row["id"]?>"><?php echo  $row["title"] ?></a></h2>
								<div class="job-meta">
									<a class="meta-company" href="single.php?id=<?php echo $row["id"]?>"><?php echo  $row["company_name"] ?></a>
									<?php
									if($row["Date"] == 0) {
									?>
									<span class="meta-date">Today</span>
									<?php
										} else if($row["Date"] == 1){ 
									?>
									<span class="meta-date">Yesterday</span>
									<?php 
										}else {
											?>
									<span class="meta-date">Posted <?php echo  $row["Date"] ?> days ago</span>
									<?php } ?>
								</div>
								<div class="job-details">
									<span class="job-location"><?php echo  $row["company_location"] ?></span>
									<span class="job-type"><?php echo  $row["phone_number"] ?></span>
								</div>
							</div>
							<div class="job-logo">
								<div class="job-logo-box">
									<img src=<?php echo $image_path ?> alt="">

								</div>
							</div>
						</li>
						<?php 
							}
						?>
					</ul>
				</div>
			</section>
		</main>
	<?php
			include 'footer.php';?>