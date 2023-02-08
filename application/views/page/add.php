
	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">

						<img class="img-fluid" src="img/login.jpg" alt="">
						
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>ADD OBJECT</h3>
						<form class="row login_form" action="<?php echo base_url('objet/add_objet'); ?>" method="post" id="contactForm" novalidate="novalidate">
							<div class="col-md-12 form-group">
								<input type="number" name="price" min=200 max=999999999999  placeholder="Price" required>
							</div>
							<div class="col-md-12 form-group">
								<textarea name="description" id="" cols="40" rows="6" placeholder="Description" required></textarea>
							</div>
							<input type="hidden" name="u" value="<?php echo $utilisateur_id; ?>">
							<div class="col-md-12 form-group">
								<select name="categorie" id="" required>
									<option value="">votre categorie</option>
									<option value="1">vetement</option>
									<option value="2">appareil electro</option>
									<option value="3">nourriture</option>
									<option value="4">travail</option>
								</select>
							</div>
							<center>
							<!-- <div class="col-md-12 form-group">
								<input type="file" name="photo[]" multiple/>
							</div> -->
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">ADD</button>
							</div>
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->
