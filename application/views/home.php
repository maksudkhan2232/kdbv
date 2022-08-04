<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>KD Bhindi Jewellers Junagadh</title>
<?php $this->load->view('common/common_css');?> 
</head>
<body id="home-version-1" class="home-version-1" data-style="default">
<div class="site-content">
  <!--=========================-->
  <!--=        Header         =-->
  <!--=========================-->
  <!-- Top Bar area start
  ============================================= -->
  <?php $this->load->view('common/header');?> 
  <!--=========================-->
  <!--=        Slider         =-->
  <!--=========================-->
  <?php
    if(!empty($SliderDetails)){
  ?>
  <section class="slider-wrapper">
    <div class="slider-start slider-2 owl-carousel owl-theme">
      <?php
        foreach($SliderDetails as $skey=>$sval){
      ?>
      <div class="item"> 
        <img src="<?php echo  base_url(); ?>uploads/slider/<?php echo $sval['image'];?>" alt="<?php echo $sval['title'];?>">
        <div class="container-fluid custom-container slider-content">
          <div class="row align-items-center">
            <div class="col-12 col-sm-8 col-md-8 col-lg-6 ml-auto">
              <div class="slider-text style-two">
                <h1 class="animated fadeIn"><span><?php echo $sval['title'];?></span> <?php echo $sval['subtitle'];?></h1>
                <p class="animated fadeIn"><?php echo $sval['description'];?></p>
                <?php 
                  if($sval['linktext']!='' and $sval['linkurl']!=''){
                ?>
                <a class="animated fadeIn btn-two" href="<?php echo $sval['linkurl'];?>"><?php echo $sval['linktext'];?></a> </div>
                <?php 
                  }
                ?>                
            </div>
            <!-- Col End -->
          </div>
          <!-- Row End -->
        </div>
      </div>
      <?php 
        }
      ?>
    </div>
  </section>
  <?php 
    }
  ?>
  <!-- Slides end -->
  <!--=========================-->
  <!--= Product banner style two  =-->
  <!--=========================-->
  <!--=========================-->
  <!--= Product banner style two  =-->
  <!--=========================-->
  <?php $this->load->view('common/categories');?> 

  <?php
    if(!empty($TrendingCollectionDetails)){
  ?>
  <section class="banner-product mybg">
    <div class="container-fluid custom-container">
      <div class="section-heading pb-30">
        <h3>Trending <span>Collections</span></h3>
      </div>
      <!-- section-heading-->
      <div class="row">
        <div class="col-xl-4 col-lg-4">
          <div class="prod-banner-two mt-0"> 
            <a href="javascript:void(0);"> 
              <img src="<?php echo  base_url(); ?>assest/frontend/media/images/banner/s5.jpg" alt="">
              <div class="pb-info">
                <p>Trending Products</p>
                <h6>View All</h6>
              </div>
            </a> 
          </div>
        </div>
        <!-- Col end-->
        <div class="no-padding col-xl-8 col-lg-8">
          <div class="prod-carousel owl-carousel owl-theme">
            <?php
              foreach(array_chunk($TrendingCollectionDetails, 2) as $TrendingCollection ) {
            ?>
              <div class="sin-prod-car">
                <?php
                  foreach($TrendingCollection as $tckey=>$tcval){
                ?>              
                    <div class="sin-product style-two small">
                      <div class="pro-img"> 
                        <img src="<?php echo base_url(); ?>uploads/product/thumbnails/<?php echo $tcval['image_name'];?>" alt="<?php echo $tcval['productcode'];?>"> 
                      </div>
                      <?php 
                        if (strpos($tcval['highlight'], 'NEW ARRIVAL') !== false) {
                      ?>
                          <span class="new-tag">
                            New 
                          </span>
                      <?php
                        }
                      ?>
                      
                      <div class="mid-wrapper">
                        <h5 class="pro-title">
                          <a href="<?php echo base_url().'products/view/'.$tcval['slug'];?>"><?php echo $tcval['productcode'];?></a>
                        </h5>                  
                        <p><?php echo $tcval['collectionshortname'];?> / <span><?php echo $tcval['categoryname'];?></span></p>
                      </div>
                      <div class="icon-wrapper">
                        <div class="pro-icon">
                          <ul>
                            <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                            <li>
                              <a href="javascript:void(0);" class="triggersss" data-id="<?php echo $tcval['id'];?>" id="productquickview" onClick="TrendingQuickView(<?php echo $tcval['id'];?>);">
                                <i class="flaticon-eye"></i>
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="add-to-cart"> <a href="javascript:void(0);" onclick="return addtocart(<?php echo $tcval['id'];?>);">add to cart</a> </div>
                      </div>
                    </div>
                <?php 
                  }
                ?>
              </div>
            <?php 
              }
            ?>
          </div>
        </div>
        <!-- Col end-->
      </div>
      <!-- /.row -->
    </div>
    <!-- Container End -->
  </section>
  <?php 
    }
  ?>

  

  <!-- main-product -->
  <?php
    if(!empty($NewArrivalCollectionDetails)){
  ?>
  <section class="main-product">
    <div class="container container-two">      
      <div class="section-heading">
        <h3>New <span>Arrival</span></h3>
      </div>
      <div class="row">
        <div class="col-xl-12 ">
          <div class="pro-tab-filter style-two">
            <ul class="pro-tab-button">
              <li class="filter active" data-filter="*">ALL</li>
               <?php
                foreach ($CollectionDetails as $ckey => $cvalue) {
                  echo '<li class="filter" data-filter=".'.$cvalue['shortname'].'">'.ucwords($cvalue['shortname']).'</li>';
                }
              ?>
            </ul>
            <div class="grid row">
              <?php 
                foreach ($NewArrivalCollectionDetails as $nakey => $navalue) {
              ?>
                  <div class=" grid-item <?php echo $navalue['collectionshortname'];?> col-6 col-md-6  col-lg-4 col-xl-3">
                    <div class="sin-product style-two">
                      <div class="pro-img">
                         <img src="<?php echo base_url(); ?>uploads/product/thumbnails/<?php echo $navalue['image_name'];?>" alt="<?php echo $navalue['productcode'];?>"> 
                      </div>
                      <?php 
                        if (strpos($navalue['highlight'], 'TRENDING COLLECTIONS') !== false) {
                      ?>
                          <span class="new-tag">
                            Trending 
                          </span>
                      <?php
                        }
                      ?>
                      <div class="mid-wrapper">
                        <h5 class="pro-title"><a href="<?php echo base_url().'products/view/'.$navalue['slug'];?>"><?php echo $navalue['productcode'];?></a></h5>
                        <p><?php echo $navalue['collectionshortname'];?> / <span><?php echo $navalue['categoryname'];?></span></p>
                      </div>
                      <div class="icon-wrapper">
                        <div class="pro-icon">
                          <ul>
                            <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                            <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                          </ul>
                        </div>
                        <div class="add-to-cart"> <a href="javascript:void(0);" onclick="return addtocart(<?php echo $navalue['id'];?>);">add to cart</a> </div>
                      </div>
                    </div>
                  </div>
              <?php
                }
              ?>
            </div>
          </div>
        </div>
      </div>
      <?php
        if(count($NewArrivalCollectionDetails) > 8){
      ?>
      <div class="load-more-wrapper"> <a href="create-javascript:void(0);" class="btn-two">View All</a> </div>
      <?php    
        }
      ?>      
    </div>
  </section>
  <?php 
    }
  ?>
  
  <!-- main-product End -->
  <!--=========================-->
  <!--=   Discount Countdown area      =-->
  <!--=========================-->
  <section class="add-area"> <a href="javascript:void(0);"><img src="<?php echo  base_url(); ?>assest/frontend/media/images/banner/add.jpg" alt=""></a> </section>
  <!--=========================-->
  <!--=   Product  area with  banner      =-->
  <!--=========================-->
  <?php $this->load->view('common/gender-collections');?> 
  <?php $this->load->view('common/testimonials');?> 
  <!--=========================-->
  <!--=   Subscribe area      =-->
  <!--=========================-->
   <?php $this->load->view('common/subscribe');?> 
  <!--=========================-->
  <!--=   Footer area      =-->
  <!--=========================-->
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
    <?php $this->load->view('common/welcome');?> 
  <!--=========================-->
  <!--=   Product Quick view area       =-->
  <!--=========================-->
  <!-- Quick View -->
     <?php $this->load->view('common/quick-view');?> 
