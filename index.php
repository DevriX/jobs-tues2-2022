<?php
require_once 'header.php';
require_once 'search.php';
require_once 'pagination.php';
?>
	
<main class="site-main">
	<section class="section-fullwidth section-jobs-preview">
		<div class="row">	
		<form name="search" action="" method="GET">
			<?php
				if(isset($_GET['filter'])){
					foreach($_GET['filter'] as $filter){
			?>
				<input type="hidden" name='filter[]' value='<?php echo $filter;?>'>	
			<?php
					}
				}
			?> 	
			<ul class="tags-list">
				<?php
				$url = $_SERVER['REQUEST_URI'];
				if(!strpos($url, "?")){
					$url = $url."?";
				}

				$category = ShowCategory();
				if(!empty($category)){
					foreach($category as $row){	
						$style = "";
						if(isset($_GET['filter'])){
							if(in_array($row['id'], $_GET['filter'])){
								$style = 'style="background-color: #a1a9b5; pointer-events: none; cursor: default;"';
							}
						}	
				?>	
				<li class="list-item">
					<a <?php echo $style; ?> href="<?php echo urldecode($url."&filter[]=".$row['id']);?>"  class="list-item-link"><?php echo $row['title'];?></a>
				</li>
				<?php		
						}
					}
				?>
			</ul>
			<div class="flex-container centered-vertically">
				<div class="search-form-wrapper">
					<div class="search-form-field"> 
						<input class="search-form-input" type="text" value="<?php if(!empty($_GET['search'])){echo $_GET['search'];}?>" placeholder="Search…" name="search" > 
					</div> 
				</div>
				<?php if (!empty($_GET['drop_down_menu'])) {
					$drop_down = $_GET['drop_down_menu'];
				} else {
					$drop_down = 1;
				}?>
				<div style="display: flex">
					<div class="filter-wrapper">
						<div class="filter-field-wrapper">
							<select name='drop_down_menu'>
								<option value="1" <?php if($drop_down == 1) echo 'selected="selected"'?>>Date</option>
								<option value="2" <?php if($drop_down == 2) echo 'selected="selected"'?>>Name</option>
							</select>
						</div>					
					</div>
				</div>	
			</div>
			
			<button type="submit" class="button" name="search-button">
				Search
			</button>
			<a style="margin-left:10px" href="<?php echo $_SERVER["PHP_SELF"]?>">Clear all</a>
			<br></br>
			</form>
			<ul class="jobs-listing">
			<?php

				if(isset($_GET['drop_down_menu']) && $_GET['drop_down_menu'] == 2){
					$order_list = "jobs.title ASC";
				} 
				else{
					$order_list = "jobs.date_posted DESC";
				}
				
				$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];				
				$sql = search_filter($order_list);
				
				if(!empty($sql)){
					$num_rows = mysqli_num_rows ($con->query($sql));
					$sql = $sql . " LIMIT " . $page_first_result .','. LIMIT;
					$page_total = ceil($num_rows / LIMIT);
					$result = mysqli_query($con, $sql); 
				}
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