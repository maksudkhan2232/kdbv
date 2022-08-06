<!doctype html>
<html>
   <head>
      <!-- Meta Data -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Shop By |  KD Bhindi Jewellers</title>
      <?php $this->load->view('common/common_css');?> 
      <style type="text/css">
         /*	CheckBox CSS Start	*/
         .form-group {
         display: block;
         margin-bottom: 15px;
         }
         .form-group input {
         padding: 0;
         height: initial;
         width: initial;
         margin-bottom: 0;
         display: none;
         cursor: pointer;
         }
         .form-group label {
         position: relative;
         cursor: pointer;
         }
         .form-group label:before {
         content:'';
         -webkit-appearance: none;
         background-color: transparent;
         border: 2px solid #d19e66;
         box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
         padding: 10px;
         display: inline-block;
         position: relative;
         vertical-align: middle;
         cursor: pointer;
         margin-right: 5px;
         }
         .form-group input:checked + label:after {
         content: '';
         display: block;
         position: absolute;
         top: 4px;
         left: 10px;
         width: 6px;
         height: 14px;
         border: solid #d19e66;
         border-width: 0 2px 2px 0;
         transform: rotate(45deg);
         }
         /*	CheckBox CSS end	*/
      </style>
   </head>
   <body id="home-version-1" class="home-version-1" data-style="default">
		<div class="site-content">
			<?php $this->load->view('common/header');?> 
			<section class="breadcrumb-area">
				<div class="container-fluid custom-container">
				   <div class="row">
				      <div class="col-xl-12">
				         <div class="bc-inner">
				            <p>
				            	<a href="<?php echo base_url(); ?>">Home  |</a>
				            	<a href="<?php echo base_url().'shopby/'.$type; ?>"><?php echo $type;?>  |</a>
				            	<?php echo $SubType;?>
				            </p>
				         </div>
				      </div>
				   	</div>
				</div>				
			</section>
			<section class="shop-area">
				<div class="container-fluid custom-container">
			   		<div class="row">
				      	<div class="order-2 order-lg-1 col-lg-3 col-xl-3">
				         	<div class=" shop-sidebar">
					            <div class="sidebar-widget sidebar-search">
					               <input type="text" placeholder="Search Product....">
					               <button type="submit"><i class="fas fa-search"></i></button>
					            </div>
					            <div class="sidebar-widget category-widget">
					               <h6>Gold Collections / Categories</h6>
					               <ul>
					                  <li><a href="#" class="active">Earrings</a> <span>(19)</span></li>
					                  <li><a href="#">Bangles</a> <span>(15)</span></li>
					                  <li><a href="#">Bracelets</a> <span>(59)</span></li>
					                  <li><a href="#">Diamond Chains</a> <span>(29)</span></li>
					                  <li><a href="#">Necklaces</a> <span>(56)</span></li>
					                  <li><a href="#">Nose Pins</a> <span>(48)</span></li>
					                  <li><a href="#">Mangalsutra</a> <span>(11)</span></li>
					               </ul>
					            </div>
					            <div class="sidebar-widget range-widget">
					               <h6>SEARCH BY PRICE</h6>
					               <div class="price-range">
					                  <div id="slider-range"></div>
					                  <span>Price :</span>
					                  <input type="text" id="amount">
					               </div>
					            </div>
					            <div class="sidebar-widget category-widget">
					               <h6>SEARCH BY GENDER</h6>
					               <form>
					                  <div class="form-group">
					                     <input type="checkbox" id="chk1" checked>
					                     <label for="chk1">Man Collections</label>
					                  </div>
					                  <div class="form-group">
					                     <input type="checkbox" id="chk2" checked>
					                     <label for="chk2">Woman Collections</label>
					                  </div>
					                  <div class="form-group">
					                     <input type="checkbox" id="chk3" checked>
					                     <label for="chk3">Kids Collections</label>
					                  </div>
					               </form>
					            </div>
					            <div class="sidebar-widget category-widget">
					               <h6>SEARCH BY Metal</h6>
					               <form>
					                  <div class="form-group">
					                     <input type="checkbox" id="chkGold" checked>
					                     <label for="chkGold">Gold</label>
					                  </div>
					                  <div class="form-group">
					                     <input type="checkbox" id="chkSilver" >
					                     <label for="chkSilver">Silver</label>
					                  </div>
					                  <div class="form-group">
					                     <input type="checkbox" id="chkReal" >
					                     <label for="chkReal">Real Diamonds</label>
					                  </div>
					                  <div class="form-group">
					                     <input type="checkbox" id="chkPlatinum" >
					                     <label for="chkPlatinum">Platinum</label>
					                  </div>
					               </form>
					            </div>
					            <div class="sidebar-widget product-widget">
					               <h6>Trending Products</h6>
					               <div class="wid-pro">
					                  <div class="sp-img">
					                     <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/sb1.jpg" alt="">
					                  </div>
					                  <div class="small-pro-details">
					                     <h5 class="title"><a href="#">The Felicidad Oval Bangle</a></h5>
					                     <span>Gold / Bracelet</span>
					                     <div class="rating">
					                        <a href="javascript:void(0);">View Details</a>
					                     </div>
					                  </div>
					               </div>
					               <div class="wid-pro">
					                  <div class="sp-img">
					                     <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/sb1.jpg" alt="">
					                  </div>
					                  <div class="small-pro-details">
					                     <h5 class="title"><a href="#">The Felicidad Oval Bangle</a></h5>
					                     <span>Gold / Bracelet</span>
					                     <div class="rating">
					                        <a href="javascript:void(0);">View Details</a>
					                     </div>
					                  </div>
					               </div>
					               <div class="wid-pro">
					                  <div class="sp-img">
					                     <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/sb1.jpg" alt="">
					                  </div>
					                  <div class="small-pro-details">
					                     <h5 class="title"><a href="#">The Felicidad Oval Bangle</a></h5>
					                     <span>Gold / Bracelet</span>
					                     <div class="rating">
					                        <a href="javascript:void(0);">View Details</a>
					                     </div>
					                  </div>
					               </div>
					               <div class="wid-pro">
					                  <div class="sp-img">
					                     <img src="<?php echo  base_url(); ?>assest/frontend/media/images/product/sb1.jpg" alt="">
					                  </div>
					                  <div class="small-pro-details">
					                     <h5 class="title"><a href="#">The Felicidad Oval Bangle</a></h5>
					                     <span>Gold / Bracelet</span>
					                     <div class="rating">
					                        <a href="javascript:void(0);">View Details</a>
					                     </div>
					                  </div>
					               </div>
					            </div>
					            <div class="sidebar-widget product-widget">
					               <h6>Our Collections</h6>
					               <div class="singleProduct-slider owl-carousel owl-theme">
					                  <div class="sin-instagram">
					                     <img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/01.png" alt="">
					                     <div class="hover-text"> <a href="#"> <span>Gold Jewellery</span> </a> </div>
					                  </div>
					                  <div class="sin-instagram">
					                     <img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/02.png" alt="">
					                     <div class="hover-text"> <a href="#"> <span>Silver Jewellery</span> </a> </div>
					                  </div>
					                  <div class="sin-instagram">
					                     <img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/03.png" alt="">
					                     <div class="hover-text"> <a href="#"> <span>Real Diamond Jewellery</span> </a> </div>
					                  </div>
					                  <div class="sin-instagram">
					                     <img src="<?php echo  base_url(); ?>assest/frontend/media/images/products/04.png" alt="">
					                     <div class="hover-text"> <a href="#"> <span>Platinum Jewellery</span> </a> </div>
					                  </div>
					               </div>
					            </div>
					            <div class="sidebar-widget banner-wid">
					               <div class="img">
					                  <img src="<?php echo  base_url(); ?>assest/frontend/media/images/banner/sb1.jpg" alt="">
					               </div>
					            </div>
				         	</div>
				      	</div>
				        <div class="order-1 order-lg-2 col-lg-9 col-xl-9">
							<div class="shop-sorting-area row">
								<div class="col-4 col-sm-4 col-md-6">
								   <?php /*?>
								   <ul class="nav nav-tabs shop-btn" id="myTab" role="tablist">
								      <li class="nav-item ">
								         <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="flaticon-menu"></i></a>
								      </li>
								      <li class="nav-item">
								         <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="flaticon-list"></i></a>
								      </li>
								   </ul>
								   <?php */?>
								</div>
								<div class="col-12 col-sm-8 col-md-6">
								   <div class="sort-by">
								      <span>Sort by :</span>
								      <select class="orderby" name="orderby">
								         <option value="menu_order">Default sorting</option>
								         <option value="popularity">Sort by popularity</option>
								         <option value="rating">Sort by average rating</option>
								         <option value="date">Sort by newness</option>
								         <option selected="selected">Best Selling</option>
								      </select>
								   </div>
								</div>						
							</div>
				            <div class="shop-content shop-four-grid">
				                <div class="tab-content" id="myTabContent">
				                   <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				                      	<div class="row">
					                      	<?php
					                      		foreach ($ProductDetails as $pkey => $pvalue) {
					                      	?>
					                      		<div class="col-sm-6 col-xl-3">
						                            <div class="sin-product style-two">
						                               <div class="pro-img">
						                                  <img src="<?php echo base_url(); ?>uploads/product/thumbnails/<?php echo $pvalue['image_name'];?>" alt="<?php echo $pvalue['productcode'];?>">
						                               </div>
						                                <?php 
									                        if (strpos($pvalue['highlight'], 'NEW ARRIVAL') !== false) {
									                    ?>
									                          <span class="new-tag">
									                            NEW 
									                          </span>
								                      	<?php
								                        	}
								                      	?>
								                      	<?php 
									                       if (strpos($pvalue['highlight'], 'TRENDING COLLECTIONS') !== false) {
									                    ?>
									                          <span class="new-tag">
									                            Trending 
									                          </span>
								                      	<?php
								                        	}
								                      	?>
						                              	<div class="mid-wrapper">
						                                  <h5 class="pro-title">
						                                  	<a href="javascript:void(0);"><?php echo $pvalue['productcode'];?></a>
						                                  </h5>
						                                  <p><?php echo ucwords($pvalue['collectionshortname']);?> / <span><?php echo ucwords($pvalue['categoryname']);?></span></p>
						                                </div>
						                               <div class="icon-wrapper">
						                                  <div class="pro-icon">
						                                     <ul>
						                                        <li><a href="javascript:void(0);" onClick="FavoriteProducts(<?php echo $pvalue['id'];?>);" ><i class="flaticon-valentines-heart"></i></a></li>
						                                        <li><a href="javascript:void(0);" class="triggers" data-id="<?php echo $pvalue['id'];?>" id="productquickview" onClick="productquickview(<?php echo $pvalue['id'];?>);"><i class="flaticon-eye"></i></a></li>
						                                     </ul>
						                                  </div>
						                                  <div class="add-to-cart">
						                                     <a href="javascript:void(0);"  onclick="return addtocart(<?php echo $pvalue['id'];?>);">add to cart</a>
						                                  </div>
						                               </div>
						                            </div>
						                        </div>
					                      	<?php
					                      		}
					                      	?>
				                      	</div>
				                   </div>
				                </div>
				                <div class="load-more-wrapper">
				                   <a href="#" class="btn-two">Load More</a>
				                </div>
				                <div class="load-more-wrapper">
				                   <div class="pagination-box">
				                      <ul class="styled-pagination">
				                         <li><a href="#" class="control"><span class="fa fa-caret-left"></span></a></li>
				                         <li><a href="#" class="active">1</a></li>
				                         <li><a href="#">2</a></li>
				                         <li><a href="#">3</a></li>
				                         <li><a href="#" class="control"><span class="fa fa-caret-right"></span></a></li>
				                      </ul>
				                   </div>
				                </div>
				            </div>			            
				        </div>
			        </div>
			    </div>
			</section>
			<?php $this->load->view('common/gender-collections');?> 
			<?php $this->load->view('common/testimonials');?> 
			<?php $this->load->view('common/subscribe');?> 
			<?php $this->load->view('common/footer');?> 
		 	<!-- Back to top -->
		 	<div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
			<?php $this->load->view('common/quick-view');?> 
		</div>
      	<?php $this->load->view('common/main-search');?> 
      	<?php $this->load->view('common/common_js');?> 
   </body>
</html>