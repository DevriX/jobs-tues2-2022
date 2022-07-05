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
								<h2 class="heading-title">Job Name - Applicant Name</h2>
							</div>
							<form>
								<div class="flex-container justified-horizontally flex-wrap">
									<div class="form-field-wrapper width-medium">
										<input type="text" placeholder="Email" readonly />
									</div>
									<div class="form-field-wrapper width-medium">
										<input type="text" placeholder="Phone Number" readonly />
									</div>			
									<div class="form-field-wrapper width-large">
										<textarea placeholder="Custom Message" readonly ></textarea>
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