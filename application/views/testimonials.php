<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php if($SeoDetails['seotitle']!=""){ echo $SeoDetails['seotitle']." | ".FIRM_NAME; }else { echo FIRM_NAME; } ?></title>
<?php $this->load->view('common/common_css');?>
</head>
<body id="home-version-1" class="home-version-1" data-style="default">
<div class="site-content">
  <?php $this->load->view('common/header');?>
  <section class="breadcrumb-area">
    <div class="container-fluid custom-container">
      <div class="row">
        <div class="col-xl-12">
          <div class="bc-inner">
            <p><a href="<?php echo base_url(); ?>">Home  |</a> Customer Reviews</p>
          </div>
        </div>
        <!-- /.col-xl-12 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
  <section class="main-product pad-45">
    <div class="container">
      <div class="row">
        <!-- single product -->
        <div class="col-lg-8 col-xl-8">
          <div class="section-heading">
            <h3>Customer <span> Reviews</span></h3>
          </div>
          <div id="comments">
            <div class="comments-list">
              <div class="commentlists-div">
                <ol class="commentlists">
                  <?php foreach ($reviews as $key => $v) {  
                    if($v['image']!='')
                    {
                      $im='uploads/testimonial/'.$v['image'];
                      if(file_exists($im))
                      {
                        $img=base_url().'uploads/testimonial/'.$v['image'];
                      }else{
                        $img=base_url().'uploads/default.jpg';
                      }
                    }else{
                      $img=base_url().'uploads/default.jpg';
                    }
                    ?>
                  <li class="sin-comment  depth-1">
                    <div class="the-comment">
                      <div class="avatar"> <img src="<?php echo $img; ?>" style="width:80px;height:auto;"> </div>
                      <div class="comment-box">
                        <div class="comment-author meta">
                          <p class="com-name"><strong><?php echo $v['name'];?></strong></p>
                          <p><?php echo $v['city'];?></p>
                        </div>
                        <div class="comment-text">
                          <p><?php echo $v['desc'];?></p>
                        </div>
                      </div>
                    </div>
                    <!-- .children -->
                  </li>
                  <?php } ?>
                </ol>
                <div class="load-more-wrapper">
                  <div class="pagination-box"> <?php echo $links; ?> </div>
                </div>
              </div>
            </div>
            <!-- end commentform -->
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
  <?php $this->load->view('common/free_shipping.php');?>
  <?php $this->load->view('common/gender-collections');?>
  <?php // $this->load->view('common/testimonials');?>
  <?php $this->load->view('common/subscribe');?>
  <?php $this->load->view('common/footer');?>
  <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
  <?php $this->load->view('common/quick-view');?>
</div>
<?php $this->load->view('common/main-search');?>
<?php $this->load->view('common/common_js');?>
</body>
</html>