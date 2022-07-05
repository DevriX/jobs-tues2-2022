<!DOCTYPE html>
<html lang="en">
		<main class="site-main">
			<section class="section-fullwidth section-login">
				<div class="row">	
					<div class="flex-container centered-vertically centered-horizontally">
						<div class="form-box box-shadow">
							<div class="section-heading">
								<h2 class="heading-title">Login</h2>
							</div>
							<form>

							<form action="welcome.php" method="post">
			Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">

								<div class="form-field-wrapper">
									<input type="text" placeholder="Email"/>
								</div>
								<div class="form-field-wrapper">
									<input type="text" placeholder="Password"/>
								</div>
								<button type="submit" class="button">
									Login
								</button>
							</form>
							<a href="#" class="button button-inline">Forgot Password</a>
						</div>
					</div>
				</div>
			</section>	
		</main>
	</div>
	<?php
		include 'footer.php';?>
