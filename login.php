<?php
		include 'header.php';
	?>
		<main class="site-main">
			<section class="section-fullwidth section-login">
				<div class="row">	
					<div class="flex-container centered-vertically centered-horizontally">
						<div class="form-box box-shadow">
							<div class="section-heading">
								<h2 class="heading-title">Login</h2>
							</div>
							<form name="f1" action="cookies.php" method="POST">
								<div class="form-field-wrapper">
									
									<!--<input name="email" type="text" placeholder="Email"/>-->
									<input name="email" type="text" placeholder="Email" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" class="input-field">
								</div>
								<div class="form-field-wrapper">
									<!--<input name="password" type="password" placeholder="Password"/>-->
									<input name="password" type="password" placeholder="Password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" class="input-field">
								</div>
								<div class="form-field-wrapper">
									<input ninput type="checkbox" name="remember"/>Remember me
								</div>
								<?php include 'login_authentication.php';?>
								<button type="submit" name = "submit" value="login" class="button">
									Login
								</button>	
							</form>
							<a href="#" class="button button-inline">Forgot Password</a>
							<div class="no account">	
							Don't have an account?
								<a href="register.php" class="Register">Register</a><br></br>
							</div>
						</div>
					</div>
				</div>
			</section>	
		</main>
	<?php
		include 'footer.php';
	?>
