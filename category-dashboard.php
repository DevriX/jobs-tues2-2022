
<?php
	require_once 'header.php'; 
	require_once 'category_delete.php';
	require_once 'pagination.php';
	require_once 'category_add.php';
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
									<button type="submit" name = "submit" value = "add"class="button">
										Add New
									</button>		
							</div>				
						</form>
					</div>
				</div>
			</div>
			<ul class="jobs-listing">
				<?php
				
					$sql = "SELECT id, title 
							FROM categories 
							ORDER BY title ASC 
							LIMIT ".$page_first_result.','. LIMIT;
					$num_rows = mysqli_num_rows ($con->query("SELECT * FROM categories"));
					$page_total = ceil($num_rows / LIMIT);
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
					<?php pagination($page, $page_total); ?>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
require_once 'footer.php';
?>

