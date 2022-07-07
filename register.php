
	<?php

		include 'header.php';



		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

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

	
		if($_SERVER["REQUEST_METHOD"] == "POST"){

			if(empty($_POST["first_name"])){
				$inserts_error["first_name_err"] = "First name field required.";
			}
			else{
				$insert_user["first_name"] = test_input($_POST["first_name"]);
			}

			if(empty($_POST["last_name"])){
				$inserts_error["last_name_err"] = "Last name field required.";
			}
			else{
				$insert_user["last_name"] = test_input($_POST["last_name"]);
			}

			if(empty($_POST["email"])){
				$inserts_error["email_err"] = "Email field required.";
			}
			else{
				$insert_user["email"] = $_POST["email"];
			}

			if(empty($_POST["password"])){
				$inserts_error["password_err"] = "Password field required.";
			}
			else{
				$insert_user["password"] = $_POST["password"];
			}

			if(empty($_POST["repeat_password"])){
				$inserts_error["repeat_password_err"] = "Repeat your password.";
			}
			else{
				$insert_user["repeat_password"] = $_POST["repeat_password"];
			}

			if(!empty($_POST["phone_number"])){
				$insert_user["phone_number"] = $_POST["phone_number"];
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

			if(!empty($_POST["company_image"])){
				$insert_user["company_image"] = $_POST["company_image"];
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
							<form method="post" action = "">
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
											<input type="text" name = "password" placeholder="Password*"/>
											<?php if(!empty($inserts_error["password_err"]))
												echo "Please enter password!";
											?>
										</div>
										<div class="form-field-wrapper">
											<input type="text" name = "repeat_password" placeholder="Repeat Password*"/>
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
											<input type="file" accept="image/png, image/jpeg" name="company_image">
										</div>
									</div>		
								</div>					
								<button class="button">
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