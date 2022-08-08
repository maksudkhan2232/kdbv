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
                    <h4><a class="font-red" href="<?php echo base_url(); ?>shopby/collections">Jewellery Collection</a></h4>
                    <ul class="mega-button">
                      <?php
                        foreach ($CollectionDetails as $ckey => $cvalue) {
                          echo '<li><a href="'.base_url().'shopby/collections/'.$cvalue['slug'].'">'.ucwords($cvalue['name']).'</a></li>';
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
                          <div class="text-center"> <a href="<?php echo base_url(); ?>shopby/collections/<?php echo $cvalue['slug'];?>"><?php echo ucwords($cvalue['shortname']);?></a> </div>
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
                    <h4><a class="font-red" href="<?php echo base_url(); ?>shopby/category/">By Category</a></h4>
                    <ul class="mega-button">
                        <?php
                          foreach ($CategoryDetails as $ctkey => $ctvalue) {
                        ?>
                            <li>
                              <a href="<?php echo  base_url(); ?>shopby/category/<?php echo $ctvalue['slug'];?>"><?php echo ucwords($ctvalue['name']);?></a>
                            </li>
                        <?php
                          }
                        ?>
                    </ul>
                  </div>
                  <div class="mega-catagory per-20">
                    <h4><a class="font-red" href="javascript:void(0);">By Price Range</a></h4>
                    <ul class="mega-button">
                      <?php
                        foreach ($PriceRangeDetails as $prtkey => $prvalue) {
                      ?>
                          <li>
                            <a href="<?php echo  base_url(); ?>shopby/price/<?php echo $prvalue['slug'];?>">
                              <?php echo ucwords($prvalue['name']);?>
                            </a>
                          </li>
                      <?php
                        }
                      ?>
                    </ul>
                  </div>
                  <div class="mega-catagory per-20">
                    <h4><a class="font-red" href="javascript:void(0);">By Gender</a></h4>
                    <ul class="mega-button">
                      <?php
                        foreach ($GenderDetails as $gkey => $gvalue) {
                      ?>
                          <li>
                            <a href="<?php echo  base_url(); ?>shopby/gender/<?php echo $gvalue['slug'];?>">
                              <?php echo ucwords($gvalue['name']);?>
                            </a>
                          </li>
                      <?php
                        }
                      ?>
                    </ul>
                  </div>
                  <div class="mega-catagory per-20">
                    <h4><a class="font-red" href="javascript:void(0);">By Metal</a></h4>
                    <ul class="mega-button">
                       <?php
                        foreach ($CollectionDetails as $ckey => $cvalue) {
                      ?>
                          <li>
                            <a href="<?php echo  base_url(); ?>shopby/collections/<?php echo $cvalue['slug'];?>">
                              <?php echo ucwords($cvalue['name']);?>
                            </a>
                          </li>
                      <?php
                        }
                      ?>
                    </ul>
                  </div>
                  <div class="mega-catagory mega-img per-20"> 
                    <a href="javascript:void(0);">
                      <img src="<?php echo  base_url(); ?>assest/frontend/media/images/banner/menu.jpg" alt="">
                    </a> 
                  </div>
                </div>
              </li>
              <li><a href="<?php echo base_url(); ?>about">About US</a></li>
              <li><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
              <li><a href="<?php echo base_url(); ?>contact">Contact Us</a></li>
            </ul>
          </div>
        </div>
        <!--Menu container end-->
        <div class="col-lg-6 col-xl-2 order-lg-2 order-xl-3">
          <div class="header-right-menu">
            <ul>
              <li class="top-search searchBoxToggler">
                <a href="javascript:void(0)"><i class="flaticon-magnifying-glass"></i></a>                
              </li>
              <li><a href="<?php echo base_url(); ?>customer"><i class="fa fa-user"></i></a></li>
              <li class="top-cart">
                
                <a href="javascript:void(0)" onclick="return viewheadercart();">
                  <i class="flaticon-bag"></i><span id="totalcartproduct"><?php echo $carttotalproduct;?></span>
                </a>
                <?php 
                    if($carttotalproduct!='' and $carttotalproduct!='0'){
                ?>
                <div class="cart-drop" id="viewheadercart">
                    <?php
                      foreach ($this->cart->contents() as $cartkey => $cartvalue) {
                    ?>
                        <div class="single-cart">
                          <div class="cart-img"> 
                            <img alt="<?php echo $cartvalue['options']['product_code'];?>" src="<?php echo base_url(); ?>uploads/product/thumbnails/<?php echo $cartvalue['options']['product_image'];?>" height="100" width="100"> 
                          </div>
                          <div class="cart-title">
                            <p><a href="javascript:void(0);"><?php echo $cartvalue['options']['product_code'];?></a></p>
                          </div>
                          <div class="cart-price">
                            <p>
                              <?php 
                                echo $cartvalue['qty'];
                                if($cartvalue['price']!='' && $cartvalue['price']!='0'){
                                  echo 'X' .$cartvalue['price'];
                                }
                              ?> 
                            </p>
                          </div>
                          <a href="javascript:void(0)s;" onclick="return removetocart('<?php echo $cartvalue['rowid'];?>');"><i class="fa fa-times"></i></a> 
                        </div>
                    <?php
                      }
                    ?>
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
                        </div>
                      -->
                      <div class="cart-checkout">
                        <a href="<?php echo  base_url(); ?>order"><i class="fa fa-shopping-cart"></i>View Cart</a>
                      </div>
                      <div class="cart-share">
                        <a href="<?php echo  base_url(); ?>order/checkout"><i class="fa fa-share"></i>Checkout</a> 
                      </div>
                    </div>
                </div>
                <?php 
                    }else{
                ?>
                 <div class="cart-drop" id="viewheadercart">
                    <div class="single-cart">
                      <div class="cart-title">
                        <p>Cart Empty</p>
                      </div>
                    </div>                    
                </div>
                <?php
                    }
                ?>
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
  <!--=        Mobile Header  =-->
  <!--=========================-->
  <header class="mobile-header">
    <div class="container-fluid custom-container">
      <div class="row">
        <!-- Mobile menu Opener -->
        <div class="col-4">
          <div class="accordion-wrapper"> <a href="javascript:void(0);" class="mobile-open"><i class="flaticon-menu-1"></i></a> </div>
        </div>
        <div class="col-4">
          <div class="logo"> 
            <a href="javascript:void(0);">
              <img src="<?php echo  base_url(); ?>assest/frontend/media/images/logo.svg" height="55" width="150" alt=""> 
            </a> 
          </div>
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
    </div>
  </header>
  <div class="accordion-wrapper">
    <!-- Mobile Menu Navigation -->
    <div id="mobilemenu" class="accordion">
      <ul>
        <li class="mob-logo text-center">
          <a href="javascript:void(0);"> 
            <img src="<?php echo  base_url(); ?>assest/frontend/media/images/logo.svg" height="120" width="400" alt=""> 
          </a>
        </li>
        <li><a href="javascript:void(0);" class="closeme"><i class="flaticon-close"></i></a></li>
        <li> <a href="<?php echo  base_url(); ?>" class="out-link">Home</a> </li>
        <li> <a href="javascript:void(0);" class="link">Collections<i class="fa fa-chevron-down"></i></a>
          <ul class="submenu">
            <?php
              foreach ($CollectionDetails as $ckey => $cvalue) {
                echo '<li><a href="'.base_url().'shopby/collections/'.$cvalue['slug'].'">'.ucwords($cvalue['name']).'</a></li>';
              }
            ?>
          </ul>
        </li>
        <li> <a href="javascript:void(0);" class="link">By Category<i class="fa fa-chevron-down"></i></a>
          <ul class="submenu">
            <?php
              foreach ($CategoryDetails as $ctkey => $ctvalue) {
            ?>
                <li>
                  <a href="<?php echo  base_url(); ?>shopby/category/<?php echo $cval['slug'];?>"><?php echo ucwords($cval['name']);?></a>
                </li>
            <?php
              }
            ?>
          </ul>
        </li>
        <li> 
          <a href="javascript:void(0);" class="link">By Gender<i class="fa fa-chevron-down"></i></a>
          <ul class="submenu">
            <?php
              foreach ($GenderDetails as $gkey => $gvalue) {
            ?>
                <li>
                  <a href="<?php echo  base_url(); ?>shopby/gender/<?php echo $gvalue['slug'];?>">
                    <?php echo ucwords($gvalue['name']);?>
                  </a>
                </li>
            <?php
              }
            ?>        
          </ul>
        </li>
        <li><a href="<?php echo base_url(); ?>about" class="out-link">About US</a></li>
        <li><a href="<?php echo base_url(); ?>gallery" class="out-link">Gallery</a></li>
        <li><a href="<?php echo base_url(); ?>contact" class="out-link">Contact Us</a></li>
      </ul>
      <div class="mobile-login"> 
          <a href="javascript:void(0);">Log in</a> | <a href="create-javascript:void(0);">Create Account</a> 
      </div>
      <form action="javascript:void(0);" id="moble-search">
        <input placeholder="Search...." type="text" class="">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
  </div>