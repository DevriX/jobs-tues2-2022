
<?php
require_once 'header.php';
require_once 'pagination.php';
require_once 'submission_delete.php';

if(isset($_GET["id"])){
	$id = $_GET["id"]; 
	$row = ShowJob($id);
}		
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
			$sql = "SELECT *, users.first_name, users.last_name, applications.user_id, applications.id 
					FROM applications 
					JOIN users 
					ON users.id = applications.user_id 
					JOIN jobs 
					ON jobs.id = applications.job_id 
					WHERE applications.job_id = $id 
					LIMIT ". $page_first_result . ',' . LIMIT;
			$num_rows = mysqli_num_rows ($con->query("SELECT * 
													FROM applications 
													WHERE applications.job_id = $id"));
			$page_total = ceil($num_rows / LIMIT);
			$result = mysqli_query($con, $sql); 
			?>	
			<div class="section-heading">
				<h2 class="heading-title"><?php echo $row["title"]?> - Submissions - <?php echo $num_rows?> Applicants</h2>
			</div>
			<?php
			if(!empty($result)){
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			?>
			<ul class="jobs-listing">
				<li class="job-card">
					<div class="job-primary">
						<h2 class="job-title"><?php echo $row["first_name"] . ' ' . $row["last_name"] ?></h2>
					</div>
					<div class="job-secondary centered-content">
						<div class="job-actions">
							<a href="view-submission.php?id=<?php echo $row['id'];?>" class="button button-inline">View</a>
							<a data-application-id="<?php echo  $row['id'] ?>" class="button delete-app button-inline">Delete</a>
						</div>
					</div>
				</li>
				<?php 
					}
				}
				?>
			</ul>					
			<div class="jobs-pagination-wrapper">
				<div class="nav-links"> 
				<?php 
					pagination($page, $page_total);
				?>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
include 'footer.php';
?>