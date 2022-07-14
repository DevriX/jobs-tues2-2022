<?php
function stringEndsWith($haystack,$needle,$case=true) {
    $expectedPosition = strlen($haystack) - strlen($needle);
    if ($case){
        return strrpos($haystack, $needle, 0) === $expectedPosition;
    }
    return strripos($haystack, $needle, 0) === $expectedPosition;
}

include 'header.php';

if(!isset($_COOKIE["login"])){
	header("location:login.php"); 
}


$insert_user = array(
	"first_name" 		   => $user["first_name"],
	"last_name"  		   => $user["last_name"],
	"email"     		   => $user["email"],
	"password"  		   => $user["password"],
	"repeat_password"      => $user["password"],
	"phone_number"         => $user["phone_number"],
	"company_name"         => $user["company_name"],
	"company_location"     => $user["company_location"],
	"company_site"     	   => $user["company_site"],
	"company_description"  => $user["company_description"],
	"company_image"        => $user["company_image"],
	"is_admin"             => $user["is_admin"]

);

$inserts_error = array();


if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] === "save"){
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
		$select = mysqli_query($con, "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($connectionID));
		if($_POST["email"] != $user["email"]){
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
	}

	if(!empty($_POST["password"])){
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

	if(!empty($_POST["repeat_password"])){
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
		if(!empty($user["company_image"])){
			unlink(IMAGE_PATH.'/'.$user["company_image"]);
		}
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
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$inserts_error["company_image_err"] = "Wrong file format!";
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
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
		$sql_request = "UPDATE users 
						SET email = '". $insert_user['email']."', first_name = '". $insert_user['first_name']."', 
						last_name = '". $insert_user['last_name']."', password = '". $insert_user['password']."',
						phone_number = '". $insert_user['phone_number']."', company_name = '". $insert_user['company_name']."',
						company_location = '". $insert_user['company_location']."', company_site = '". $insert_user['company_site']."',
						company_description = '". $insert_user['company_description']."', company_image = '". $insert_user['company_image']."',
						is_admin = '". $insert_user['is_admin']."'
						WHERE  id = $user_id";	

		if ($con->query($sql_request) === TRUE) {
			echo "Profile updated";
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
						<h2 class="heading-title">My Profile</h2>
					</div>
					<form method="post" enctype="multipart/form-data">
						<div class="flex-container justified-horizontally">
							<div class="primary-container">
								<h4 class="form-title">About me</h4>
								<div class="form-field-wrapper">
									<input type="text" id = "first_name" name = "first_name" placeholder="First Name*" value = "<?php echo $insert_user["first_name"]?>" />
									<?php if(!empty($inserts_error["first_name_err"]))
										echo $inserts_error["first_name_err"];
									?>
								</div>
								<div class="form-field-wrapper">
									<input type="text" id = "last_name" name = "last_name" placeholder="Last Name*" value = "<?php echo $insert_user["last_name"]?>" />
									<?php if(!empty($inserts_error["last_name_err"]))
										echo $inserts_error["last_name_err"];
									?>
								</div>
								<div class="form-field-wrapper">
									<input type="text" id = "email" name = "email" placeholder="Email*" value = "<?php echo $insert_user["email"]?>" />
									<?php if(!empty($inserts_error["email_err"]))
										echo $inserts_error["email_err"];
									?>
								</div>
								<div class="form-field-wrapper">
									<input type="password" id = "password" name = "password" placeholder="Password"/>
									<?php if(!empty($inserts_error["password_err"]))
										echo $inserts_error["password_err"];
									?>
								</div>
								<div class="form-field-wrapper">
									<input type="password" id = "repeat_password" name = "repeat_password" placeholder="Repeat Password"/>
									<?php if(!empty($inserts_error["repeat_password_err"]))
										echo $inserts_error["repeat_password_err"];
									?>
								</div>
								<div class="form-field-wrapper">
									<input type="text" id = "phone_number" name = "phone_number" placeholder="Phone Number" value = "<?php echo $insert_user["phone_number"]?>" >
								</div>
							</div>
							<div class="secondary-container">
								<h4 class="form-title">My Company</h4>
								<div class="form-field-wrapper">
									<input type="text" id = "company_name" name = "company_name" placeholder="Company Name" value = "<?php echo $insert_user["company_name"]?>"  >
								</div>
								<div class="form-field-wrapper">
									<input type="text" id = "company_site" name = "company_site" placeholder="Company Site" value = "<?php echo $insert_user["company_site"]?>"  >
								</div>
								<div class="form-field-wrapper">
									<input type="text" id = "company_location" name = "company_location" placeholder="Company Location" value = "<?php echo $insert_user["company_location"]?>"  >
								</div>
								<div class="form-field-wrapper">
									<textarea placeholder="Description" id = "company_description" name = "company_description" ><?php echo $insert_user["company_description"]?></textarea>
								</div>
								<div class="form-field-wrapper">
									<input type="file"  name="company_image" id="company_image">
								</div>
							</div>		
						</div>					
						<button type = "submit"name = "submit" value="save" class="button">
							Save
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
