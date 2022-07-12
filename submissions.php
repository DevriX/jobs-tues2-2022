
	<?php
		include 'header.php';
	?>
		<?php
			$id = $_GET["id"]; 
			$row = ShowJob($id);
		?>
		<main class="site-main">
			<section class="section-fullwidth">
				<div class="row">						
					<ul class="tabs-menu">
						<li class="menu-item current-menu-item">
							<a href="dashboard.php">Jobs</a>					
						</li>
						<li class="menu-item">
							<a href="category-dashboard.php">Categories</a>
						</li>
					</ul>

					<?php
							$limit = 5;

							if (!isset ($_GET['page']) ) {  
								$page = 1;  
							} else {  
								$page = $_GET['page'];  
							}
   
							$page_first_result = ($page-1) * $limit;
							$sql = "SELECT *, users.first_name, users.last_name FROM applications JOIN users ON users.id = applications.user_id JOIN jobs ON jobs.id = applications.job_id WHERE applications.job_id = $id LIMIT $page_first_result, $limit";
							$num_rows = mysqli_num_rows ($con->query("SELECT * FROM applications WHERE applications.job_id = $id"));
 							$page_total = ceil($num_rows / $limit);
							$result = mysqli_query($con, $sql); 
					?>	
					<div class="section-heading">
						<h2 class="heading-title"><?php echo $row["title"]?> - Submissions - <?php echo $num_rows?> Applicants</h2>
					</div>
					<?php
						while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {	
					?>
					<ul class="jobs-listing">
						<li class="job-card">
							<div class="job-primary">
								<h2 class="job-title"><?php echo $row["first_name"] . ' ' . $row["last_name"] ?></h2>
							</div>
							<div class="job-secondary centered-content">
								<div class="job-actions">
									<a href="view-submission.php?id=<?php echo $row["id"]?>" class="button button-inline">View</a>
								</div>
							</div>
						</li>

						<?php 
							}
						?>
						
					</ul>					
					<div class="jobs-pagination-wrapper">
						<div class="nav-links"> 
						<?php 
							for ($i = 1; $i <= $page_total; $i++) {
								if($i == $page) {
									if(isset($_GET["id"])){
										printf("<a class='page-numbers current' %shref='submissions.php?id=%u&page=%u'>%u</a>",
										$i==$page ? : "", $_GET["id"], $i, $i );
									} else {
										printf("<a class='page-numbers current' %shref='submissions.php?upage=%u'>%u</a>",
										$i==$page ? : "", $i, $i );
									}
								} else {
									if(isset($_GET["id"])){
										printf("<a class='page-numbers' %shref='submissions.php?id=%u&page=%u'>%u</a>", 
										$i==$page ?  : "", $_GET["id"], $i, $i );
									} else {
										printf("<a class='page-numbers' %shref='submissions.php?page=%u'>%u</a>", 
										$i==$page ?  : "", $i, $i );
									}
								}
							} 
						?>
						</div>
					</div>
				</div>
			</section>
		</main>
	<?php
			include 'footer.php';?>