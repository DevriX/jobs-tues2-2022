<?php
	session_start();
	
	function url_get(){
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
		$url = "https://";   
		else  
		$url = "http://";   
		// Append the host(domain name, ip) to the URL.   
		$url.= $_SERVER['HTTP_HOST'];   
		
		// Append the requested resource location to the URL   
		$url.= $_SERVER['REQUEST_URI']; 
		$current_url = 3;
		if(strpos($url, "index.php")){
			$current_url = 1;
		} 
		if(strpos($url, "login.php")){
			$current_url = 2;
		}
		if(strpos($url, "dashboard.php")){
			$current_url = 3;
		} 
		if(strpos($url, "profile.php")){
			$current_url = 4;
		}
		return $current_url; 
	}
?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jobs</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<link rel="stylesheet" href="./css/master.css">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="JS/ajax.js?<?php echo time()?>" ></script>
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
						<?php 
						if(url_get() == 1){
						?>
						<li class="menu-item current-menu-item">
							<a href="index.php">Home</a>					
						</li>
						<?php
						}
						else{
						?>
						<li class="menu-item">
							<a href="index.php">Home</a>					
						</li>
						<?php
						}
						if(url_get() == 3){
						?>
						<li class="menu-item current-menu-item">
							<a href="dashboard.php">Dashboard</a>					
						</li>
						<?php
						}
						else{
						?>
						<li class="menu-item">
							<a href="dashboard.php">Dashboard</a>					
						</li>
						<?php
						}
						if(url_get() == 4){
						?>
						<li class="menu-item current-menu-item">
							<a href="profile.php">My profile</a>					
						</li>
						<?php
						}
						else{
						?>
						<li class="menu-item">
							<a href="profile.php">My profile</a>					
						</li>
						<?php
						}
						if(isset($_COOKIE["login"]) ){
						?> 
						<li class="menu-item">
							<a href="signout.php">Sign Out</a>					
						</li>
						<?php
						}
						if(!isset($_COOKIE["login"])){
							if(url_get() == 2){
						?> 
						<li class="menu-item current-menu-item">
							<a href="login.php">Log In</a>					
						</li>
						<?php
							}
							else{
						?>
							<li class="menu-item">
								<a href="login.php">Log In</a>					
							</li>
						<?php
							}
						}
						?>
					</ul>
				</nav>
				<button class="menu-toggle">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path fill="currentColor" class='menu-toggle-bars' d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"/></svg>
				</button>
			</div>
		<?php
		include 'db_connection.php';
		$con = OpenCon();

		if(isset($_COOKIE["login"])){
		$sql = mysqli_query($con,"SELECT user_id, users.*
								FROM cookies 
								JOIN users ON users.id = cookies.user_id
								WHERE hash_id = '".$_COOKIE["login"]."'");
	
		$user  = mysqli_fetch_array($sql);
		$user_id = intval($user["user_id"]);
		}
		?>
		</header>
