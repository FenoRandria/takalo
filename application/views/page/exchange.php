<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- start banner Area -->
<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				
			</div>
		</div>
	</section>
	<!-- End banner Area -->

	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="<?php echo base_url('assets/img/features/f-icon1.png')?>" alt="">
						</div>
						<h6>Free Delivery</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="<?php echo base_url('assets/img/features/f-icon2.png')?>" alt="">
						</div>
						<h6>Return Policy</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="<?php echo base_url('assets/img/features/f-icon3.png')?>" alt="">
						</div>
						<h6>24/7 Support</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="<?php echo base_url('assets/img/features/f-icon4.png')?>" alt="">
						</div>
						<h6>Secure Payment</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end features Area -->

	<!-- Start category Area -->
	
	<!-- End category Area -->

	<!-- start product Area -->
	<section class="owl-carousel active-product-area section_gap">
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
			
							<h1>All Products</h1>
                            <?php if ($listobjets == null) { ?>
                                <center>
                                    <a href="<?php echo base_url('objet/addformulaire')."?u=".$utilisateur_id; ?>"><h4 style="color:green">click ici pour entrer nouveau produit ...</h4></a>
                                </center>        
                            <?php } ?>
						</div>
					</div>
				</div>

				<div class="row">
					<?php foreach ($listobjets as $objet) { ?>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<a href="objet/details"><img class="img-fluid" src="<?php echo base_url('assets/img/product/p1.jpg')?>" alt=""></a>
							<div class="product-details">
								<h6><?php echo $objet['objet_description']; ?></h6>
								<h6>$_<?php echo $objet['objet_prix'];  ?></h6>
								
								<div class="prd-bottom">
									<a href="<?php echo base_url('objet/demande/?o1=').$objet1."&&o2=".$objet['objet_id'];?>" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to exchange</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				
			</div>
		</div>
		<!-- single product slide -->
		<div class="single-product-slider">
			
		</div>
	</section>
	<!-- end product Area -->

	<!-- Start exclusive deal Area -->
	
	<!-- End exclusive deal Area -->

	<!-- Start brand Area -->
	<section class="brand-area section_gap">
		<div class="container">
			<div class="row">
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="<?php echo base_url('assets/img/brand/1.png')?>" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="<?php echo base_url('assets/img/brand/2.png')?>" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="<?php echo base_url('assets/img/brand/3.png')?>" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="<?php echo base_url('assets/img/brand/4.png')?>" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="<?php echo base_url('assets/img/brand/5.png')?>" alt="">
				</a>
			</div>
		</div>
	</section>
	<!-- End brand Area -->

