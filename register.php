<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jobs</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<link rel="stylesheet" href="./css/master.css">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
	<?php
		include "header.php";
	?>
	<div class="site-wrapper">
		<main class="site-main">
			<section class="section-fullwidth">
				<div class="row">	
					<div class="flex-container centered-vertically centered-horizontally">
						<div class="form-box box-shadow">
							<div class="section-heading">
								<h2 class="heading-title">Register</h2>
							</div>
							<form>
								<div class="flex-container justified-horizontally">
									<div class="primary-container">
										<h4 class="form-title">About me</h4>
										<div class="form-field-wrapper">
											<input type="text" placeholder="First Name*"/>
										</div>
										<div class="form-field-wrapper">
											<input type="text" placeholder="Last Name*"/>
										</div>
										<div class="form-field-wrapper">
											<input type="text" placeholder="Email*"/>
										</div>
										<div class="form-field-wrapper">
											<input type="text" placeholder="Password*"/>
										</div>
										<div class="form-field-wrapper">
											<input type="text" placeholder="Repeat Password*"/>
										</div>
										<div class="form-field-wrapper">
											<input type="text" placeholder="Phone Number"/>
										</div>
									</div>
									<div class="secondary-container">
										<h4 class="form-title">My Company</h4>
										<div class="form-field-wrapper">
											<input type="text" placeholder="Company Name"/>
										</div>
										<div class="form-field-wrapper">
											<input type="text" placeholder="Company Site"/>
										</div>
										<div class="form-field-wrapper">
											<textarea placeholder="Description"></textarea>
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

		<footer class="site-footer">
			<div class="row">
				<p>Copyright 2020 | Developer links: 
					<a href="index.php">Home</a>,
					<a href="dashboard.php">Jobs Dashboard</a>,
					<a href="single.php">Single</a>,
					<a href="login.php">Login</a>,
					<a href="register.php">Register</a>,
					<a href="submissions.php">Submissions</a>,
					<a href="apply-submission.php">Apply Submission</a>,
					<a href="view-submission.php">View Submission</a>,
					<a href="actions-job.php">Create-Edit Job</a>,
					<a href="category-dashboard.php">Category Dashboard</a>,
					<a href="profile.php">My Profile</a>
				</p>
			</div>
		</footer>
	</div>
</body>
</html>