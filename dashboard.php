<?php
require_once 'header.php';
require_once 'search_dashboard.php';
require_once 'pagination.php';

if(!isset($_COOKIE["login"])){ 
	header("location:login.php"); 
}
?>

<main class="site-main">
	<section class="section-fullwidth section-jobs-dashboard">
		<div class="row">
			<div class="jobs-dashboard-header flex-container centered-vertically justified-horizontally">
				<div class="primary-container">							
					<ul class="tabs-menu">
						<li class="menu-item current-menu-item">
							<a href="dashboard.php">Jobs</a>					
						</li>
						<li class="menu-item">
							<a href="category-dashboard.php">Categories</a>
						</li>
					</ul>
				</div>
				<form name="search" action="" method="GET">
				<div class="secondary-container">
					<div class="flex-container centered-vertically">
						<div class="search-form-wrapper">
							<div class="search-form-field"> 
								<input class="search-form-input" type="text" value="<?php if(!empty($_GET['search'])){echo $_GET['search'];}?>" placeholder="Search…" name="search" > 
							</div> 
						</div>
						<?php 
							$drop_down = 1;
							if (!empty($_GET['drop_down_menu'])) {
								$drop_down = $_GET['drop_down_menu'];
							} 

						?>
						<div class="filter-wrapper">
							<div class="filter-field-wrapper">
								<select name='drop_down_menu'>
								<option value="1" <?php if($drop_down == 1) echo 'selected="selected"'?>>Date</option>
								<option value="2" <?php if($drop_down == 2) echo 'selected="selected"'?>>Name</option>
								</select>
							</div>
						</div>
					</div>
					<button type="submit" class="button" name="search-button">
						Search
					</button><br></br>
					</form>
				</div>
			</div>
			<ul class="jobs-listing">
			<?php
			$order_list = "jobs.date_posted DESC";
			if(isset($_GET['drop_down_menu']) && $_GET['drop_down_menu'] == 2){
				$order_list = "jobs.title ASC";
			} 
			$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			if(!empty($_GET["search"])){
				$sql = search($order_list);
			}	
			else {
				$sql = "SELECT jobs.id, jobs.title, jobs.status, DATEDIFF( CURDATE(), jobs.date_posted) 
						AS 'Date', users.phone_number, users.company_name, 
						users.company_location, users.company_image, users.company_site
						FROM jobs 
						JOIN users 
						ON users.id = jobs.user_id 
						ORDER BY $order_list";
			}
		
			if(!empty($sql)){
				$num_rows = mysqli_num_rows ($con->query($sql));
				$sql = $sql . " LIMIT " . $page_first_result .','. LIMIT;
				$page_total = ceil($num_rows / LIMIT);
				$result = mysqli_query($con, $sql); 
			}
			if(!empty($result)){		
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {	
			?>
				<li class="job-card">
					<div class="job-primary">
						<h2 class="job-title"><a href="single.php?id=<?php echo $row["id"]?>"><?php echo  $row["title"] ?></a></h2>
						<div class="job-meta">
							<a class="meta-company" href="<?php echo $row["company_site"]?>"><?php echo  $row["company_name"] ?></a>
							<?php
							if($row["Date"] == 0) {
							?>
							<span class="meta-date">Today</span>
							<?php
								} 
								else if($row["Date"] == 1){ 
							?>
							<span class="meta-date">Yesterday</span>
							<?php 
								}
								else {
									?>
							<span class="meta-date">Posted <?php echo  $row["Date"] ?> days ago</span>
							<?php } ?>
						</div>
						<div class="job-details">
							<span class="job-location"><?php echo  $row["company_location"] ?></span>
							<span class="job-type"><?php echo  $row["phone_number"] ?></span>
						</div>
					</div>
					<div class="job-secondary">
						<?php
						if($user['is_admin'] == 1) {
						?>
						<div class="job-actions">
							<a data-job-id="<?php echo $row['id'] ?>" data-status="<?php echo $row["status"] == 0 ?  1 : 0  ?>" class="button approve button-inline">
							<?php
							echo $row["status"] == 0 ?  "Approve" : "Reject" 
							?> 
							</a>		
						</div>
						<?php } ?>
						<div class="job-edit">
							<a href="submissions.php?id=<?php echo $row["id"]?>">View Submissions</a>
							<a href="actions-job.php?id=<?php echo $row["id"]?>">Edit</a>
							<a data-jobid="<?php echo  $row['id'] ?>" class="delete-job">Delete</a>
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

