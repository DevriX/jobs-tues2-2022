	<?php
		include 'header.php';
	?>
		<main class="site-main">
			<section class="section-fullwidth">
				<div class="row">	
					<div class="flex-container centered-vertically centered-horizontally">
						<div class="form-box box-shadow">
							<div class="section-heading">
								<h2 class="heading-title"><?php //echo $row['job_name'] . "-". $row['first_name'] . " ". $row['last_name'];?>
								</h2>
							</div>
							<form>
								<div class="flex-container justified-horizontally flex-wrap">
									<div class="form-field-wrapper width-medium">
										<input type="text" value="<?php //echo $row['email'];?>" placeholder="Email" readonly />
										<!-- <?php $sql = "SELECT jobs.name, users.first_name, users.last_name, users.email, users.phone_number, applications.custom_message, applications.cv FROM users"?>  -->

									</div>
									<div class="form-field-wrapper width-medium">
										<input type="text" value="<?php //echo $row['phone_number'];?>"placeholder="Phone Number" readonly />
									</div>			
									<div class="form-field-wrapper width-large">
										<textarea value="<?php //echo $row['custom_message'];?>"placeholder="Custom Message" readonly ></textarea>
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
