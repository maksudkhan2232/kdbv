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
							<p><a href="<?php echo base_url(); ?>">Home  |</a> Order Details</p>
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
                              <a href="<?php echo base_url(); ?>customer/favoriteproducts/" class="list-group-item list-group-item-action">Favorite Product</a>
                              <a href="<?php echo base_url(); ?>customer/profile/" class="list-group-item list-group-item-action active">Profile</a>
                              <a href="<?php echo base_url(); ?>customer/logout" class="list-group-item list-group-item-action">LogOut</a>
                            </div>
                        </div>
                        <!-- /.cart-subtotal -->
                    </div>
                    <!-- /.col-xl-3 -->
                    <div class="col-xl-9">
                        <section class="contact-area">
                            <div class="container-fluid custom-container">
                                <div class="checkout-area section-padding">
                                    <div class="container">                    
                                        <div class="checkout-wrap">
                                            <div class="row">
                                                <div class="col-lg-12 col-12">                 
                                                    <div class="caupon-wrap s2" id="">
                                                       <div class="biling-item">
                                                          <div class="coupon coupon-3">
                                                             <label id="toggle2">Your Profile</label>
                                                          </div>
                                                          <form action="<?php echo base_url(); ?>customer/profile/" id="myForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" onSubmit="return profile();">
                                                                <div class="billing-adress" id="">
                                                                    <div class="contact-form form-style text-left" id="newuserregistrationform">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-12">
                                                                                <label for="name">Name <span class="text-danger">*</span></label>
                                                                                <input type="text" placeholder="Enter Your Name." id="name" name="data[name]" maxlength="55" value="<?php echo $CustomerDetails['name'];?>">
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-12">
                                                                                <label for="address">Address <span class="text-danger">*</span></label>
                                                                                <input type="text" placeholder="Enter Your Address." id="address" name="data[address]" value="<?php echo $CustomerDetails['address'];?>">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                                <label for="country">Country <span class="text-danger">*</span></label>
                                                                                <select name="data[country]" id="country" class="form-control">
                                                                                   <option value="India" selected>India</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                                <label for="state">State <span class="text-danger">*</span></label>
                                                                                <select name="data[state]" id="state" class="form-control">
                                                                                    <option value="">Select State</option>
                                                                                    <?php
                                                                                    $sele='';
                                                                                    foreach ($StateDetails as $skey => $svalue) {
                                                                                        if(isset($CustomerDetails['state']) && $CustomerDetails['state']!=''){
                                                                                            if($svalue['id']==$CustomerDetails['state']){
                                                                                                $sele="selected";
                                                                                            }
                                                                                        }
                                                                                      echo '<option value="'.$svalue['id'].'" '.$sele.'>'.ucwords($svalue['name']).'</option>';
                                                                                    }
                                                                                   ?>
                                                                                </select>
                                                                            </div>                                                  
                                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                                <label for="city">City <span class="text-danger">*</span></label>
                                                                                <input type="text" placeholder="Enter Your City Name."  id="city" name="data[city]" value="<?php echo $CustomerDetails['city'];?>">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                                <label for="pincode">Pincode <span class="text-danger">*</span></label>
                                                                                <input type="text" placeholder="Enter Your Pincode."  id="pincode" name="data[pincode]" value="<?php echo $CustomerDetails['pincode'];?>">
                                                                            </div>                                                    
                                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                                <label for="mobileno">Mobile No. <span class="text-danger">*</span></label>
                                                                                <input type="text" placeholder="Enter Your Mobile No."  id="mobileno" name="data[mobileno]" value="<?php echo $CustomerDetails['mobileno'];?>">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                                <label for="email">Email Id <span class="text-danger">*</span></label>
                                                                                <input type="email" placeholder="Enter Your Email."  value="<?php echo $CustomerDetails['email'];?>" readonly>
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-12">
                                                                                <div class="col-xl-12">
                                                                                    <input type="submit" class="cart-btn" value="Update" style="background: #3f3f3f;">
                                                                                </div>
                                                                            </div>                                                  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                          <form>
                                                       </div>
                                                    </div>                                    
                                                </div>
                                                
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </section>
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