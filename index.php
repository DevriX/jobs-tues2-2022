
<?php
include 'header.php';
if(!isset($_COOKIE["login"])){// $_COOKIE is a variable and login is a cookie name 
	header("location:login.php"); 
	echo "GOOD JOB!!! <3";
}

require_once 'header.php';
require_once 'filter_category.php';
	
$limit = 5;
$flag = 0;
if (!isset ($_GET['page']) ) {  
	$page = 1;  	
} 
else{  
	$page = $_GET['page'];
}

$page_first_result = ($page-1) * $limit;
if(!empty($_GET["search"])){
	$sql = search();
	if($sql == false){
		$flag = 1;
	}
	if(!empty($sql)){
		$num_rows = mysqli_num_rows ($con->query($sql));
		$sql = $sql . " LIMIT " . $page_first_result .','. $limit;
	}
}	
else {
	$sql = "SELECT jobs.id, jobs.title, DATEDIFF( CURDATE(), jobs.date_posted) AS 'Date', users.phone_number, users.company_name, 
			users.company_location, users.company_image
	 		FROM jobs 
			JOIN users 
			ON users.id = jobs.user_id 
			ORDER BY jobs.date_posted 
			DESC LIMIT $page_first_result, $limit";

	$num_rows = mysqli_num_rows ($con->query("SELECT * FROM jobs"));
}

if(!empty($sql)){
	$page_total = ceil($num_rows / $limit);
	$result = mysqli_query($con, $sql); 
}
?>

<form action = "signout.php">
	<button class="button">
		Sign out
	</button>
</form>
	
<main class="site-main">
	<section class="section-fullwidth section-jobs-preview">
		<div class="row">	
			<ul class="tags-list">
				<?php
					$category = ShowCategory();
					if(!empty($category)){
						foreach($category as $row){		
				?>	
				<li class="list-item">
					<a href="#"  class="list-item-link"><?php echo $row['title'];?></a>
				</li>
				<?php		
						}
					}
				?>
			</ul>
			<form name="search" action="" method="GET">
			<div class="flex-container centered-vertically">
				<div class="search-form-wrapper">
					<div class="search-form-field"> 
						<input class="search-form-input" type="text" value="<?php if(!empty($_GET['search'])){echo $_GET['search'];}?>" placeholder="Search…" name="search" > 
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
			<?php 
				if($flag == 1){
					echo '<div class="alert alert-danger" style=color:red>
					The input should be over 1 symbol!
					</div>';
				}	
			?>
			<br>
			<button type="submit" class="button" name="search-button">
				Search
			</button><br></br>
			</form>
			<ul class="jobs-listing">
			<?php
				if(!empty($result)){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {	
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
							}
							else if($row["Date"] == 1){ 
							?>
							<span class="meta-date">Yesterday</span>
							<?php 
							}
							else{
							?>
							<span class="meta-date">Posted <?php echo  $row["Date"] ?> days ago</span>
							<?php
							} 
							?>
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
				}
				?>
			</ul>
			<div class="jobs-pagination-wrapper">
				<div class="nav-links"> 
				<?php 
					if(!empty($page_total)){
						for ($i = 1; $i <= $page_total; $i++) {
							$current = '';
							if($i == $page) {
								$current = 'current';
							}
							if(isset($_GET['search'])){
			
								printf("<a class='page-numbers %s' %shref='index.php?search=%s&page=%u'>%u</a>", $current,
								$i==$page ? : "", $_GET['search'], $i, $i);
							} 
							else{
								printf("<a class='page-numbers %s' %shref='index.php?&page=%u'>%u</a>", $current,
								$i==$page ? : "", $i, $i );
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
include 'footer.php';
?>