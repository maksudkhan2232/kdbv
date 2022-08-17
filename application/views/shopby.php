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
					            <form action="<?php echo base_url()."search/"; ?>" id="MyProductSearchForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					            	<div class="sidebar-widget sidebar-search">
						               <input type="text" placeholder="Search Product...." name="TopSearchText" id="TopSearchText">
						               <button type="submit"><i class="fas fa-search"></i></button>
						            </div>
								   </form>
								   <input type="hidden" name="type" id="type" value="<?php echo $type;?>">
				      			<input type="hidden" name="typevalue" id="typevalue" value="<?php echo $typevalue;?>">
				      			<input type="hidden" name="filedvalue" id="filedvalue" value="<?php echo $filedvalue;?>">
					            <?php 
					            	if(!empty($GroupByCategoryDetails)){
					            ?>
					            <div class="sidebar-widget category-widget">
					               <h6>Collections / Categories</h6>
					               <ul>
					               	
					               	<?php
					               		foreach ($GroupByCategoryDetails as $ckey => $cvalue) {
					               			if($cvalue['slug']==$typevalue){
					               				$clsactive=' class="active" ';
					               			}else{
					               				$clsactive='';
					               			}
				                           echo '<li><a href="'.base_url().'shopby/category/'.$cvalue['categoryslug'].'" '.$clsactive.'>'.ucwords($cvalue['categoryname']).'</a> <span>('.$cvalue['totalrecord'].')</span></li>';
				                        }
				                     ?>
					               </ul>
					            </div>
					            <?php 
					            	}
					            ?>
					            <div class="sidebar-widget range-widget">
					               <h6>SEARCH BY PRICE</h6>
					               <div class="price-range">
					                  <div id="slider-range" onclick="return OnProductPage();"></div>
					                  <span>Price :</span>
					                  <input type="text" id="amount" readonly>
					                  <input type="hidden" id="MinPrice" name="MinPrice" value="<?php echo $ProductMinMaxPriceDetails['MinPrice'];?>">
					                  <input type="hidden" id="MaxPrice" name="MaxPrice" value="<?php echo $ProductMinMaxPriceDetails['MaxPrice'];?>">
					               </div>
					            </div>
					            <div class="sidebar-widget category-widget">
					               <h6>SEARCH BY GENDER</h6>
					               <form>
					               	<?php
					               		if(!empty($GenderDetails)){
													foreach ($GenderDetails as $gkey => $gvalue) {
				                      ?>
				                           <div class="form-group">
							                     <input type="checkbox" class="gender" id="gender<?php echo ucwords($gvalue['id']);?>" name="gender[]" value="<?php echo $gvalue['name'];?>" onClick="return OnProductPage();">
							                     <label for="gender<?php echo ucwords($gvalue['id']);?>"><?php echo ucwords($gvalue['name']);?> Collections</label>
							                  </div>
				                          
				                      <?php
				                        	}
				                        }
				                      ?>
					               </form>
					            </div>
					            <div class="sidebar-widget category-widget">
					               <h6>SEARCH BY Metal</h6>
					               <form>
					               	<?php
					               		if(!empty($GroupByCollectionDetails)){
													foreach ($GroupByCollectionDetails as $gkey => $gvalue) {
				                      ?>
				                           <div class="form-group">
							                     <input type="checkbox" name="collection[]" class="collection" id="collection<?php echo ucwords($gvalue['collectiontype']);?>" onClick="return OnProductPage();" value="<?php echo $gvalue['id'];?>">
							                     <label for="collection<?php echo ucwords($gvalue['collectiontype']);?>"><?php echo ucwords($gvalue['collectionshortname']);?></label>
							                  </div>
				                          
				                      <?php
				                        	}
				                        }
				                      ?>
					               </form>
					            </div>
					            <div class="sidebar-widget product-widget">
					               <h6>Trending Products</h6>
					               <?php
						              foreach($TrendingDetails as $tckey=>$tcval){
						            ?>
						            	<div class="wid-pro">
						                  <div class="sp-img">
						                     <img src="<?php echo base_url(); ?>uploads/product/thumbnails/<?php echo $tcval['image_name'];?>" alt="<?php echo $tcval['productcode'];?>" width="94">
						                  </div>
						                  <div class="small-pro-details">
						                     <h5 class="title"><a href="<?php echo base_url().'products/view/'.$tcval['slug'];?>"><?php echo $tcval['productcode'];?></a></h5>
						                     <span><?php echo $tcval['collectionshortname'];?> / <span><?php echo $tcval['categoryname'];?></span>
						                     <div class="rating">
						                        <a href="<?php echo base_url().'products/view/'.$tcval['slug'];?>">View Details</a>
						                     </div>
						                  </div>
						               </div>
						            <?php 
						              }
						            ?>
					            </div>
					            <div class="sidebar-widget product-widget">
					               <h6>Our Collections</h6>
					               <div class="singleProduct-slider owl-carousel owl-theme">
					               	<?php
					                    foreach ($CollectionDetails as $ckey => $cvalue) {
					                  ?>
					                     <div class="sin-instagram">
						                     <img src="<?php echo  base_url(); ?>uploads/collections/<?php echo $cvalue['image'];?>" alt="<?php echo ucwords($cvalue['name']);?>">
						                     <div class="hover-text"> <a href="<?php echo base_url(); ?>shopby/collections/<?php echo $cvalue['slug'];?>"> <span><?php echo ucwords($cvalue['shortname']);?> Jewellery</span> </a> </div>
					                  	</div>
											<?php
					                    }
					                  ?>
					               </div>
					            </div>
					            <div class="sidebar-widget banner-wid">
					               <div class="img">
					                  <img src="<?php echo base_url().'uploads/trending/'.$TrendingCollectionSideImage['image']; ?>" alt="">
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
								      <select class="orderby" name="sortby" id="sortby" onchange="return OnProductPage();">
								         <option value="">Default sorting</option>
								         <option value="popularity">Sort by popularity</option>
								         <option value="trending">Sort by trending</option>
								         <option value="newarrival">Sort by new arrival</option>
								      </select>
								   </div>
								</div>						
							</div>
				            <div class="shop-content shop-four-grid">
				                <div class="tab-content" id="myTabContent">
				                   <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				                      	<div class="row" id="ProductDetailsShow">
				                      		<?php
				                      			if(!empty($ProductDetails)){
					                      			foreach ($ProductDetails as $pkey => $pvalue) {
					                      	?>
					                      		<div class="col-sm-6 col-xl-3 popularityset" data-id="<?php echo $pvalue['id'];?>">
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
						                                  	<a href="<?php echo base_url().'products/view/'.$pvalue['slug'];?>"><?php echo $pvalue['productcode'];?></a>
						                                  </h5>
						                                  <p><?php echo ucwords($pvalue['collectionshortname']);?> / <span><?php echo ucwords($pvalue['categoryname']);?></span></p>
						                                </div>
						                               <div class="icon-wrapper">
						                                  <div class="pro-icon">
						                                     <ul>
						                                        <li><a  href="javascript:void(0);" onClick="FavoriteProducts(<?php echo $pvalue['id'];?>);" ><i class="flaticon-valentines-heart"></i></a></li>
						                                        <li><a href="javascript:void(0);" class="triggers" data-id="<?php echo $pvalue['id'];?>" id="productquickview" onClick="productquickviewnew(<?php echo $pvalue['id'];?>);"><i class="flaticon-eye"></i></a></li>
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
					                      		}else{
					                      	?>
					                      		<div class="col-sm-12 col-xl-12">
						                            <center>Product Not Found. </center>
						                        </div>
					                      	<?php
					                      		}
					                      	?>
				                      	</div>
				                   </div>
				                </div>
				                <!-- <div class="load-more-wrapper">
				                   <a href="#" class="btn-two">Load More</a>
				                </div>
				                -->
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
			<?php 
				$this->load->view('common/quick-view');
			?> 
		</div>
      	<?php $this->load->view('common/main-search');?> 
      	<?php $this->load->view('common/common_js');?> 
   </body>
</html>

<script type="text/javascript">
$("#slider-range").slider({
  range: true,
  min: 1,
  max: <?php echo $ProductMinMaxPriceDetails['MaxPrice'];?>,
  values: [1, <?php echo $ProductMinMaxPriceDetails['MaxPrice'];?>],
  slide: function(event, ui) {
    $("#amount").val("₹" + ui.values[0] + " to ₹" + ui.values[1]);
    $("#MinPrice").val(ui.values[0]);
	 $("#MaxPrice").val(ui.values[1]);
  }
});
$("#amount").val("₹" + $("#slider-range").slider("values", 0) +
        " to ₹" + $("#slider-range").slider("values", 1));




</script>
