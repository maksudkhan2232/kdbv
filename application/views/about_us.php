<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php if($SeoDetails['seotitle']!=""){ echo $SeoDetails['seotitle']." | ".FIRM_NAME; }else { echo FIRM_NAME; } ?></title>
<meta name="description" content="<?php echo $SeoDetails['seodescription'];?>">
<meta name="keywords" content="<?php echo $SeoDetails['seokeywords'];?>">
<meta name="author" content="KD Bhindi Jewellers">
<meta property="og:title" content="<?php echo $SeoDetails['seotitle'];?> |  KD Bhindi Jewellers" />
<meta property="og:description" content="<?php echo $SeoDetails['seodescription'];?>" />
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
            <p><a href="<?php echo base_url(); ?>">Home  |</a> About Us</p>
          </div>
        </div>
        <!-- /.col-xl-12 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
  <!--=========================-->
  <section class="main-product pad-45">
    <div class="container">
      <div class="row">
        <!-- single product -->
        <div class="col-lg-8 col-xl-8">
          <article class="sin-blog single-page">
            <div class="section-heading">
              <h3>About <span> Us</span></h3>
            </div>
            <figure class="blog-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/about.jpg" alt="KD Bhindi Jewellers Junagadh"> </figure>
            <div class="blog-content">
              <div class="blog-meta"> <a href="javascript:void(0);">KD Bhindi Jewellers</a> </div>
              <h5>About KD Bhindi Jewellers</h5>
              <div class="blog-details">
                <p>Lorem ipsum dolor sit amet, consectetur adscing elit. Ut et lectus ut purus dapibus molestie et quis turpis. Pellentesque sed nunc eu metus tristique sagittis ut tristique purus. Nam sodales, urna id elementum sollicitudin, lectus sapien molestie
                  enim, a ultricies nibh felis ac nisl. Suspendisse vel lobortis sem.</p>
                <h6>Lorem ipsum dolor sit amet</h6>
                <ul>
                  <li>Faucibus pellentesque, mi mi tempor enim, sit amet interdum felis nibh a leo.</li>
                  <li>Proin tincidunt. Nunc ultrices hendrerit libero vel malesuada.</li>
                  <li>Nulla facilisi. Quisque eu placerat augue, sed vestibulum leo.</li>
                  <li>Etiam turpis metus, dignissim tincidunt pharetra ultricies, lobortis at ligula.</li>
                </ul>
                <p> Suspendisse nec elit ipsum. Nullam vestibulum leo vitae ipsum cursus posuere. Cras eget porta arcu. Ut vel blandit enim. Suspendisse sit amet leo dolor. Fusce a erat vehicula, fermentum sem ut, dapibus eros. Vivamus pulvinar commodo quam eget dictum.
                  Curabitur a metus quis arcu dignissim congue quis sit amet risus. Nulla.</p>
                <blockquote> <q>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut et lectus ut purus dapibus molestie et quis turpis. Pellentesque sed nunc eu metus tristique ut purus.</q> </blockquote>
                <p>Donec quis diam in lorem lacinia egestas. Praesent consequat sagittis dui, non iaculis dolor facilisis ac. Nullam sit amet lectus ac sapien porta gravida ut eu nisi. Maecenas at fermentum elit. Aenean quis nibh ullamcorper, volutpat libero in,
                  imperdiet quam. </p>
                <p>by <a href="#">Owner Name Display Here</a></p>
              </div>
            </div>
          </article>
        </div>
        <div class="col-lg-4 col-xl-4">
          <?php $this->load->view('common/sidebar');?>
        </div>
        <!-- /.col-xl-3 -->
      </div>
      <!-- Row End -->
    </div>
    <!-- Container  -->
  </section>
  <?php $this->load->view('common/free_shipping.php');?>
  <!--=========================-->
  <!--=   Subscribe area      =-->
  <?php $this->load->view('common/gender-collections');?>
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