
			<?php

include 'header.php';

$insert_user = array(
	"first_name" => '',
	"last_name"  => '',
	"email"      => '',
	"password"   => '',
	"repeat_password"   => '',
	"phone_number"     => '',
	"company_name"     => '',
	"company_location"     => '',
	"company_site"     => '',
	"company_description"  => '',
	"company_image"      => ''

);

$inserts_error = array();

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] === "register"){
	//var_dump($_POST);

	 $flag = 0;



	if(empty($_POST["first_name"])){
		$inserts_error["first_name_err"] = "First name field required.";
		$flag = 1;
	}
	else{
		$insert_user["first_name"] = ($_POST["first_name"]);
	}

	if(empty($_POST["last_name"])){
		$inserts_error["last_name_err"] = "Last name field required.";
		$flag = 1;
	}
	else{
		$insert_user["last_name"] = ($_POST["last_name"]);
	}

	if(empty($_POST["email"])){
		$inserts_error["email_err"] = "Email field required.";
		$flag = 1;
	}
	else{
		$sanitized_email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
		if(filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)){
			$insert_user["email"] = ($_POST["email"]);
		}
		else{
			$flag = 1;
			echo "Sorry! Invalid Email Format! <br>";
		}	
	}

	if(empty($_POST["password"])){
		$inserts_error["password_err"] = "Password field required.";
		$flag = 1;
	}
	else{
		if(strlen($_POST["password"]) < 8){
			$inserts_error["password_err"] = " ";
			$flag = 1;
			echo "Password should be at least 8 characters!";
		}
		$insert_user["password"] = password_hash( $_POST["password"], PASSWORD_DEFAULT);
	}

	if(empty($_POST["repeat_password"])){
		$inserts_error["repeat_password_err"] = "Repeat your password.";
		$flag = 1;
	}
	else{

		if (strcmp($_POST["password"], $_POST["repeat_password"]) !== 0) {
			$flag = 1;
			echo $inserts_error["repeat_password_err"] = "Passwords don't match";
		}
		else{
			$insert_user["repeat_password"] = $_POST["repeat_password"];
		}
	}

	if(!empty($_POST["phone_number"])){

		if(strlen($_POST["phone_number"]) === 10){
			if(is_numeric( $_POST["phone_number"])){
				$insert_user["phone_number"] = $_POST["phone_number"];
			}
		}
		else{
			echo "Invalid phone number <br>";
		}
		
	}

	if(!empty($_POST["company_name"])){
		$insert_user["company_name"] = $_POST["company_name"];
	}

	if(!empty($_POST["company_location"])){
		$insert_user["company_location"] = $_POST["company_location"];
	}

	if(!empty($_POST["company_site"])){
		$insert_user["company_site"] = $_POST["company_site"];
	}

	if(!empty($_POST["company_description"])){
		$insert_user["company_description"] = $_POST["company_description"];
	}

	if(empty($_POST["company_image"])){
		$insert_user["company_image"] = basename( $_FILES["company_image"]["name"]);

		$target_file = IMAGE_PATH . basename($_FILES["company_image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}
		
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.";
	
		} else {
		  if (move_uploaded_file($_FILES["company_image"]["tmp_name"], $target_file) && $flag == 0) {
			echo "The file ". htmlspecialchars( basename( $_FILES["company_image"]["name"])). " has been uploaded.";
		  } else {
			echo "Sorry, there was an error uploading your file.";
		  }
		}
	}

	if(empty($inserts_error)){
		$sql_request = "INSERT INTO users(email, first_name, last_name, password, phone_number, company_name, company_location, company_site,
		company_description, company_image, is_admin) VALUES ('".$insert_user['email']."'  ,  '". $insert_user['first_name']."',   '". $insert_user['last_name']."',
		'". $insert_user['password']."',  '". $insert_user['phone_number']."',  '". $insert_user['company_name']."',  '". $insert_user['company_location']."',
		'". $insert_user['company_site']."',  '". $insert_user['company_description']."' ,'". $insert_user['company_image']."', 0 )";

		if ($con->query($sql_request) === TRUE) {
			echo "Profile created";
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
						<h2 class="heading-title">Register</h2>
					</div>
					<form method="post" enctype="multipart/form-data">
						<div class="flex-container justified-horizontally">
							<div class="primary-container">
								<h4 class="form-title">About me</h4>
								<div class="form-field-wrapper">
									<input type="text" name = "first_name" placeholder="First Name*"/>
									<?php if(!empty($inserts_error["first_name_err"]))
										echo "Please enter first name!";
									?>
								</div>
								<div class="form-field-wrapper">
									<input type="text"  name = "last_name" placeholder="Last Name*"/>
									<?php if(!empty($inserts_error["last_name_err"]))
										echo "Please enter last name!";
									?>
								</div>
								<div class="form-field-wrapper">
									<input type="text" name = "email" placeholder="Email*"/>
									<?php if(!empty($inserts_error["email_err"]))
										echo "Please enter email!";
									?>
								</div>
								<div class="form-field-wrapper">
									<input type="password" name = "password" placeholder="Password*"/>
									<?php if(!empty($inserts_error["password_err"]))
										echo "Please enter password!";
									?>
								</div>
								<div class="form-field-wrapper">
									<input type="password" name = "repeat_password" placeholder="Repeat Password*"/>
									<?php if(!empty($inserts_error["repeat_password_err"]))
										echo "Please repeat your password!";
									?>
								</div>
								<div class="form-field-wrapper">
									<input type="text" name ="phone_number" placeholder="Phone Number"/>
								</div>
							</div>
							<div class="secondary-container">
								<h4 class="form-title">My Company</h4>
								<div class="form-field-wrapper">
									<input type="text" name = "company_name" placeholder="Company Name"/>
								</div>
								<div class="form-field-wrapper">
									<input type="text" name = "company_site" placeholder="Company Site"/>
								</div>
								<div class="form-field-wrapper">
									<input type="text" name = "company_location" placeholder="Company Location"/>
								</div>
								<div class="form-field-wrapper"> 
									<textarea name = "company_description" placeholder="Description"></textarea>
								</div>
								<div class="form-field-wrapper">
									<input type="file"  name="company_image" id="company_image">
								</div>
							</div>		
						</div>	
						<button  type = "submit"name = "submit" value="register" class="button" >
							Register
						</button>
					</form>
				
				</div>
			</div>
		</div>
	</section>	
</main>
<?php
	include 'footer.php';?>