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
					<form name="f1" action = "cookies.php" method="POST">
						<div class="form-field-wrapper">
							<input name="email" type="text" placeholder="Email"/>
						</div>
						<div class="form-field-wrapper">
							<input name="password" type="password" placeholder="Password"/>
						</div>
						<div class="form-field-wrapper">
							<input type="checkbox" name="remember" value = 1  />Remember me
						</div>
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
