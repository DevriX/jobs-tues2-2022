
	<?php
		include 'header.php';
		$id = $_GET["id"];
		$job = ShowJob($id);
		$user_id = $_GET["user_id"]; 
		$user = ShowUser($user_id);
		var_dump($user);


		$insert_user = array(
			"custom_message"  => '',
			"cv"      => '',
		);

		$inserts_error = array();

		if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] === "register"){
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
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
				if($imageFileType != "docx" && $imageFileType != "pdf") {
					$inserts_error["company_image_err"] = "Wrong file format!";
				  echo "Sorry, only DOCX & PDF files are allowed.";
				  $uploadOk = 0;
				}
				
				if ($uploadOk == 0) {
				  echo "Sorry, your file was not uploaded.";
			
				} else {
				  if (move_uploaded_file($tname, $target_file) && empty($inserts_error)) {
					$insert_user["cv"] = basename( $pname);
					echo "The file ". htmlspecialchars( basename( $pname)). " has been uploaded.";
				  } else {
						$inserts_error["cv_err"] = "Wrong file format!";
						echo "Sorry, there was an error uploading your file.";
				  }
				}
			}

			if(empty($inserts_error)){
				$sql_request = "INSERT INTO applications(user_id, job_id, custom_message, cv) VALUES ('".$insert_user['email']."'  ,  '". $insert_user['first_name']."',   '". $insert_user['last_name']."',
				'". $insert_user['password']."',  '". $insert_user['phone_number']."',  '". $insert_user['company_name']."',  '". $insert_user['company_location']."',
				'". $insert_user['company_site']."',  '". $insert_user['company_description']."' ,'". $insert_user['company_image']."', '". $insert_user['is_admin']."' )";
		
				if ($con->query($sql_request) === TRUE) {
					echo "Application submited";
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
							<form>
								<div class="flex-container justified-horizontally flex-wrap">									
									<div class="form-field-wrapper width-medium">
										<input type="text" value=<?php echo $user["first_name"] ?> placeholder="First Name*"/>
									</div>
									<div class="form-field-wrapper width-medium">
										<input type="text" value=<?php echo $user["last_name"] ?> placeholder="Last Name*"/>
									</div>
									<div class="form-field-wrapper width-medium">
										<input type="text" value=<?php echo $user["email"] ?> placeholder="Email*"/>
									</div>
									<div class="form-field-wrapper width-medium">
										<input type="text" value=<?php echo $user["phone_number"] ?> placeholder="Phone Number"/>
									</div>			
									<div class="form-field-wrapper width-large">
										<textarea placeholder="Custom Message*"></textarea>
									</div>
									<div class="form-field-wrapper width-large">
										<input type="file" />
									</div>
								</div>	
								<button class="button">
									Submit
								</button>
							</form>
						</div>
					</div>
				</div>
			</section>	
		</main>
	<?php
		include 'footer.php';?>
