	<?php
require_once 'header.php';	

if(!empty($_GET['id'])){
	$app_id = $_GET['id'];
	$sql = mysqli_query($con,"SELECT *
							  FROM applications 
							  LEFT JOIN jobs 
							  ON applications.job_id=jobs.id 
							  LEFT JOIN users 
							  ON applications.user_id=users.id 
							  WHERE applications.id=" . $app_id);
	$row = mysqli_fetch_array($sql, MYSQLI_BOTH);
	$cv = $row['cv'];
}
?>
<main class="site-main">
	<section class="section-fullwidth">
		<div class="row">	
			<div class="flex-container centered-vertically centered-horizontally">
				<div class="form-box box-shadow">
					<div class="section-heading">
						<h2 class="heading-title"><?php echo $row['title'];?> - <?php echo $row['first_name']. " " .$row['last_name'];?></h2>
					</div>
					<form action="uploads/cv/<?php echo($cv) ?>">
						<div class="flex-container justified-horizontally flex-wrap">
							<div class="form-field-wrapper width-medium">
								<input type="text" placeholder="Email" value="<?php if(!empty($row['email'])){ echo $row['email']; }?>" readonly />
							</div>
							<div class="form-field-wrapper width-medium">
								<input type="text" placeholder="Phone Number" value="<?php if(!empty($row['phone_number'])){ echo $row['phone_number']; }?>" readonly />
							</div>			
							<div class="form-field-wrapper width-large">
								<textarea placeholder="Custom Message" readonly ><?php if(!empty($row['custom_message'])){ echo $row['custom_message']; }?></textarea>
							</div>
						</div>	
						<button type="submit" class="button">
							Download CV
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>	
</main>
<?php
include 'footer.php';
?>
