
	<?php
		include 'header.php';
	?>
		<main class="site-main">
			<section class="section-fullwidth section-jobs-preview">
				<div class="row">	
					<ul class="tags-list">
						<li class="list-item">
							<a href="#" class="list-item-link">IT</a>
						</li>
						<li class="list-item">
							<a href="#" class="list-item-link">Manufactoring</a>
						</li>
						<li class="list-item">
							<a href="#" class="list-item-link">Commerce</a>
						</li>
						<li class="list-item">
							<a href="#" class="list-item-link">Architecture</a>
						</li>
						<li class="list-item">
							<a href="#" class="list-item-link">Marketing</a>
						</li>
					</ul>
					<div class="flex-container centered-vertically">
						<div class="search-form-wrapper">
							<div class="search-form-field"> 
								<input class="search-form-input" type="text" value="" placeholder="Search…" name="search" > 
							</div> 
						</div>
						<div class="filter-wrapper">
							<div class="filter-field-wrapper">
								<select>
									<option value="1">Date</option>
									<option value="2">Date</option>
									<option value="3">Date</option>
									<option value="4">Type</option>
								</select>
							</div>
						</div>
					</div>

					<ul class="jobs-listing" action="db_connection.php" method="POST">
						<?php
							$jobs = ShowJobs();
							foreach($jobs as $row){
						?>
						<li class="job-card">
							<div class="job-primary">
								<h2 class="job-title"><a href="#"><?php echo  $row["title"] ?></a></h2>
								<div class="job-meta">
									<a class="meta-company" href="#"><?php echo  $row["company_name"] ?></a>
									<span class="meta-date">Posted <?php echo  $row["Date"] ?> days ago</span>
								</div>
								<div class="job-details">
									<span class="job-location"><?php echo  $row["company_location"] ?></span>
									<span class="job-type"><?php echo  $row["phone_number"] ?></span>
								</div>
							</div>
							<div class="job-logo">
								<div class="job-logo-box">
									<img src=<?php echo  $row["company_image"] ?> alt="">
								</div>
							</div>
						</li>

						<?php 
						} 
						?>
						
					</ul>
					<!-- <div class="jobs-pagination-wrapper">
						<div class="nav-links"> 
							<a class="page-numbers current">1</a> 
							<a class="page-numbers">2</a> 
							<a class="page-numbers">3</a> 
							<a class="page-numbers">4</a> 
							<a class="page-numbers">5</a> 
						</div>
					</div> -->
				</div>
			</section>	
		</main>
	<?php
		include 'footer.php';?>
