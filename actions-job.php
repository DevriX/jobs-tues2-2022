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
	<div class="site-wrapper">
		<header class="site-header">
			<div class="row site-header-inner">
				<div class="site-header-branding">
					<h1 class="site-title"><a href="index.php">Job Offers</a></h1>
				</div>
				<nav class="site-header-navigation">
					<ul class="menu">
						<li class="menu-item">
							<a href="index.php">Home</a>					
						</li>
						<li class="menu-item current-menu-item">
							<a href="dashboard.php">Dashboard</a>
						</li>
						<li class="menu-item">
							<a href="profile.php">My Profile</a>					
						</li>
						<li class="menu-item">
							<a href="login.php">Sign Out</a>					
						</li>
					</ul>
				</nav>
				<button class="menu-toggle">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path fill="currentColor" class='menu-toggle-bars' d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"/></svg>
				</button>
			</div>
		</header>

		<main class="site-main">
			<section class="section-fullwidth">
				<div class="row">	
					<div class="flex-container centered-vertically centered-horizontally">
						<div class="form-box box-shadow">
							<div class="section-heading">
								<h2 class="heading-title">New job</h2>
							</div>
							<form>
								<div class="flex-container flex-wrap">
									<div class="form-field-wrapper width-large">
										<input type="text" placeholder="Job title*"/>
									</div>
									<div class="form-field-wrapper width-large">
										<input type="text" placeholder="Location"/>
									</div>
									<div class="form-field-wrapper width-large">
										<input type="text" placeholder="Salary"/>
									</div>
									<div class="form-field-wrapper width-large">
										<textarea placeholder="Description*"></textarea>
									</div>	
								</div>
								<button type="submit" class="button">
									Create
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