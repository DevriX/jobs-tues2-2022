
	<?php
		include 'header.php'; 
		include 'category_delete.php';

	?>
		<main class="site-main">
			<section class="section-fullwidth section-jobs-dashboard">
				<div class="row">						
					<div class="jobs-dashboard-header">
						<div class="primary-container">							
							<ul class="tabs-menu">
								<li class="menu-item">
									<a href="dashboard.php">Jobs</a>					
								</li>
								<li class="menu-item current-menu-item">
									<a href="#">Categories</a>
								</li>
							</ul>
						</div>
						<div class="secondary-container">
							<div class="form-box category-form">
								<form action="" method="POST">
									<div class="flex-container justified-vertically">									
										<div class="form-field-wrapper">
											<input name="title" type="text" placeholder="Enter Category Name..."/>
										</div>
											<button type="submit" class="button">
												Add New
											</button>		
									</div>	
									<?php include 'category_add.php';?>			
								</form>
								
							</div>
						</div>
					</div>
					 
					<ul class="jobs-listing">
						<?php
							$limit = 5;
							if (!isset ($_GET['page']) ) {  
								$page = 1;  
							} else {  
								$page = $_GET['page'];  
							}
							
							$page_first_result = ($page-1) * $limit;
							$sql = "SELECT id, title FROM categories ORDER BY title ASC LIMIT $page_first_result, $limit";
							$num_rows = mysqli_num_rows ($con->query("SELECT * FROM categories"));
							$page_total = ceil($num_rows / $limit);
							$result = mysqli_query($con, $sql); 
							
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						?>
						<li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title"><?php echo  $row['title'] ?></h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a data-category-id="<?php echo  $row['id'] ?>" class="button delete button-inline">Delete</a>
                                </div>
                            </div>
                        </li>
						<?php 
							} 
						
						?>					
					<div class="jobs-pagination-wrapper">
						<div class="nav-links"> 
						<?php 
							for ($i = 1; $i <= $page_total; $i++) {
								if($i == $page) {
									printf("<a class='page-numbers current' %shref='category-dashboard.php?page=%u'>%u</a>", 
									$i==$page ? : "", $i, $i );
								} else {
									printf("<a class='page-numbers' %shref='category-dashboard.php?page=%u'>%u</a>", 
									$i==$page ? : "", $i, $i );
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

