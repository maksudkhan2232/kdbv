<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registration |  KD Bhindi Jewellers</title>
<?php $this->load->view('common/common_css');?> 
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
							<p><a href="<?php echo base_url(); ?>">Home  |</a> Register Now</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>
  <!--=========================-->
     
    <section class="contact-area">
        <div class="container-fluid custom-container">
            <div class="checkout-area section-padding">
                <div class="container">                    
                        <div class="checkout-wrap">
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
                                <?php
                                if(count($this->cart->contents()) > 0){
                                ?>
                                <div class="col-lg-8 col-12">
                                <?php 
                                    }else{
                                ?>
                                <div class="col-lg-12 col-12">
                                <?php
                                    }
                                ?>
                                    <div class="caupon-wrap s1 active-border" id="loginpanel">
                                        <div class="coupon coupon-active">
                                            <label id="toggle1">Already Registered. Login Now</label>
                                        </div>
                                        <div class="create-account">
                                            <div class="contact-form form-style text-left">
                                                <div class="row d-flex justify-content-center">
                                                        <div class="col-lg-8 col-12">
                                                        <form action="<?php echo base_url(); ?>customer/login/" id="LoginForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" onSubmit="return login();">
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <input type="email" placeholder="Enter Your Email."  id="email" name="email">
                                                                </div>
                                                                <div class="col-xl-12">
                                                                    <input type="text" placeholder="Enter Your Password*" id="passwords" name="password">
                                                                </div>
                                                                <div class="col-xl-12">
                                                                    <input type="submit" class="cart-btn" value="LOG IN">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-lg-12 col-12">
                                                        <div class="login-now">
                                                            <div class="container-fluid custom-container">
                                                                <div class="col-lg-12 col-12">
                                                                    <span>Dont have account</span>
                                                                    <a href="javascript:void(0)" class="btn-two" id="opencreateaccount">Create Account</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caupon-wrap s2" id="newregisterpanel">
                                       <div class="biling-item">
                                          <div class="coupon coupon-3">
                                             <label id="toggle2">New User Register Now</label>
                                          </div>
                                          <form action="<?php echo base_url(); ?>customer/registration/" id="myForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" onSubmit="return registration();">
                                                <div class="billing-adress" id="open2">
                                                    <div class="contact-form form-style text-left" id="newuserregistrationform">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-12">
                                                                <label for="name">Name <span class="text-danger">*</span></label>
                                                                <input type="text" placeholder="Enter Your Name." id="name" name="data[name]" maxlength="55">
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-12">
                                                                <label for="address">Address <span class="text-danger">*</span></label>
                                                                <input type="text" placeholder="Enter Your Address." id="address" name="data[address]">
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
                                                                        foreach ($StateDetails as $skey => $svalue) {
                                                                          echo '<option value="'.$svalue['id'].'">'.ucwords($svalue['name']).'</option>';
                                                                        }
                                                                   ?>
                                                                </select>
                                                            </div>                                                  
                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                <label for="city">City <span class="text-danger">*</span></label>
                                                                <input type="text" placeholder="Enter Your City Name."  id="city" name="data[city]">
                                                            </div>
                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                <label for="pincode">Pincode <span class="text-danger">*</span></label>
                                                                <input type="text" placeholder="Enter Your Pincode."  id="pincode" name="data[pincode]">
                                                            </div>                                                    
                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                <label for="mobileno">Mobile No. <span class="text-danger">*</span></label>
                                                                <input type="text" placeholder="Enter Your Mobile No."  id="mobileno" name="data[mobileno]">
                                                            </div>
                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                <label for="email">Email Id <span class="text-danger">*</span></label>
                                                                <input type="email" placeholder="Enter Your Email."  id="email" name="data[email]">
                                                            </div>
                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                <label for="password">Password<span class="text-danger">*</span></label>
                                                                <input type="password" placeholder="Enter Your Password."  id="password" name="data[password]">
                                                            </div>  
                                                            <div class="col-lg-12 col-md-12 col-12">
                                                                <div class="col-xl-12">
                                                                    <input type="submit" class="cart-btn" value="Save & Continue" style="background: #3f3f3f;">
                                                                </div>
                                                            </div>                                                  
                                                        </div>
                                                    </div>
                                                </div>
                                          <form>
                                       </div>
                                    </div>                                    
                                </div>
                                <?php
                                    if(count($this->cart->contents()) > 0){
                                ?>
                                <div class="col-lg-4 col-12">
                                    <div class="cout-order-area">
                                        <div class="oreder-item ">
                                            <ul>
                                                <li class="o-header">Your Order<span>( <?php echo count($this->cart->contents());?> )</span></li>
                                                <?php 
                                                    foreach ($this->cart->contents() as $cartkey => $cartvalue) {
                                                ?>
                                                        <li>
                                                            <?php echo $cartvalue['options']['product_code'];?> 
                                                            <?php 
                                                                if($cartvalue['price']!='' && $cartvalue['price']!='0'){
                                                                  echo '₹ '.$cartvalue['price'];
                                                                  echo ' X '.$cartvalue['qty'];
                                                                }else{
                                                                     echo $cartvalue['qty'];
                                                                }
                                                            ?> 
                                                            <span>
                                                            <?php 
                                                                if($cartvalue['price']!='' && $cartvalue['price']!='0'){
                                                                  echo '₹ '.($cartvalue['price']*$cartvalue['qty']);
                                                                }else{
                                                                     echo ' - ';
                                                                }
                                                            ?> 
                                                            </span>
                                                        </li>
                                                <?php 
                                                        }
                                                ?>
                                                <?php 
                                                    if ($this->cart->contents()) {
                                                        $carttotal= $this->cart->total();
                                                        if($carttotal!='' and $carttotal!='0'){
                                                            echo '<li class="s-total">Sub Total <span>₹ '.number_format($carttotal).'</span></li>';    
                                                            echo '<li class="o-bottom">TOTAL: <span>₹ '.number_format($carttotal).'</span></li>';
                                                        }
                                                        // <li>( + ) VAT<span>100</span></li>
                                                        //  <li>( + ) Eco Tax <span>100</span></li>
                                                        //  <li>( - ) Discount Price<span>100</span></li>
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <section class="login-now">
			<div class="container-fluid custom-container">
				<div class="col-12">
					<span>If you have any query. Please Contact Us</span>
					<a href="javascript:void(0);" class="btn-two">+91 9999988888</a>
				</div>
				<!-- /.col-12 -->
			</div>
			<!-- /.container-fluid -->
		</section>


  <!--=========================-->
  <!--=   Subscribe area      =-->
    
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