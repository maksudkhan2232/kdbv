<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>404 |  Page Not Found</title>
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
            <p><a href="<?php echo base_url(); ?>">Home  |</a> 404</p>
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
      <!-- /.col-xl-6 -->
      <div class="col-md-12 col-lg-12">
        <div class="contact-info"> <a href="javascript:void(0);"> <img src="<?php echo  base_url(); ?>uploads/404.png" > </a>
          <h5 class="mt-4" style="line-height:12px;">&nbsp;</h5>
          <p class="load-more-wrapper mb-5"> <a href="<?php echo  base_url(); ?>" class="btn-two">Back to Website</a> </p>
        </div>
      </div>
      <!-- /.col-xl-6 -->
    </div>
    <!-- /.row -->
  </section>
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