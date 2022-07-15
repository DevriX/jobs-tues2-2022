
<?php
require_once 'header.php';

if(!isset($_COOKIE["login"])){ 
	header("location:login.php"); 
}

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$job = ShowJob($id);
}

$date = date('Y-m-d');

$insert_user = array(
	"user_id"  			=> '',
	"title"  			=> '',
	"status"  			=> '',
	"description"      	=> '',
	"responsibilities"  => '',
	"salary"  			=> '',
	"date_posted"  		=> '',
);

$categories = array();

$inserts_error = array();

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] === "create"){
	if(empty($_POST["title"])){
		$inserts_error["title_err"] = "Title field required.";
	}
	else{
		$insert_user["title"] = ($_POST["title"]);
	}
	if(empty($_POST["description"])){
		$inserts_error["description_err"] = "Description field required.";
	}
	else{
		$insert_user["description"] = ($_POST["description"]);
	}
	if(!empty($_POST["responsibilities"])){
		$insert_user["responsibilities"] = ($_POST["responsibilities"]);
	}
	if(!empty($_POST["salary"])){
		$insert_user["salary"] = ($_POST["salary"]);
	}
	if(empty($_POST["categories"])){
		$inserts_error["categories_err"] = "Categories field required.";
	}
	if(empty($inserts_error)){
		$sql_request = "INSERT INTO jobs(user_id, title, status, description, responsibilities, salary, date_posted) 
						VALUES ('".$user['id']."', '".$insert_user['title']."', 0, '".$insert_user['description']."', '".$insert_user['responsibilities']."',
						        '".$insert_user['salary']."', '".$date."')";
		if ($con->query($sql_request) === TRUE) {
			echo "Job created.";
			$last_id = mysqli_insert_id($con);

			if(!empty($_POST["categories"])){
				foreach($_POST["categories"] as $category){
					$sql_request1 = "INSERT INTO jobs_categories(job_id, category_id) VALUES($last_id, $category)";
					if ($con->query($sql_request1) === TRUE) {
						echo "Category added.";
					} 
					else{
						echo "ERROR: " . $sql_request1 . "<br>";
					}
				}
			}
		} 
		else {
			echo "ERROR: " . $sql_request . "<br>";
		}
	}
}

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] === "update"){
	if(empty($_POST["title"])){
		$inserts_error["title_err"] = "Title field required.";
	}
	else{
		$insert_user["title"] = ($_POST["title"]);
	}
	if(empty($_POST["description"])){
		$inserts_error["description_err"] = "Description field required.";
	}
	else{
		$insert_user["description"] = ($_POST["description"]);
	}
	if(!empty($_POST["responsibilities"])){
		$insert_user["responsibilities"] = ($_POST["responsibilities"]);
	}
	if(!empty($_POST["salary"])){
		$insert_user["salary"] = ($_POST["salary"]);
	}

	if(empty($inserts_error)){
		$sql_request = "UPDATE jobs 
						SET user_id = '".$user['id']."', title =  '".$insert_user['title']."', status = 0, description =  '".$insert_user['description']."',
						    responsibilities =  '".$insert_user['responsibilities']."', salary = '".$insert_user['salary']."', date_posted = '".$date."'";
		if ($con->query($sql_request) === TRUE) {
			echo "Job Updated.";
			$last_id = mysqli_insert_id($con);
			$user_id = $id;
			if(!empty($_POST["categories"])){
				$sql_categories = "DELETE FROM  jobs_categories WHERE  jobs_categories.job_id = '".$id."'";
				$res1 = $con->query($sql_categories); 
				foreach($_POST["categories"] as $category){
						$sql_request1 = "INSERT INTO jobs_categories(job_id, category_id) VALUES($user_id, $category)";
					if ($con->query($sql_request1) === TRUE) {
						echo "Category updated.";
					} 
					else {
						echo "ERROR: " . $sql_request1 . "<br>";
					}
				}
			}
		} 
		else {
			echo "ERROR: " . $sql_request . "<br>";
		}
	}
}
?>


<main class="site-main">
	<section class="section-fullwidth">
		<div class="row">	
			<div class="flex-container centered-vertically centered-horizontally">
				<div class="form-box box-shadow">
					<div class="section-heading">
					<?php
					if(!isset($id)) {?>
						<h2 class="heading-title">New job</h2>
						<?php } else { ?>
							<h2 class="heading-title">Edit job</h2>
						<?php }?>
					</div>
					<form name="apply" action="" method="POST" enctype="multipart/form-data">
						<div class="flex-container flex-wrap">
							<div class="form-field-wrapper width-large">
								<input type="text" name="title" value="<?php if(!empty($job["title"])) { echo $job["title"]; }?>" placeholder="Job title*"/>
								<?php 
								if(!empty($inserts_error["title_err"]))
									echo $inserts_error["title_err"];
								?>
							</div>
							<div class="form-field-wrapper width-large">
								<input type="text" name="company_location" value="<?php if(!empty($job["company_location"])) { echo $job["company_location"]; }?>" placeholder="Location"/>
								<?php 
								if(!empty($inserts_error["location_err"]))
									echo $inserts_error["location_err"];
								?>
							</div>
							<div class="form-field-wrapper width-large">
								<input type="text" name="salary" value="<?php if(!empty($job["salary"])) { echo $job["salary"]; }?>" placeholder="Salary"/>
								<?php 
								if(!empty($inserts_error["salary_err"]))
									echo $inserts_error["salary_err"];
								?>
							</div>
							<div class="form-field-wrapper width-large">
								<textarea name="description" placeholder="Description*"><?php if(!empty($job["description"])) { echo $job["description"]; }?></textarea>
								<?php 
								if(!empty($inserts_error["description_err"]))
									echo $inserts_error["description_err"];
								?>
							</div>	
							<div class="form-field-wrapper width-large">
								<textarea name="responsibilities" placeholder="Responsibilities"><?php if(!empty($job["responsibilities"])) { echo $job["responsibilities"]; }?></textarea>
								<?php 
								if(!empty($inserts_error["responsibilities_err"]))
									echo $inserts_error["responsibilities_err"];
								?>
							</div>	
							<div class="form-field-wrapper width-large">
								<select multiple="multiple" name="categories[]">
								<?php 
								if(!empty($inserts_error["categories_err"]))
									echo $inserts_error["categories_err"];
								?>
								<option style="text-align:center" disabled>
									Select one or more categories:
								</option>
								<?php 
								$request = $con->query("SELECT * FROM categories");
								if(mysqli_num_rows($request) > 0) {
									while($row = mysqli_fetch_array($request, MYSQLI_BOTH)){
									?>
										<option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
									<?php 
									}
								}
								 ?>
								</select>
							</div>
						</div>
						<?php
						if(!isset($id)) {?>
						<button type="submit" name = "submit" value="create" class="button">
							Create
						</button>
						<?php } else { ?>
							<button type="submit" name = "submit" value="update" class="button">
							Update
						</button>
						<?php }?>
					</form>
				</div>
			</div>
		</div>
	</section>	
</main>
<?php
require_once 'footer.php';
?>