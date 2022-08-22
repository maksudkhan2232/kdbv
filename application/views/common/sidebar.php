<div class="blog-sidebar">

							<div class="blog-widget">
								<h4 class="widget-title">Jewellery Collection</h4>
																
								<div class="singleProduct-slider owl-carousel owl-theme">
                                      
                                      <?php foreach ($CollectionDetails as $ckey => $cvalue) { ?>
                                      <div class="sin-instagram"> <img src="<?php echo  base_url(); ?>uploads/collections/<?php echo $cvalue['image'];?>" alt="">
                                        <div class="hover-text"> <a href="<?php echo base_url(); ?>shopby/collections/<?php echo $cvalue['slug'];?>"> <span><?php echo ucwords($cvalue['shortname']);?> Jewellery</span> </a> </div>
                                      </div>
                                      <?php } ?>
                                      
                                      
                                        
                                    </div>

							</div>
							<!-- /.blog-widget-->

							<div class="blog-widget">
								<h4 class="widget-title">Useful Links</h4>
								<ul class="wid-category">
									<li><a href="<?php echo base_url(); ?>">Home</a></li>
                                    <li><a href="<?php echo base_url(); ?>about">About Us</a></li>
                                    <li><a href="<?php echo base_url(); ?>collections">Collections</a></li>
                                    <li><a href="<?php echo base_url(); ?>gallery">Photo Gallery</a></li>
                                    <li><a href="<?php echo base_url(); ?>offers">Offers</a></li>
                                    <li><a href="<?php echo base_url(); ?>customer/review">Customer Reviews</a></li>
                                    <li><a href="<?php echo base_url(); ?>contact">Contact Us</a></li>
								</ul>
							</div>
							<!-- /.blog-widget-->

							<div class="sidebar-widget product-widget">
								<h6>Trending Products</h6>
								<?php
								// TRENDING COLLECTIONS SIDE IMAGE
									$myTrendingCollectionSideImage=$this->Crud_Model->getDatafromtablewheresingle('trending',array('id'=>1));	
								?>
                                
                                <div class="wid-pro">
									<div class="sp-img">
										<a href="<?php echo base_url().'shopby/trending/';?>"> 
                                          <img src="<?php echo base_url().'uploads/trending/'.$myTrendingCollectionSideImage['image']; ?>" alt="">
                                          <div class="pb-info">
                                            <p>Trending Products</p>
                                            <h6>View All</h6>
                                          </div>
                                        </a>
									</div>
									
								</div>
                                
                                

								
							</div>
							<!-- /.blog-widget-->

						</div>