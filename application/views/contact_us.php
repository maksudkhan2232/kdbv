<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact Us |  KD Bhindi Jewellers</title>
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
							<p><a href="<?php echo base_url(); ?>">Home  |</a> Contact Us</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>
  <!--=========================-->
     
    <section class="google-map">
			<div class="row no-gutters">
				<div class="col-md-6 col-lg-6">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29692.217195972327!2d70.44648019165838!3d21.526233573540352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395801cecca09193%3A0x22f4cf35e096cadc!2sK%20D%20Bhindi%20Jewellers!5e0!3m2!1sen!2sin!4v1655812917580!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				<!-- /.col-xl-6 -->
				<div class="col-md-6 col-lg-6">
					<div class="contact-info">
                    <a href="javascript:void(0);"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/logo.svg" height="100" width="400" alt=""> </a> 
						<h5 class="mt-4" style="line-height:12px;">KD Bhindi Jewellers</h5>
						<span>Reflect your style</span>
						<p>Zanzarda Road, opp. Saibaba Temple, Junagadh, Gujarat 362001 India</p>
						<p>Email :<span>   kdbhindi@gmail.com</span></p>
						<p>Phone:<span>  +91 9825085001</span></p>                        
					</div>
				</div>
				<!-- /.col-xl-6 -->
			</div>
			<!-- /.row -->
		</section>


  <!--=========================-->
  <!--=   Subscribe area      =-->
    <?php $this->load->view('common/testimonials');?> 
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