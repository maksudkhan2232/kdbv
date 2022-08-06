<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registration |  KD Bhindi Jewellers</title>
<?php $this->load->view('common/common_css');?> 
<style type="text/css">

.list-group-item.active {
    z-index: 2;
    color: #fff;
    background-color: #3f3f3f  !important;
    border-color: #3f3f3f  !important;
}

.account-details a {
  font-family: 'Work Sans', sans-serif;
  font-weight: 600;
  color: #fff;
  background: #d19e66;
  height: 50px;
  font-size: 18px;
  text-transform: uppercase;
  text-align: center;
  line-height: 50px;
  padding: 0 20px;
  margin-top: 0px !important;
}
.account-details a:hover {
  background: #3f3f3f;
  color: #fff!important;
}

</style>
</head>
<body id="home-version-1" class="home-version-1" data-style="default">
<div class="site-content">
		 <?php $this->load->view('common/header');?> 
		<!--=========================-->
		<!--=        Breadcrumb         =-->
		<!--=========================-->
		<section class="breadcrumb-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="<?php echo base_url(); ?>">Home  |</a> Favorite Product List</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>
    <!--=========================-->
    
    <section class="account-area">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <?php 
                            if($message!=''){
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <?php echo $message;?>
                            </div>
                        <?php 
                            }
                        ?>
                    </div>
                    <style type="text/css">
                        .account-details a{
                            margin-top: 20px;
                        }
                    </style>
                    <div class="col-xl-3">
                        <div class="account-details">
                            <p>
                                Account Of <?php echo ucwords($CustomerDetails['name']);?>
                            </p>
                            <div class="list-group">
                              <a href="<?php echo base_url(); ?>customer/" class="list-group-item list-group-item-action">
                                Orders
                              </a>
                              <a href="<?php echo base_url(); ?>customer/favoriteproducts/" class="list-group-item list-group-item-action active">Favorite Product</a>
                              <a href="<?php echo base_url(); ?>customer/profile/" class="list-group-item list-group-item-action">Profile</a>
                              <a href="<?php echo base_url(); ?>customer/logout" class="list-group-item list-group-item-action">LogOut</a>
                            </div>
                        </div>
                        <!-- /.cart-subtotal -->
                    </div>
                    <!-- /.col-xl-3 -->
                    <div class="col-xl-9">
                        <div class="account-table">
                            <h6>Favorite Product List</h6>
                            <table class="tables">
                                <thead>
                                    <tr>
                                        <th>Produc Code</th>
                                        <th>Product Image</th>
                                        <th>Date Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                      foreach($FavoriteProductDetails as $tckey=>$tcval){
                                    ?>              
                                        <tr id="favoriteproducts<?php echo $tcval['id'];?>">
                                            <td>
                                                <?php echo $tcval['productcode'];?>
                                            </td>
                                            <td>
                                                 <img src="<?php echo base_url(); ?>uploads/product/thumbnails/<?php echo $tcval['image_name'];?>" alt="<?php echo $tcval['productcode'];?>" width="100">
                                                
                                            </td>
                                            <td>
                                               <?php echo date('d-m-Y h:i A',strtotime($tcval['created_datetime']));?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-toggle FavoriteProductRemove active" data-table="customer_favorite_products" data-field="status" data-id-name="id" data-id="<?php echo $tcval['id'];?>" data-toggle="button" aria-pressed="1" autocomplete="off" onClick="return FavoriteProductsRemove(<?php echo $tcval['id'];?>);">
                                                  <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php 
                                      }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.cart-table -->
                    </div>
                    <!-- /.col-xl-9 -->

                </div>
            </div>
        </section>
    <section class="login-now">
        <div class="container-fluid custom-container">
            <div class="col-12">
                <span>If you have any query. Please Contact Us</span>
                <a href="tel:<?php echo $WebsiteInformation['mobileno'];?>" class="btn-two">+91 <?php echo $WebsiteInformation['mobileno'];?></a>
            </div>
        </div>
    </section>
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