</div>
<!-- /#site -->
  <?php $this->load->view('common/main-search');?> 
  <?php $this->load->view('common/common_js');?> 
    <?php
  // Trednig Modal
  if(!empty($TrendingCollectionDetails)){
      foreach ($TrendingCollectionDetails as $pkey => $pvalue) {
  ?>
  <div class="modal quickview-wrapper" id="pmodel<?php echo $pvalue['id'];?>">
    <div class="quickview">
       <div class="row">
        <div class="col-12"> <span class="close-qv"><i class="flaticon-close"></i> </span> </div>
        <div class="col-md-6">
          <span id="slider-js"></span>
          <div class="quickview-sliders">
            <div class="slider-for" id="slider-for<?php echo $pvalue['id'];?>">
              <?php echo $pvalue['sliderfor']; ?>
            </div>
            <div class="slider-nav" id="slider-nav<?php echo $pvalue['id'];?>">
              <?php echo $pvalue['slidernav']; ?>
            </div>
          </div>
        </div>
        <div class="col-md-6" id="product-details">
          <?php echo $pvalue['productdetails']; ?>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
     $('.slider-for<?php echo $pvalue['id'];?>').slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '.slider-nav',
          swipe: false,
        });

        $('.slider-nav<?php echo $pvalue['id'];?>').slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          asNavFor: '.slider-for',
          focusOnSelect: true,
          swipe: false,
          infinite: false,
          arrows: true,
        });
  </script>
  <?php 
      }
  }
  ?>
  <script type="text/javascript">
    function TrendingQuickView(productid){
      var mask = '<div class="mask-overlay">';
      $('#pmodel'+productid).toggleClass('open');
      $(mask).hide().appendTo('body').fadeIn('fast');
      
      $('.mask-overlay, .close-qv').on('click', function() {
        $('.quickview-wrapper').removeClass('open');
        $('.mask-overlay').remove();
      });
    }
  </script>
</body>
</html>