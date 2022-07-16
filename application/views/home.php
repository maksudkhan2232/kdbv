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
  <section class="banner-product mybg">
    <div class="container-fluid custom-container">
      <div class="section-heading pb-30">
        <h3>Trending <span>Collections</span></h3>
      </div>
      <!-- section-heading-->
      <div class="row">
        <div class="col-xl-4 col-lg-4">
          <!-- Product baneer-->
          <div class="prod-banner-two mt-0"> <a href="javascript:void(0);"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/banner/s5.jpg" alt="">
            <div class="pb-info">
              <p>Trending Products</p>
              <h6>View All</h6>
            </div>
            </a> </div>
        </div>
        <!-- Col end-->
        <div class="no-padding col-xl-8 col-lg-8">
          <div class="prod-carousel owl-carousel owl-theme">
            <div class="sin-prod-car">
              <!-- SingleProduct-->
              <div class="sin-product style-two small">
                <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/1.jpg" alt=""> </div>
                <div class="mid-wrapper">
                  <h5 class="pro-title"><a href="javascript:void(0);">The Helix Bracelet</a></h5>                  
                  <p>Gold / <span>Bracelet</span></p>
                </div>
                <div class="icon-wrapper">
                  <div class="pro-icon">
                    <ul>
                      <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                      <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                    </ul>
                  </div>
                  <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                </div>
              </div>
              <!-- Single Product-->
              <div class="sin-product style-two small">
                <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/2.jpg" alt=""> </div>
                <span class="new-tag">NEW!</span>
                <div class="mid-wrapper">
                  <h5 class="pro-title"><a href="javascript:void(0);">The Ixia Nose Pin</a></h5>                  
                  <p>Gold / <span>Nose Pin</span></p>
                </div>
                <div class="icon-wrapper">
                  <div class="pro-icon">
                    <ul>
                      <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                      <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                    </ul>
                  </div>
                  <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                </div>
              </div>
            </div>
            <div class="sin-prod-car">
              <!-- Single Product-->
              <div class="sin-product style-two small">
                <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/3.jpg" alt=""> </div>
                <div class="mid-wrapper">
                  <h5 class="pro-title"><a href="javascript:void(0);">The Birta Lariat Necklace</a></h5>
                  <p>Gold / <span>Necklace</span></p>
                </div>
                <div class="icon-wrapper">
                  <div class="pro-icon">
                    <ul>
                      <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                      <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                    </ul>
                  </div>
                  <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                </div>
              </div>
              <!-- Single Product-->
              <div class="sin-product style-two small">
                <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/4.jpg" alt=""> </div>
                <span class="new-tag">NEW!</span>
                <div class="mid-wrapper">
                  <h5 class="pro-title"><a href="javascript:void(0);">The Felicidad Oval Bangle</a></h5>
                  <p>Gold / <span>Bangle</span></p>
                </div>
                <div class="icon-wrapper">
                  <div class="pro-icon">
                    <ul>
                      <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                      <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                    </ul>
                  </div>
                  <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                </div>
              </div>
            </div>
            <div class="sin-prod-car">
              <!-- Single Product-->
              <div class="sin-product style-two small">
                <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/5.jpg" alt=""> </div>
                <span class="new-tag">NEW!</span>
                <div class="mid-wrapper">
                  <h5 class="pro-title"><a href="javascript:void(0);">The Heart Yonder Pendant</a></h5>                  
                  <p>Silver / <span>Pendant</span></p>
                </div>
                <div class="icon-wrapper">
                  <div class="pro-icon">
                    <ul>
                      <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                      <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                    </ul>
                  </div>
                  <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                </div>
              </div>
              <!-- Single Product-->
              <div class="sin-product style-two small">
                <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/6.jpg" alt=""> </div>
                <div class="mid-wrapper">
                  <h5 class="pro-title"><a href="javascript:void(0);">The Elisha Twister Bangle</a></h5>                  
                  <p>Real Diamonds / <span>Bangle</span></p>
                </div>
                <div class="icon-wrapper">
                  <div class="pro-icon">
                    <ul>
                      <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                      <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                    </ul>
                  </div>
                  <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Col end-->
      </div>
      <!-- /.row -->
    </div>
    <!-- Container End -->
  </section>
  <!-- main-product -->
  <section class="main-product">
    <div class="container container-two">      
      <div class="section-heading">
        <h3>New <span>Arrival</span></h3>
      </div>
      <!-- /.section-heading-->
      <div class="row">
        <div class="col-xl-12 ">
          <div class="pro-tab-filter style-two">
            <ul class="pro-tab-button">
              <li class="filter active" data-filter="*">ALL</li>
              <li class="filter" data-filter=".two">Gold</li>
              <li class="filter" data-filter=".three">Silver</li>
              <li class="filter" data-filter=".four">Real Dimonds</li>
              <li class="filter" data-filter=".five">Platinum</li>
            </ul>
            <div class="grid row">
              <!-- single product -->
              <div class=" grid-item four col-6 col-md-6  col-lg-4 col-xl-3">
                <div class="sin-product style-two">
                  <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/11.jpg" alt=""> </div>
                  <div class="mid-wrapper">
                    <h5 class="pro-title"><a href="javascript:void(0);">The Chitra Mangalsutra</a></h5>
                    <p>Real Diamonds / <span>Mangalsutra</span></p>
                  </div>
                  <div class="icon-wrapper">
                    <div class="pro-icon">
                      <ul>
                        <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                        <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                      </ul>
                    </div>
                    <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                  </div>
                </div>
              </div>
              <!-- single product -->
              <div class=" grid-item two col-6 col-md-6  col-lg-4 col-xl-3">
                <div class="sin-product style-two">
                  <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/12.jpg" alt=""> </div>
                  <div class="mid-wrapper">
                    <h5 class="pro-title"><a href="javascript:void(0);">The Ekani Mangalsutra</a></h5>                    
                    <p>Gold / <span>Mangalsutra</span></p>
                  </div>
                  <div class="icon-wrapper">
                    <div class="pro-icon">
                      <ul>
                        <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                        <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                      </ul>
                    </div>
                    <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                  </div>
                </div>
              </div>
              <!-- single product -->
              <div class=" grid-item two three col-6 col-md-6  col-lg-4 col-xl-3">
                <div class="sin-product style-two">
                  <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/13.jpg" alt=""> </div>
                  <span class="new-tag">Trending </span>
                  <div class="mid-wrapper">
                    <h5 class="pro-title"><a href="javascript:void(0);">The Navdha Necklace</a></h5>                    
                    <p>Gold / <span>Necklace</span></p>
                  </div>
                  <div class="icon-wrapper">
                    <div class="pro-icon">
                      <ul>
                        <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                        <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                      </ul>
                    </div>
                    <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                  </div>
                </div>
              </div>
              <!-- single product -->
              <div class=" grid-item four col-6 col-md-6  col-lg-4 col-xl-3">
                <div class="sin-product style-two">
                  <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/10.jpg" alt=""> </div>
                  <div class="mid-wrapper">
                    <h5 class="pro-title"><a href="javascript:void(0);">The Inez Ear Cuffs</a></h5>
                    <p>Real Dimonds / <span>Earnings</span></p>
                  </div>
                  <div class="icon-wrapper">
                    <div class="pro-icon">
                      <ul>
                        <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                        <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                      </ul>
                    </div>
                    <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                  </div>
                </div>
              </div>
              <!-- single product -->
              <div class=" grid-item two five col-6 col-md-6  col-lg-4 col-xl-3">
                <div class="sin-product style-two">
                  <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/8.jpg" alt=""> </div>
                  <span class="new-tag">NEW!</span>
                  <div class="mid-wrapper">
                    <h5 class="pro-title"><a href="javascript:void(0);">The Valerius Ring</a></h5>                    
                    <p>Gold / <span>Ring</span></p>
                  </div>
                  <div class="icon-wrapper">
                    <div class="pro-icon">
                      <ul>
                        <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                        <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                      </ul>
                    </div>
                    <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                  </div>
                </div>
              </div>
              <!-- single product -->
              <div class=" grid-item two three five col-6 col-md-6  col-lg-4 col-xl-3">
                <div class="sin-product style-two">
                  <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/7.jpg" alt=""> </div>
                  <span class="new-tag">NEW!</span>
                  <div class="mid-wrapper">
                    <h5 class="pro-title"><a href="javascript:void(0);">The Emilia Ring</a></h5>                    
                    <p>Platinum / <span>Ring</span></p>
                  </div>
                  <div class="icon-wrapper">
                    <div class="pro-icon">
                      <ul>
                        <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                        <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                      </ul>
                    </div>
                    <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                  </div>
                </div>
              </div>
              <!-- single product -->
              <div class=" grid-item four col-6 col-md-6  col-lg-4 col-xl-3">
                <div class="sin-product style-two">
                  <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/6.jpg" alt=""> </div>
                  <div class="mid-wrapper">
                    <h5 class="pro-title"><a href="javascript:void(0);">The Josie Toggle Bangle</a></h5>
                    <p>Real Dimonds / <span>Bangle</span></p>
                  </div>
                  <div class="icon-wrapper">
                    <div class="pro-icon">
                      <ul>
                        <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                        <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                      </ul>
                    </div>
                    <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                  </div>
                </div>
              </div>
              <!-- single product -->
              <div class=" grid-item two four col-6 col-md-6  col-lg-4 col-xl-3">
                <div class="sin-product style-two">
                  <div class="pro-img"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/5.jpg" alt=""> </div>
                  <div class="mid-wrapper">
                    <h5 class="pro-title"><a href="javascript:void(0);">The Orion Pendant</a></h5>                    
                    <p>Gold / <span>Pendant</span></p>
                  </div>
                  <div class="icon-wrapper">
                    <div class="pro-icon">
                      <ul>
                        <li><a href="javascript:void(0);"><i class="flaticon-valentines-heart"></i></a></li>
                        <li><a class="trigger" href="javascript:void(0);"><i class="flaticon-eye"></i></a></li>
                      </ul>
                    </div>
                    <div class="add-to-cart"> <a href="javascript:void(0);">add to cart</a> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Row End -->
      <div class="load-more-wrapper"> <a href="create-javascript:void(0);" class="btn-two">View All</a> </div>
    </div>
    <!-- Container -->
  </section>
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
</body>
</html>