<!doctype html>
<html>
	<head>
  	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Details |  KD Bhindi Jewellers</title>
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
                        <p><a href="<?php echo base_url(); ?>">Home  |</a>  <a href="<?php echo base_url(); ?>collections/">Collections  |</a> <?php echo $CollectionName;?></p>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section class="shop-area style-two">
            <div class="container">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="row">
                        <div class="col-lg-6 col-xl-6">
                           <!-- Product View Slider -->
                           <div class="quickview-slider">
                              <div class="slider-for">
                              	<?php 
                              		$ProductDetailsHtml='';
	                              	if(!empty($ProductImageDetail)){
													  				foreach ($ProductImageDetail as $pikey => $pivalue) {
													  					$ProductDetailsHtml .='<div class="">';
													    					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/'.$pivalue['image_name'].'" alt="Thumb">';
													    				$ProductDetailsHtml .='</div>';
													  				}
													  			}else{
													  				$ProductDetailsHtml .='<div class="">';
																		$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/noimagethumb.jpg" alt="Thumb">';
																		$ProductDetailsHtml .='</div>';
													  			}
													  			echo $ProductDetailsHtml;
                              	?>
                              </div>
                              <div class="slider-nav">
                              	<?php 
                              		$ProductDetailsHtml='';
	                              	if(!empty($ProductImageDetail)){
													  				foreach ($ProductImageDetail as $pikey => $pivalue) {
													  					$ProductDetailsHtml .='<div class="">';
													    					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/'.$pivalue['image_name'].'" alt="Thumb">';
													    				$ProductDetailsHtml .='</div>';
													  				}
													  			}else{
													  				$ProductDetailsHtml .='<div class="">';
																		$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/noimagethumb.jpg" alt="Thumb">';
																		$ProductDetailsHtml .='</div>';
													  			}
													  			echo $ProductDetailsHtml;
                              	?>
                              </div>
                           </div>
                           <!-- /.quickview-slider -->
                        </div>
                        <!-- /.col-xl-6 -->
                        <div class="col-lg-6 col-xl-6">
                           <div class="product-details">
                              <h5 class="pro-title">
                              	<a href="javascript:void(0);"><?php echo $ProductDetails['productcode'];?></a>
                              </h5>
                              <?php 
	                              if($v['price']!='0'){
																	echo '<span class="price">Price : ₹.'.$v['price'].'</span>';	
																}				       
                              ?>
                              <div class="add-tocart-wrap">
                              	<div class="cart-plus-minus-button">
                                    <input type="text" value="1" name="qtybutton" class="cart-plus-minus" id="qty<?php echo $ProductDetails['id'];?>" min="1">
                                 </div>
                                 <a href="javascript:void(0);" class="add-to-cart" onclick="return addtocart(<?php echo $ProductDetails['id'];?>);"><i class="flaticon-shopping-purse-icon"></i>Add to Cart</a>
                                 <!-- <a href="#"><i class="flaticon-valentines-heart"></i></a> -->
                              </div>
                              <!-- <span>SKU:	N/A</span>
                                  <p>Tags 
                                  	<a href="#">boys,</a>
                                  	<a href="#"> dress,</a>
                                  	<a href="#">Rok-dress</a>
                                  </p>
                              -->
                              <p>
                              	<?php echo nl2br($ProductDetails['description']);?>
                              </p>
                              <!-- <ul>
                                 <li>Lorem ipsum dolor sit amet</li>
                                 <li>quis nostrud exercitation ullamco</li>
                                 <li>Duis aute irure dolor in reprehenderit</li>
                              </ul> -->
                              <div class="product-social">
                                 <span>Share :</span>
                                 <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <!-- /.col-xl-6 -->
                        <div class="col-xl-12">
                           <div class="product-des-tab">
                              <ul class="nav nav-tabs " role="tablist">
                                 <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">DESCRIPTION</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ADDITIONAL INFORMATION</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">REVIEWS (1)</a>
                                 </li>
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                 <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="prod-bottom-tab-sin description">
                                       <h5>Description</h5>
                                       <p>
                                       	<?php echo nl2br($ProductDetails['description']);?>
                                       </p>
                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="prod-bottom-tab-sin">
                                    	<h5>Additional information</h5>
                                      <div class="info-wrap">
                                       		<?php 
                                       			$ProductDetailsHtml='';
                                       			if(!empty($ProductExtraDetail)){
																		  				foreach ($ProductExtraDetail as $pekey => $pevalue) {
																		  					$ProductDetailsHtml .='<div class="sin-aditional-info">';
																		  						$ProductDetailsHtml .='<div class="first">';
																		  							$ProductDetailsHtml .=ucwords($pevalue['ename']);
																		  						$ProductDetailsHtml .='</div>';
																		  						$ProductDetailsHtml .='<div class="secound">';
																		  							$ProductDetailsHtml .=ucwords($pevalue['evalue']);
																		  						$ProductDetailsHtml .='</div>';
																		  					$ProductDetailsHtml .='</div>';
																							}
																		  			}
																		  			echo $ProductDetailsHtml;
                                       		?>
                                      </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="prod-bottom-tab-sin">
                                       <h5>Review (1)</h5>
                                       <div class="product-review">
                                          <div class="reviwer">
                                             <img src="<?php echo  base_url(); ?>assest/frontend/media/images/reviewer.png" alt="">
                                             <div class="review-details">
                                                <span>Posted by Tonoy - Published on	March 22, 2018</span>
                                                <div class="rating">
                                                   <ul>
                                                      <li><a href="#"><i class="far fa-star"></i></a></li>
                                                      <li><a href="#"><i class="far fa-star"></i></a></li>
                                                      <li><a href="#"><i class="far fa-star"></i></a></li>
                                                      <li><a href="#"><i class="far fa-star"></i></a></li>
                                                      <li><a href="#"><i class="far fa-star"></i></a></li>
                                                   </ul>
                                                </div>
                                                <p>But I must explain to you how all this mistaken idea of denouncipleasure and praisi pain was born and I will give you a complete.</p>
                                             </div>
                                          </div>
                                          <div class="add-your-review">
                                             <h6>ADD A REVIEW</h6>
                                             <p>YOUR RATING* </p>
                                             <div class="rating">
                                                <ul>
                                                   <li><a href="#"><i class="far fa-star"></i></a></li>
                                                   <li><a href="#"><i class="far fa-star"></i></a></li>
                                                   <li><a href="#"><i class="far fa-star"></i></a></li>
                                                   <li><a href="#"><i class="far fa-star"></i></a></li>
                                                   <li><a href="#"><i class="far fa-star"></i></a></li>
                                                </ul>
                                             </div>
                                             <div class="raing-form">
                                                <form action="#">
                                                   <input type="text" placeholder="">
                                                   <input type="text">
                                                   <textarea name="rating-form"></textarea>
                                                   <input type="submit">
                                                </form>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /.row -->
                  </div>
                  <!-- /.col-xl-9 -->
               </div>
               <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
         </section>
         <section class="banner-product">
            <div class="container-fluid custom-container">
               <div class="section-heading pb-30">
                  <h3>Related <span>Products</span></h3>
               </div>
               <!-- section-heading-->
               <div class="row">
                  <!-- Col end-->
                  <div class="no-padding col-xl-12 col-lg-12">
                     <div class="relprod-carousel owl-carousel owl-theme">
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
         <!--=========================-->
         <!--=   Subscribe area      =-->
         <?php $this->load->view('common/gender-collections');?> 
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