
	<?php
		require_once 'header.php';
		require_once 'search.php';
		require_once 'filter.php';
							
							//$attributes = ['search', 'filter_id'];
							//$sql = search();
							$sql = filter();
				if(!empty($sql)){
					$page_first_result = ($page-1) * LIMIT;
					$num_rows = mysqli_num_rows ($con->query($sql));
					$page_total = ceil($num_rows / LIMIT);
					$sql = $sql . " LIMIT " . $page_first_result .','. LIMIT;
					$result = mysqli_query($con, $sql); 
				}				
							
						
	?>
		<main class="site-main">
			<section class="section-fullwidth section-jobs-preview">
				<div class="row">
				<form name="search" action="" method="GET">	
					<ul class="tags-list">
						<?php
							$category = ShowCategory();
							if(!empty($category)){
								foreach($category as $row){
										
								
							?>	
					<li class="list-item">
						<a href="?filter_id=<?php echo $row['id']; ?>"  class="list-item-link"><?php echo $row['title'];?></a>	
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
							}
						?>
						
					<div class="jobs-pagination-wrapper">
						<div class="nav-links"> 
						<?php
							if(!empty($page_total) ){
								pagination($page, $page_total);
							}
							
					
						?>
						</div>
					</div>
				</ul>
				</div>
			</section>	
		</main>
	<?php
		include 'footer.php';?>
