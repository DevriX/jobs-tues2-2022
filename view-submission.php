	<?php
		require_once 'header.php';	
		require_once 'view_applicant.php';

		if(!empty($_GET['user_id'])){
			$user_id = $_GET['user_id'];
			$row = ShowUser();
		}
	?>
		<main class="site-main">
			<section class="section-fullwidth">
				<div class="row">	
					<div class="flex-container centered-vertically centered-horizontally">
						<div class="form-box box-shadow">
							<div class="section-heading">
								<h2 class="heading-title">Job Name - Applicant Name</h2>
							</div>
							<form name="form" action="" method="GET">
								<div class="flex-container justified-horizontally flex-wrap">
									<div class="form-field-wrapper width-medium">
										<input type="text" placeholder="Email" values="<?php $row['email']?>" readonly />
									</div>
									<div class="form-field-wrapper width-medium">
										<input type="text" placeholder="Phone Number" values="<?php $row['phone_number']?>" readonly />
									</div>			
									<div class="form-field-wrapper width-large">
										<textarea placeholder="Custom Message" values="<?php $row['custom_message']?>" readonly ></textarea>
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
	<?php
		include 'footer.php';?>
