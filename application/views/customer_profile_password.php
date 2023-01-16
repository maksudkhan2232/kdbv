<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reset Password | <?php echo $WebsiteInformation['firm_name'];?></title>
<?php $this->load->view('common/common_css');?> 
 <link rel="stylesheet" href="<?php echo  base_url(); ?>assest/frontend/css/font-awesome.min.css"> 
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
							<p><a href="<?php echo base_url(); ?>">Home  |</a> Reset Password</p>
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
                       
                       <?php if($this->session->flashdata('success')){ ?>
                      <div class="row justify-content-center mb-2">
                        <div class="col-lg-12">
                          <div class="alert alert-icon alert-success text-success alert-dismissible fade show" role="alert"  id="myDiv"> <i class="mdi mdi-check-all mr-2"></i> <strong>Success </strong><?php echo  $this->session->flashdata('success'); ?> </div>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($this->session->flashdata('errors')){ ?>
                      <div class="row justify-content-center mb-2">
                        <div class="col-lg-12">
                          <div class="alert alert-icon alert-danger text-danger alert-dismissible fade show" role="alert"  id="myDiv"> <i class="mdi mdi-check-all mr-2"></i> <strong>Error </strong> <?php echo  $this->session->flashdata('errors'); ?> </div>
                        </div>
                      </div>
                      <?php } ?>
                       
                    </div>
                    <style type="text/css">
                        .account-details a{
                            margin-top: 20px;
                        }
                    </style>
                    <div class="col-xl-3">
                        <div class="account-details">
                            <p>
                                Welcome <?php echo ucwords($CustomerDetails['name']);?>
                            </p>
                            <div class="list-group">
                              <a href="<?php echo base_url(); ?>customer/" class="list-group-item list-group-item-action">
                                Orders
                              </a>
                              <a href="<?php echo base_url(); ?>customer/favoriteproducts/" class="list-group-item list-group-item-action">Favorite Product</a>
                              <a href="<?php echo base_url(); ?>customer/profile/" class="list-group-item list-group-item-action">Profile</a>
                              <a href="<?php echo base_url(); ?>customer/password/" class="list-group-item list-group-item-action active">Reset Password</a>
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
                                                             <label id="toggle2">Reset Login Details</label>
                                                          </div>
                                                          <form action="<?php echo base_url(); ?>customer/password/" id="myForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" onSubmit="return profile();">
                                                        <div class="billing-adress" id="">
                                                            <div class="contact-form form-style text-left" id="newuserregistrationform">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-12 mb-2">
                                                                          <label for="name">Email Id / Username  <span class="text-danger">*</span></label>
                                                                        <input type="email" placeholder="Enter Your Email Id" value="<?php echo $CustomerDetails['email'];?>" readonly>
                                                                    </div>
                                                                    
                                                                    <div class="col-lg-6 col-md-12 col-12 mb-2">
                                                                        <label for="mobileno">New Password <span class="text-danger">*</span></label>
                                                                        <input type="text" placeholder="Enter New Password"  id="npassword" name="npassword" >  
                                                                        <?php echo '<div id="error_message" class="text-danger">'.form_error('npassword').'</div>' ?>
                                                                    </div>
                                                                    
                                                                    <div class="col-lg-6 col-md-12 col-12 mb-2">
                                                                        <label for="email">Confirm Password <span class="text-danger">*</span></label>
                                                                        <input type="text" name="cpassword" placeholder="Re Enter Password " >
                                                                        <?php echo '<div id="error_message" class="text-danger">'.form_error('cpassword').'</div>' ?>
                                                                    </div>
                                                                    <div class="col-lg-12 col-md-12 col-12 d-flex justify-content-center">
                                                                        <div class="col-xl-6 ">
                                                                            <input type="submit" class="cart-btn" value="Update" style="background: #3f3f3f;">
                                                                        </div>
                                                                    </div>                                                  
                                                                </div>
                                                            </div>
                                                        </div>
                                                          </form>
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
    <?php $this->load->view('common/inner_contact');?> 
    <?php $this->load->view('common/footer');?> 

  <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>

              <?php $this->load->view('common/quick-view');?> 

</div>
              <?php $this->load->view('common/main-search');?> 

              <?php $this->load->view('common/common_js');?> 
<script language="javascript">
setTimeout(function(){
		$('#myDiv').fadeOut(500);
		}, 5000);
</script>

</body>
</html>