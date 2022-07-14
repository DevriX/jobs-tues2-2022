
<?php
include 'header.php';

if(!isset($_COOKIE["login"])){
	header("location:login.php"); 
}

$con = OpenCon();
$sql_cookie = mysqli_query($con,"SELECT user_id 
						  FROM cookies 
						  WHERE hash_id = '".$_COOKIE["login"]."'");
$result_cookie = mysqli_fetch_array($sql_cookie);
$user_id = intval($result_cookie["user_id"]);

$sql = mysqli_query($con,"SELECT * 
						  FROM users 
						  WHERE id = $user_id");
$result = mysqli_fetch_array($sql);



$insert_user = array(
	"first_name" 		   => $result["first_name"],
	"last_name"  		   => $result["last_name"],
	"email"     		   => $result["email"],
	"password"  		   => $result["password"],
	"repeat_password"      => $result["password"],
	"phone_number"         => $result["phone_number"],
	"company_name"         => $result["company_name"],
	"company_location"     => $result["company_location"],
	"company_site"     	   => $result["company_site"],
	"company_description"  => $result["company_description"],
	"company_image"        => $result["company_image"],
	"is_admin"             => 0

);

$inserts_error = array();

$change_users = array(
	"first_name" 		   => $result["first_name"],
	"last_name"  		   => $result["last_name"],
	"email"     		   => $result["email"],
	"password"  		   => $result["password"],
	"repeat_password"      => $result["password"],
	"phone_number"         => $result["phone_number"],
	"company_name"         => $result["company_name"],
	"company_location"     => $result["company_location"],
	"company_site"     	   => $result["company_site"],
	"company_description"  => $result["company_description"],
	"company_image"        => $result["company_image"],
	"is_admin"             => 0
);


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
								</div>
								<div class="form-field-wrapper">
									<input type="text" id = "last_name" name = "last_name" placeholder="Last Name*" value = "<?php echo $insert_user["last_name"]?>" />
								</div>
								<div class="form-field-wrapper">
									<input type="text" id = "email" name = "email" placeholder="Email*" value = "<?php echo $insert_user["email"]?>" />
								</div>
								<div class="form-field-wrapper">
									<input type="password" id = "password" name = "password" placeholder="Password"/>
								</div>
								<div class="form-field-wrapper">
									<input type="password" id = "repeat_password" name = "repeat_password" placeholder="Repeat Password"/>
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
									<textarea placeholder="Description" id = "company_description" name = "company_description" rows="30" cols="120" value="" ><?php echo $insert_user["company_description"]?></textarea>
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
