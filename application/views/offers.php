<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Offers |  KD Bhindi Jewellers</title>
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
            <p><a href="<?php echo base_url(); ?>">Home  |</a> Offers</p>
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
          <div class="section-heading">
            <h3>KD Bhindi <span> Offers</span></h3>
          </div>
          <?php foreach ($offers as $key => $v) {   ?>
          <div class="grid row">
            <div class=" grid-item two col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <article class="sin-blog">
                <figure class="blog-img img-hover-zoom"> <a href="<?php echo base_url(); ?>uploads/offer/<?php echo $v['document']; ?>" target="_blank"><img src="<?php echo base_url(); ?>uploads/offer/<?php echo $v['image']; ?>" alt="KD Bhindi Offers"></a> </figure>
                <div class="blog-content">
                  <div class="blog-meta"> <a href="<?php echo base_url(); ?>uploads/offer/<?php echo $v['document']; ?>"  target="_blank">View Offer</a> </div>
                  <h5><a class="title" href="<?php echo base_url(); ?>uploads/offer/<?php echo $v['document']; ?>" target="_blank"><?php echo $v['name']; ?></a></h5>
                </div>
              </article>
            </div>
          </div>
          <?php } ?>
          <div class="load-more-wrapper">
            <div class="pagination-box"> <?php echo $links; ?> </div>
          </div>
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

  <?php $this->load->view('common/gender-collections');?>
  <?php $this->load->view('common/testimonials');?>
  <?php $this->load->view('common/subscribe');?>
  <?php $this->load->view('common/footer');?>

  <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>

  <?php $this->load->view('common/quick-view');?>
</div>
<?php $this->load->view('common/main-search');?>
<?php $this->load->view('common/common_js');?>
</body>
</html>