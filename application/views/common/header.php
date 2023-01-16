<header id="header" class="header-area">
   <div class="top-bar">
      <div class="container-fluid custom-container">
         <div class="row">
            <div class="col-lg-6">
               <div class="top-bar-left">
                  <i class="fa fa-bullhorn" style="color:#d19e66"></i>
                  <div id="m1" class="marquee"><span><?php echo $DailyRateChangerDetails;?></span></div>
               </div>
            </div>
            <!-- Col -->
            <div class="col-lg-6">
               <div class="top-bar-right">
                  <div class="social">
                     <ul>
                        <?php 
                           if($WebsiteInformation['facebook']!=''){ 
                             $fburl=$WebsiteInformation['facebook']; 
                           }else{ 
                             $fburl='javascript:void(0);';
                           }
                           if($WebsiteInformation['instagram']!=''){ 
                             $instagram_url=$WebsiteInformation['instagram']; 
                           }
                           else{ 
                             $instagram_url='javascript:void(0);';
                           }
                           if($WebsiteInformation['youtube']!=''){ 
                             $youtube_url=$WebsiteInformation['youtube']; 
                           }
                           else{ 
                             $youtube_url='';
                           }
                           ?>
                        <li><a href="<?php echo $fburl;?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="<?php echo $instagram_url;?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <?php if($youtube_url!='') { ?>
                        <li><a href="<?php echo $youtube_url;?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        <?php } ?>
                     </ul>
                  </div>
                  <!--<a href="javascript:void(0);" class="my-account">My Account</a>-->
                  <a href="tel:<?php echo $WebsiteInformation['contactno'];?>" class="my-account"><i class="fa fa-phone"></i> <?php echo $WebsiteInformation['contactno'];?></a>
                  <a href="mailto:<?php echo $WebsiteInformation['cemail'];?>" class="my-account"><i class="far fa-envelope"></i> <?php echo $WebsiteInformation['cemail'];?></a> 
               </div>
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
                  <li><a href="<?php echo base_url(); ?>" <?php if($frontcurrentmenuname==''){ echo 'class="active"'; } ?> >HOME</a></li>
                  <li class="has-child">
                     <a href="<?php echo base_url(); ?>collections" <?php if($frontcurrentmenuname=='collections'){ echo 'class="active"'; } ?>>Collections</a>
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
                              <a href="<?php echo base_url(); ?>shopby/collections/<?php echo $cvalue['slug'];?>">
                                 <div class="pro-img"> <img src="<?php echo  base_url(); ?>uploads/collections/<?php echo $cvalue['image'];?>" alt="<?php echo ucwords($cvalue['name']);?>"> </div>
                              </a>
                              <div class="text-center"> <a href="<?php echo base_url(); ?>shopby/collections/<?php echo $cvalue['slug'];?>"><?php echo ucwords($cvalue['shortname']);?></a> </div>
                           </div>
                        </div>
                        <?php
                           }
                           ?>
                     </div>
                  </li>
                  <li class="has-child">
                     <a href="javascript:void(0);" <?php if($frontcurrentmenuname=='shopby'){ echo 'class="active"'; } ?>>Best Sellers</a>
                     <div class="mega-menu">
                        <div class="mega-catagory per-20">
                           <h4><a class="font-red" href="<?php echo base_url(); ?>shopby/category/">By Category</a></h4>
                           <ul class="mega-button">
                              <?php
                                 foreach ($CategoryLimitedDetails as $ctkey => $ctvalue) {
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
                           <?php 
						   $myoffers = isActive_offers();   if($myoffers['status']==1) { 
                              if(isset($OfferImageSingleDetails) && !empty($OfferImageSingleDetails)){
                                 echo '<a href="'.base_url().'offers">';
                                    echo '<img src="'.base_url().'uploads/offer/'.$OfferImageSingleDetails['image'].'" alt="'.$OfferImageSingleDetails['name'].'">';
                                 echo '</a>'; 
                              }else{
                                 echo '<a href="'.base_url().'gallery">';
                                    echo '<img src="'.base_url().'assest/frontend/media/images/blog/1.jpg">';
                                 echo '</a>'; 
                              }
							} else { echo '<a href="'.base_url().'gallery">';
                                    echo '<img src="'.base_url().'assest/frontend/media/images/blog/1.jpg">';
                                 echo '</a>'; } 
							  
                           ?>                          
                        </div>
                     </div>
                  </li>
                  <li><a href="<?php echo base_url(); ?>about" <?php if($frontcurrentmenuname=='about'){ echo 'class="active"'; } ?>>About US</a></li>
                  <li><a href="<?php echo base_url(); ?>gallery" <?php if($frontcurrentmenuname=='gallery'){ echo 'class="active"'; } ?>>Gallery</a></li>
                  <li><a href="<?php echo base_url(); ?>contact" <?php if($frontcurrentmenuname=='contact'){ echo 'class="active"'; } ?>>Contact Us</a></li>
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
                     <i class="flaticon-bag"></i><span id="totalcartproductmbl"><?php echo $carttotalproduct;?></span>
                     </a>
                     <?php 
                        if($carttotalproduct!='' and $carttotalproduct!='0'){
                        ?>
                     <div class="cart-drop" id="viewheadercart">
                        <?php
                           foreach ($this->cart->contents() as $cartkey => $cartvalue) {
                           ?>
                        <div class="single-cart" id="cartmbl<?php echo $cartvalue['rowid'];?>">
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
                              <p>
                                 Cart Empty
                              </p>
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
               <a href="<?php echo  base_url(); ?>">
               <img src="<?php echo  base_url(); ?>assest/frontend/media/images/logo.svg" height="55" width="150" alt=""> 
               </a> 
            </div>
         </div>
         <div class="col-4">
            <div class="top-cart">
                
                <a href="javascript:void(0)" onclick="return viewheadercart();">
                  <i class="fa fa-shopping-cart" aria-hidden="true" ></i><i id="totalcartproduct">(<?php echo $carttotalproduct;?>)</i>
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
                            <p>
                               Cart Empty
                            </p>
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
         <li>
            <a href="javascript:void(0);" class="link">Collections<i class="fa fa-chevron-down"></i></a>
            <ul class="submenu">
               <?php
                  foreach ($CollectionDetails as $ckey => $cvalue) {
                    echo '<li><a href="'.base_url().'shopby/collections/'.$cvalue['slug'].'">'.ucwords($cvalue['name']).'</a></li>';
                  }
                ?>

            </ul>
         </li>
         <li>
            <a href="javascript:void(0);" class="link">By Category<i class="fa fa-chevron-down"></i></a>
            <ul class="submenu">
               <?php
                  foreach ($CategoryLimitedDetails as $ctkey => $ctvalue) {
                  ?>
               <li>
                  <a href="<?php echo  base_url(); ?>shopby/category/<?php echo $cval['slug'];?>"><?php echo ucwords($ctvalue['name']);?></a>
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
         <a href="<?php echo base_url(); ?>customer">Log in</a> | <a href="<?php echo base_url(); ?>customer">Create Account</a> 
      </div>
      
      <form action="<?php echo base_url()."search/"; ?>" id="moble-search" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
         <input placeholder="Search...." type="text" class="" name="TopSearchText" id="TopSearchText" required>
         <button type="submit" id="TopSearch"><i class="fa fa-search"></i></button>
      </form>
   </div>
</div>