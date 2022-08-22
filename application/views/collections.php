<!doctype html>
<html>
   <head>
      <!-- Meta Data -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Collections |  KD Bhindi Jewellers</title>
      <?php $this->load->view('common/common_css');?> 
   </head>
    <body id="home-version-1" class="home-version-1" data-style="default">
      	<div class="site-content">
         <?php $this->load->view('common/header');?> 
         <!-- Breadcrumb -->
         <section class="breadcrumb-area">
            <div class="container-fluid custom-container">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="bc-inner">
                        <p><a href="<?php echo base_url(); ?>">Home  |</a> Collections</p>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--=========================-->
         <?php $this->load->view('common/categories');?> 
         <section class="main-product bg-two">
            <div class="container container-two">
               <div class="section-heading">
                  <h3>Our <span>Collectons</span></h3>
               </div>
               <div class="row">
                  <div class="col-xl-12 ">
                     <div class="pro-tab-filter">
                        <div class="grid grid-three">
                        	<?php foreach ($CollectionDetails as $ckey => $cvalue) { ?>
		                        	<div class="grid-item two col-sm-12 col-md-6">
		                              <div class="sin-product style-three">
		                                 <div class="pro-img-three">
		                                    <div class="img-show">
		                                       <img src="<?php echo  base_url(); ?>uploads/collections/<?php echo $cvalue['image'];?>" alt="<?php echo ucwords($cvalue['name']);?>">
		                                    </div>
		                                    <div class="img-hover">
		                                       <a href="<?php echo  base_url(); ?>shopby/collections/<?php echo $cvalue['slug'];?>"><img src="<?php echo  base_url(); ?>uploads/collections/<?php echo $cvalue['image'];?>" alt="<?php echo ucwords($cvalue['name']);?>"></a>
		                                    </div>
		                                 </div>
		                                 <div class="mid-wrapper">
		                                    <h5 class="pro-title">
		                                    	<a href="<?php echo  base_url(); ?>shopby/collections/<?php echo $cvalue['slug'];?>">
		                                    		<?php echo ucwords($cvalue['name']);?>
		                                    	</a>
		                                    </h5>
		                                 </div>
		                              </div>
		                            </div>
	                      	<?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Container End -->
         </section>
         <?php $this->load->view('common/gender-collections');?> 
         <?php $this->load->view('common/testimonials');?> 
         <!--=========================-->
         <!--=   Subscribe area      =-->
         <?php $this->load->view('common/subscribe');?> 
         <?php $this->load->view('common/footer');?> 
         <!-- footer-widget-area -->

         <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
         
         <?php $this->load->view('common/quick-view');?> 
      </div>
      <?php $this->load->view('common/main-search');?> 
      <?php $this->load->view('common/common_js');?> 
   </body>
</html>