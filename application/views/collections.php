<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Collections |  KD Bhindi Jewellers</title>
<?php $this->load->view('common/common_css');?> 
</head>
<body id="home-version-1" class="home-version-1" data-style="default">
<div class="site-content">
		 <?php $this->load->view('common/header');?> 
		<!--=========================-->
		<!--=        Breadcrumb         =-->
		<!--=========================-->
		<section class="breadcrumb-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="<?php echo base_url(); ?>">Home  |</a> Collections</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>
  <!--=========================-->
     
     <?php $this->load->view('common/categories');?> 
    <section class="main-product bg-two">
			<div class="container container-two">
				<div class="section-heading">
					<h3>Our <span>Collectons</span></h3>
				</div>
				<!-- /.section-heading-->
				<div class="row">
					<div class="col-xl-12 ">
						<div class="pro-tab-filter">
							<div class="grid grid-three">
								<!-- single product -->
								<div class="grid-item two col-sm-12 col-md-6">
									<div class="sin-product style-three">
										<div class="pro-img-three">
											<div class="img-show">
												<img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/03.png" alt="">
											</div>
											<div class="img-hover">
												<img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/03.png" alt="">
											</div>
										</div>
										<div class="mid-wrapper">
											<h5 class="pro-title"><a href="<?php echo base_url(); ?>products">Silver Collections</a></h5>
										</div>										
									</div>
								</div>
								<!-- /.col-xl-6 -->
								<!-- single product -->
								<div class="grid-item three col-sm-12 col-md-6">
									<div class="sin-product style-three">
										<div class="pro-img-three">
											<div class="img-show">
												<img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/01.png" alt="">
											</div>
											<div class="img-hover">
												<img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/01.png" alt="">
											</div>
										</div>
										<div class="pro-three-con">
										</div>
										<div class="mid-wrapper">
											<h5 class="pro-title"><a href="<?php echo base_url(); ?>products">Gold Collections</a></h5>
										</div>
									</div>
								</div>
								<!-- /.col-xl-6 -->
								<!-- single product -->
								<div class="grid-item four col-sm-12 col-md-6">
									<div class="sin-product style-three">
										<div class="pro-img-three">
											<div class="img-show">
												<img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/04.png" alt="">
											</div>
											<div class="img-hover">
												<img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/04.png" alt="">
											</div>
										</div>
										<div class="pro-three-con">
										</div>
										<div class="mid-wrapper">
											<h5 class="pro-title"><a href="products.php">Real Diamonds Collections </a></h5>
										</div>										
									</div>
								</div>
								<!-- /.col-xl-6 -->
								<!-- single product -->
								<div class="grid-item five col-sm-12 col-md-6">
									<div class="sin-product style-three">
										<div class="pro-img-three">
											<div class="img-show">
												<img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/02.png" alt="">
											</div>
											<div class="img-hover">
												<img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/02.png" alt="">
											</div>
										</div>
										<div class="pro-three-con">
										</div>
										<div class="mid-wrapper">
											<h5 class="pro-title"><a href="products.php">Platinum Collections</a></h5>
										</div>										
									</div>
								</div>
								<!-- /.col-xl-6 -->
								<!-- /.col-xl-6 -->
							</div>
						</div>
					</div>
				</div>
				<!-- Row End -->
			</div>
			<!-- Container End -->
		</section>
     <?php $this->load->view('common/gender-collections');?> 
     <?php $this->load->view('common/testimonials');?> 


  <!--=========================-->
  <!--=   Subscribe area      =-->

         <?php $this->load->view('common/subscribe');?> 
              <?php $this->load->view('common/footer');?> 
  <!-- footer-widget-area -->
  <!-- Back to top
  ============================================= -->
  <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
  <!--=========================-->
  <!--=   Popup 2 area      =-->
  <!--=========================-->
  <!-- Popup area
  ============================================= -->
  <!--=========================-->
              <?php $this->load->view('common/quick-view');?> 

</div>
              <?php $this->load->view('common/main-search');?> 

              <?php $this->load->view('common/common_js');?> 

</body>
</html>