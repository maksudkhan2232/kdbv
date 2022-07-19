<header id="header" class="header-area">
    <div class="top-bar">
      <div class="container-fluid custom-container">
        <div class="row">
          <div class="col-lg-6">
            <div class="top-bar-left"> <i class="fa fa-bullhorn" style="color:#d19e66"></i>
              <div id="m1" class="marquee"><span><?php echo $DailyRateChangerDetails;?></span></div>
            </div>
          </div>
          <!-- Col -->
          <div class="col-lg-6">
            <div class="top-bar-right">
              <div class="social">
                <ul>
                  <?php 
                    if($WebsiteInformation['fb_url']!=''){ 
                      $fburl=$WebsiteInformation['fb_url']; 
                    }else{ 
                      $fburl='javascript:void(0);';
                    }
                    if($WebsiteInformation['instagram_url']!=''){ 
                      $instagram_url=$WebsiteInformation['instagram_url']; 
                    }else{ 
                      $instagram_url='javascript:void(0);';
                    }
                  ?>
                  <li><a href="<?php echo $fburl;?>"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="<?php echo $instagram_url;?>"><i class="fab fa-instagram"></i></a></li>
                </ul>
              </div>
              <!--<a href="javascript:void(0);" class="my-account">My Account</a>-->
              <a href="tel:<?php echo $WebsiteInformation['mobileno'];?>" class="my-account"><i class="fa fa-mobile-alt"></i> <?php echo $WebsiteInformation['mobileno'];?></a>
              <a href="mailto:<?php echo $WebsiteInformation['email'];?>" class="my-account"><i class="far fa-envelope"></i> <?php echo $WebsiteInformation['email'];?></a> </div>
            <!--top-bar-right end-->
          </div>
          <!-- Col end-->
        </div>
        <!--Row end-->
      </div>
      <!--container end-->
    </div>
    <!--top-bar end-->
    <!-- Main Menu
    ============================================= -->
    <div class="container-fluid custom-container menu-rel-container">
      <div class="row">
        <!-- Logo
        ============================================= -->
        <div class="col-lg-6 col-xl-3">
          <div class="logo"> <a href="<?php echo base_url(); ?>"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/logo.svg" height="100" width="400" alt=""> </a> </div>
        </div>
        <!--Col end-->
        <!-- Main menu
        ============================================= -->
        <div class="col-lg-12 col-xl-7 order-lg-3 order-xl-2 menu-container">
          <div class="mainmenu style-two">
            <ul id="navigation">
              <li><a href="<?php echo base_url(); ?>" class="active">HOME</a></li>
              <li class="has-child"><a href="<?php echo base_url(); ?>collections">Collections</a>
                <div class="mega-menu five-col">
                  <div class="mega-product">
                    <h4><a class="font-red" href="javascript:void(0);">Jewellery Collection</a></h4>
                    <ul class="mega-button">
                      <?php
                        foreach ($CollectionDetails as $ckey => $cvalue) {
                          echo '<li><a href="'.base_url().'collections/products">'.ucwords($cvalue['name']).'</a></li>';
                        }
                      ?>
                    </ul>
                  </div>
                  <?php
                    foreach ($CollectionDetails as $ckey => $cvalue) {
                  ?>
                      <div class="mega-product">
                        <div class="sin-product">
                          <div class="pro-img"> <img src="<?php echo  base_url(); ?>uploads/collections/<?php echo $cvalue['image'];?>" alt="<?php echo ucwords($cvalue['name']);?>"> </div>
                          <div class="text-center"> <a href="<?php echo base_url(); ?>collections/products"><?php echo ucwords($cvalue['shortname']);?></a> </div>
                        </div>
                      </div>
                  <?php
                    }
                  ?>
                </div>
              </li>
              <li class="has-child"><a href="javascript:void(0);">Best Sellers</a>
                <div class="mega-menu">
                  <div class="mega-catagory per-20">
                    <h4><a class="font-red" href="<?php echo base_url(); ?>collections/products">By Category</a></h4>
                    <ul class="mega-button">
                      <li><a href="javascript:void(0);">Rings</a></li>
                      <li><a href="javascript:void(0);">Earrings</a></li>
                      <li><a href="javascript:void(0);">Pendants</a></li>
                      <li><a href="javascript:void(0);">Nose Pin</a></li>
                      <li><a href="javascript:void(0);">Bracelet</a></li>
                    </ul>
                  </div>
                  <div class="mega-catagory per-20">
                    <h4><a class="font-red" href="javascript:void(0);">By Price Range</a></h4>
                    <ul class="mega-button">
                      <li><a href="javascript:void(0);">Below 10K</a></li>
                      <li><a href="javascript:void(0);">10K - 20K</a></li>
                      <li><a href="javascript:void(0);">20K - 30K</a></li>
                      <li><a href="javascript:void(0);">30K - 50K</a></li>
                      <li><a href="javascript:void(0);">Above 50K</a></li>
                    </ul>
                  </div>
                  <div class="mega-catagory per-20">
                    <h4><a class="font-red" href="javascript:void(0);">By Gender</a></h4>
                    <ul class="mega-button">
                      <li><a href="javascript:void(0);">Men</a></li>
                      <li><a href="javascript:void(0);">Women</a></li>
                      <li><a href="javascript:void(0);">Kids</a></li>
                    </ul>
                  </div>
                  <div class="mega-catagory per-20">
                    <h4><a class="font-red" href="javascript:void(0);">By Metal</a></h4>
                    <ul class="mega-button">
                      <li><a href="javascript:void(0);">Gold</a></li>
                      <li><a href="javascript:void(0);">Real Diamond</a></li>
                      <li><a href="javascript:void(0);">Silver</a></li>
                      <li><a href="javascript:void(0);">Platinum</a></li>
                    </ul>
                  </div>
                  <div class="mega-catagory mega-img per-20"> <a href="javascript:void(0);"><img src="<?php echo  base_url(); ?>assest/frontend/media/images/banner/menu.jpg" alt=""></a> </div>
                </div>
              </li>
              <li><a href="<?php echo base_url(); ?>about">About US</a></li>
              <li><a href="javascript:void(0);">Gallery</a></li>
              <li><a href="<?php echo base_url(); ?>contact">CONTACT</a></li>
            </ul>
          </div>
        </div>
        <!--Menu container end-->
        <div class="col-lg-6 col-xl-2 order-lg-2 order-xl-3">
          <div class="header-right-menu">
            <ul>
              <li class="top-search searchBoxToggler"><a href="javascript:void(0)"><i class="flaticon-magnifying-glass"></i></a>                
              </li>
              <li><a href="<?php echo base_url(); ?>customer"><i class="fa fa-user"></i></a></li>
              <li class="top-cart"><a href="javascript:void(0)"><i class="flaticon-bag"></i><span>2</span></a>
                <div class="cart-drop">
                  <div class="single-cart">
                    <div class="cart-img"> <img alt="" src="<?php echo  base_url(); ?>assest/frontend/media/images/product/car1.jpg"> </div>
                    <div class="cart-title">
                      <p><a href="javascript:void(0);">The Orion Pendant</a></p>
                    </div>
                    <div class="cart-price">
                      <p>1 x 500</p>
                    </div>
                    <a href="javascript:void(0);"><i class="fa fa-times"></i></a> </div>
                  <div class="single-cart">
                    <div class="cart-img"> <img alt="" src="<?php echo  base_url(); ?>assest/frontend/media/images/product/car2.jpg"> </div>
                    <div class="cart-title">
                      <p><a href="javascript:void(0);">The Helix Bracelet</a></p>
                    </div>
                    <div class="cart-price">
                      <p>1 x 200</p>
                    </div>
                    <a href="javascript:void(0);"><i class="fa fa-times"></i></a> </div>
                  <div class="cart-bottom">
                    <!--<div class="cart-sub-total">
                        <p>Sub-Total <span>$700</span></p>
                      </div>
                      <div class="cart-sub-total">
                        <p>Eco Tax (-2.00)<span>$7.00</span></p>
                      </div>
                      <div class="cart-sub-total">
                        <p>VAT (20%) <span>$40.00</span></p>
                      </div>
                      <div class="cart-sub-total">
                        <p>Total <span>$244.00</span></p>
                      </div>-->
                    <div class="cart-checkout"> <a href="javascript:void(0);"><i class="fa fa-shopping-cart"></i>View Cart</a> </div>
                    <div class="cart-share"> <a href="javascript:void(0);"><i class="fa fa-share"></i>Checkout</a> </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!--Col end-->
      </div>
      <!--Row end-->
    </div>
    <!--container end-->
  </header>
   <!--Header end-->
  <!--=========================-->
  <!--=        Mobile Header         =-->
  <!--=========================-->
  <header class="mobile-header">
    <div class="container-fluid custom-container">
      <div class="row">
        <!-- Mobile menu Opener
          ============================================= -->
        <div class="col-4">
          <div class="accordion-wrapper"> <a href="javascript:void(0);" class="mobile-open"><i class="flaticon-menu-1"></i></a> </div>
        </div>
        <div class="col-4">
          <div class="logo"> <a href="javascript:void(0);"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/logo.svg" height="55" width="150" alt=""> </a> </div>
        </div>
        <div class="col-4">
          <div class="top-cart"> <a href="javascript:void(0)"><i class="fa fa-shopping-cart" aria-hidden="true"></i> (2)</a>
            <div class="cart-drop">
              <div class="single-cart">
                <div class="cart-img"> <img alt="" src="<?php echo  base_url(); ?>assest/frontend/media/images/product/car1.jpg"> </div>
                <div class="cart-title">
                  <p><a href="javascript:void(0);">The Orion Pendant</a></p>
                </div>
                <div class="cart-price">
                  <p>1 x $500</p>
                </div>
                <a href="javascript:void(0);"><i class="fa fa-times"></i></a> </div>
              <div class="single-cart">
                <div class="cart-img"> <img alt="" src="<?php echo  base_url(); ?>assest/frontend/media/images/product/car2.jpg"> </div>
                <div class="cart-title">
                  <p><a href="javascript:void(0);">The Helix Bracelet</a></p>
                </div>
                <div class="cart-price">
                  <p>1 x $200</p>
                </div>
                <a href="javascript:void(0);"><i class="fa fa-times"></i></a> </div>
              <div class="cart-bottom">                
                <div class="cart-checkout"> <a href="javascript:void(0);"><i class="fa fa-shopping-cart"></i>View Cart</a> </div>
                <div class="cart-share"> <a href="javascript:void(0);"><i class="fa fa-share"></i>Checkout</a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row end -->
    </div>
    <!-- /.container end -->
  </header>
  <div class="accordion-wrapper">
    <!-- Mobile Menu Navigation
        ============================================= -->
    <div id="mobilemenu" class="accordion">
      <ul>
        <li class="mob-logo text-center"><a href="javascript:void(0);"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/logo.svg" height="120" width="400" alt=""> </a></li>
        <li><a href="javascript:void(0);" class="closeme"><i class="flaticon-close"></i></a></li>
        <li> <a href="javascript:void(0);" class="out-link">Home</a> </li>
        <li> <a href="javascript:void(0);" class="link">Collections<i class="fa fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="javascript:void(0);">Gold Collection</a></li>
            <li><a href="javascript:void(0);">Silver Collection</a></li>
            <li><a href="javascript:void(0);">Real Diamonds Collection</a></li>
            <li><a href="javascript:void(0);">Platinum Collection</a></li>
          </ul>
        </li>
        <li> <a href="javascript:void(0);" class="link">By Category<i class="fa fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="javascript:void(0);">Rings</a></li>
            <li><a href="javascript:void(0);">Earrings</a></li>
            <li><a href="javascript:void(0);">Pendants</a></li>
            <li><a href="javascript:void(0);">Nose Pin</a></li>
            <li><a href="javascript:void(0);">Bracelet</a></li>
          </ul>
        </li>
        <li> <a href="javascript:void(0);" class="link">By Gender<i class="fa fa-chevron-down"></i></a>
          <ul class="submenu">
            <li><a href="javascript:void(0);">Men</a></li>
            <li><a href="javascript:void(0);">Women</a></li>
            <li><a href="javascript:void(0);">Kids</a></li>            
          </ul>
        </li>
         <li> <a href="javascript:void(0);" class="out-link">About US</a> </li>       
         <li> <a href="javascript:void(0);" class="out-link">Gallery</a> </li>
         <li> <a href="javascript:void(0);" class="out-link">Contact Us</a> </li>       
        
      </ul>
      <div class="mobile-login"> <a href="javascript:void(0);">Log in</a> | <a href="create-javascript:void(0);">Create Account</a> </div>
      <form action="javascript:void(0);" id="moble-search">
        <input placeholder="Search...." type="text">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
  </div>