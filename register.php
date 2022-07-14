
<?php

function stringEndsWith($haystack,$needle,$case=true) {
    $expectedPosition = strlen($haystack) - strlen($needle);
    if ($case){
        return strrpos($haystack, $needle, 0) === $expectedPosition;
    }
    return strripos($haystack, $needle, 0) === $expectedPosition;
}

include 'header.php';

$insert_user = array(
	"first_name" 		   => '',
	"last_name"  		   => '',
	"email"     		   => '',
	"password"  		   => '',
	"repeat_password"      => '',
	"phone_number"         => '',
	"company_name"         => '',
	"company_location"     => '',
	"company_site"     	   => '',
	"company_description"  => '',
	"company_image"        => '',
	"is_admin"             => 0

);

$inserts_error = array();

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] === "register"){

	if(empty($_POST["first_name"])){
		$inserts_error["first_name_err"] = "First name field required.";
	}
	else{
		$insert_user["first_name"] = ($_POST["first_name"]);
	}

	if(empty($_POST["last_name"])){
		$inserts_error["last_name_err"] = "Last name field required.";
	}
	else{
		$insert_user["last_name"] = ($_POST["last_name"]);
	}

	if(empty($_POST["email"])){
		$inserts_error["email_err"] = "Email field required.";
	}
	else{
		//checks if email is already used`
		$con = OpenCon();
		$select = mysqli_query($con, "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($connectionID));
		if(mysqli_num_rows($select)) {
			$inserts_error["email_err"] = "Email is already being used.";
			echo('This email is already being used');
		}

		//SAnitized email and check if ots valid
		$sanitized_email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
		if(filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)){
			$insert_user["email"] = ($_POST["email"]);
		}
		else{
			echo "Sorry! Invalid Email Format! <br>";
		}	


		//check if email is devrix email.
		if (stringEndsWith($insert_user["email"], '@devrix.com')) {
			$insert_user["is_admin"] = 1;
			echo "This is devrix email!\n";
		}
	}

	if(empty($_POST["password"])){
		$inserts_error["password_err"] = "Password field required.";
	}
	else{
		
		// Validate password strength
		$uppercase = preg_match('@[A-Z]@', $_POST["password"]);
		$lowercase = preg_match('@[a-z]@', $_POST["password"]);
		$number    = preg_match('@[0-9]@', $_POST["password"]);
		$specialChars = preg_match('@[^\w]@', $_POST["password"]);
		
		if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST["password"]) < 8) {
			$inserts_error["password_err"] = "Not valid password.";
			echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
		}
		else{
			$insert_user["password"] = password_hash( $_POST["password"], PASSWORD_DEFAULT);
		}
	}

	if(empty($_POST["repeat_password"])){
		$inserts_error["repeat_password_err"] = "Repeat your password.";
	}
	else{

		if (strcmp($_POST["password"], $_POST["repeat_password"]) !== 0) {
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
		//returns true, if domain is availible, false if not
		function isDomainAvailible($domain)
		{
			//check, if a valid url is provided
			if(!filter_var($domain, FILTER_VALIDATE_URL))
			{
				return false;
			}

			//initialize curl
			$curlInit = curl_init($domain);
			curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
			curl_setopt($curlInit,CURLOPT_HEADER,true);
			curl_setopt($curlInit,CURLOPT_NOBODY,true);
			curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
			//get answer
			$response = curl_exec($curlInit);

			curl_close($curlInit);

			if ($response) return true;
			return false;
		}

		if (isDomainAvailible($_POST["company_site"])){
			$insert_user["company_site"] = $_POST["company_site"];
			echo "Up and running!";
		}
		else{
			$inserts_error["company_site_err"] = "Website not found.";
			echo "Woops, nothing found there.";
		}
	}

	if(!empty($_POST["company_description"])){
		$insert_user["company_description"] = $_POST["company_description"];
	}

	if(!empty($_FILES["company_image"]["name"])){
		$pname = $_FILES["company_image"]["name"]; 
		$tname=$_FILES["company_image"]["tmp_name"];
	  
		$name = pathinfo($_FILES['company_image']['name'], PATHINFO_FILENAME);
		$extension = pathinfo($_FILES['company_image']['name'], PATHINFO_EXTENSION);
	  
		$increment = 0; 
		$pname = $name . '.' . $extension;
		while(is_file(IMAGE_PATH.'/'.$pname)) {
			$increment++;
		    $pname = $name . $increment . '.' . $extension;
		}

		$target_file = IMAGE_PATH.'/'.$pname;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$inserts_error["company_image_err"] = "Wrong file format!";
		  	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  	$uploadOk = 0;
		}
		
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.";
		} 
		else{
		 	if (move_uploaded_file($tname, $target_file) && empty($inserts_error)){
				$insert_user["company_image"] = basename( $pname);
				echo "The file ". htmlspecialchars( basename( $pname)). " has been uploaded.";
		  	} 
		  	else{
				$inserts_error["company_image_err"] = "Wrong file format!";
				echo "Sorry, there was an error uploading your file.";
		  	}
		}
	}

	if(empty($inserts_error)){
		$sql_request = "INSERT INTO users(email, first_name, last_name, password, phone_number, company_name, company_location, company_site,
		company_description, company_image, is_admin) VALUES ('".$insert_user['email']."'  ,  '". $insert_user['first_name']."',   '". $insert_user['last_name']."',
		'". $insert_user['password']."',  '". $insert_user['phone_number']."',  '". $insert_user['company_name']."',  '". $insert_user['company_location']."',
		'". $insert_user['company_site']."',  '". $insert_user['company_description']."' ,'". $insert_user['company_image']."', '". $insert_user['is_admin']."' )";

		if ($con->query($sql_request) === TRUE) {
			echo "Profile created";
		} 
		else{
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
include 'footer.php';
?>