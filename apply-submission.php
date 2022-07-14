
	<?php
		include 'header.php';
		$id = $_GET["id"];
		$job = ShowJob($id);

		$insert_user = array(
			"custom_message"  => '',
			"cv"      => '',
		);

		$inserts_error = array();

		if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] === "apply"){
			if(empty($_POST["custom_message"])){
				$inserts_error["custom_message_err"] = "Custom message field required.";
			}
			else{
				$insert_user["custom_message"] = ($_POST["custom_message"]);
			}

			if(!empty($_FILES["cv"]["name"])){
		
				$pname = $_FILES["cv"]["name"]; 
				$tname=$_FILES["cv"]["tmp_name"];
			  
				$name = pathinfo($_FILES['cv']['name'], PATHINFO_FILENAME);
				$extension = pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION);
			  
				$increment = 0; 
				$pname = $name . '.' . $extension;
				while(is_file(CV_PATH.'/'.$pname)) {
				   $increment++;
				   $pname = $name . $increment . '.' . $extension;
				}
		
				$target_file = CV_PATH.'/'.$pname;
				$uploadOk = 1;
				$cvFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
				if($cvFileType != "docx" && $cvFileType != "pdf") {
					$inserts_error["company_image_err"] = "Wrong file format!";
				  echo "Sorry, only DOCX & PDF files are allowed.";
				  $uploadOk = 0;
				} else {
				  if (move_uploaded_file($tname, $target_file) && empty($inserts_error)) {
					$insert_user["cv"] = basename( $pname);
					echo "The file ". htmlspecialchars( basename( $pname)). " has been uploaded.";
				  } else {
						$inserts_error["cv_err"] = "Sorry, there was an error uploading your file.";
						echo "Sorry, there was an error uploading your file.";
				  }
				}
			}

			if(empty($inserts_error)){
				$sql_request = "INSERT INTO applications(user_id, job_id, custom_message, cv) VALUES ('".$user['id']."',  '". $job['id']."',  '". $insert_user['custom_message']."' ,'". $insert_user['cv']."')";

				if ($con->query($sql_request) === TRUE) {
					echo "Application submited.";
				} else {
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
								<h2 class="heading-title">Submit application to
									<?php echo $job["title"]?></h2>
							</div>
							<form name="apply" action="" method="POST" enctype="multipart/form-data">
								<div class="flex-container justified-horizontally flex-wrap">									
									<div class="form-field-wrapper width-medium">
										<input type="text" placeholder="First Name*" value="<?php echo $user["first_name"] ?>" />
									</div>
									<div class="form-field-wrapper width-medium">
										<input type="text" placeholder="Last Name*" value="<?php echo $user["last_name"] ?>" />
									</div>
									<div class="form-field-wrapper width-medium">
										<input type="text" placeholder="Email*" value="<?php echo $user["email"] ?>" />
									</div>
									<div class="form-field-wrapper width-medium">
										<input type="text" placeholder="Phone Number" value="<?php echo $user["phone_number"] ?>" />
									</div>			
									<div class="form-field-wrapper width-large">
										<textarea name="custom_message" placeholder="Custom Message*"></textarea>
									</div>
									<div class="form-field-wrapper width-large">
										<input type="file" name="cv" id="cv">
									</div>
								</div>	
								<button type = "submit" name = "submit" value="apply" class="button" >
									Submit
								</button>
							</form>
						</div>
					</div>
				</div>
			</section>	
		</main>
	<?php
		require_once 'footer.php';?>
