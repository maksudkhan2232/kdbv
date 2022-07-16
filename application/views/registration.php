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
                <form>
                    <div class="checkout-wrap">
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <div class="caupon-wrap s1">
                                    <div class="coupon coupon-active">
                                        <label id="toggle1">Already Registered. Login Now</label>
                                    </div>
                                    <div class="create-account">
                                        <div class="contact-form form-style text-left">
                                            <div class="row d-flex justify-content-center">
					                            <div class="col-lg-8 col-12">
                    		                        <form action="#">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <input type="text" placeholder="Email*">
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <input type="text" placeholder="Password*">
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <input type="submit" class="cart-btn" value="LOG IN">
                                                    </div>
                                                </div>
                                            </form>
                                           		</div>
                                            </div>     
                                        </div>
                                    </div>
                                </div>
                                <div class="caupon-wrap s2">
                                    <div class="biling-item">
                                        <div class="coupon coupon-3">
                                            <label id="toggle2">New User Register Now</label>
                                        </div>
                                        <div class="billing-adress" id="open2">
                                            <div class="contact-form form-style text-left">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <label for="fname1">First Name <span class="text-danger">*</span></label>
                                                        <input type="text" placeholder="" id="fname1" name="fname">
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <label for="fname2">Last Name <span class="text-danger">*</span></label>
                                                        <input type="text" placeholder="" id="fname2" name="fname">
                                                    </div>
                                                    
                                                    <div class="col-lg-12 col-md-12 col-12">
                                                        <label for="Adress">Address <span class="text-danger">*</span></label>
                                                        <input type="text" placeholder="" id="Adress" name="Adress">
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <label for="Country">Country <span class="text-danger">*</span></label>
                                                        <select name="address" id="Country" class="form-control">
                                                            <option disabled="" selected="">United State</option>
                                                            <option>Bangladesh</option>
                                                            <option selected>India</option>
                                                            <option>Srilanka</option>
                                                            <option>Pakisthan</option>
                                                            <option>Afgansthan</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <label for="City">State <span class="text-danger">*</span></label>
                                                        <select name="address" id="Country" class="form-control">
                                                        <option value="">Select State</option><option value="1">Andaman And Nicobar Islands</option><option value="2">Andhra Pradesh</option><option value="3">Arunachal Pradesh</option><option value="4">Assam</option><option value="5">Bihar</option><option value="6">Chandigarh</option><option value="7">Chhattisgarh</option><option value="8">Dadra And Nagar Haveli</option><option value="9">Daman And Diu</option><option value="10">Delhi</option><option value="11">Goa</option><option value="12">Gujarat</option><option value="13">Haryana</option><option value="14">Himachal Pradesh</option><option value="15">Jammu And Kashmir</option><option value="16">Jharkhand</option><option value="17">Karnataka</option><option value="18">Kenmore</option><option value="19">Kerala</option><option value="20">Lakshadweep</option><option value="21">Madhya Pradesh</option><option value="22">Maharashtra</option><option value="23">Manipur</option><option value="24">Meghalaya</option><option value="25">Mizoram</option><option value="26">Nagaland</option><option value="27">Narora</option><option value="28">Natwar</option><option value="29">Odisha</option><option value="30">Paschim Medinipur</option><option value="31">Pondicherry</option><option value="32">Punjab</option><option value="33">Rajasthan</option><option value="34">Sikkim</option><option value="35">Tamil Nadu</option><option value="36">Telangana</option><option value="37">Tripura</option><option value="38">Uttar Pradesh</option><option value="39">Uttarakhand</option><option value="40">Vaishali</option><option value="41">West Bengal</option></select>
                                                    </div>
                                                    
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <label for="email2">City <span class="text-danger">*</span></label>
                                                        <input type="text" placeholder="" id="city" name="city">
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <label for="Post2">Post Code <span class="text-danger">*</span></label>
                                                        <input type="text" placeholder="" id="Post2" name="Post">
                                                    </div>                                                    
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <label for="email2">Mobile No. <span class="text-danger">*</span></label>
                                                        <input type="text" placeholder="" id="mobile" name="mobile">
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <label for="email4">Email Id <span class="text-danger">*</span></label>
                                                        <input type="email" placeholder="" id="email" name="email">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="biling-item-2">
                                                <input id="toggle3" type="checkbox">
                                                <label class="fontsize" for="toggle3">Ship to a different
                                                    address?</label>
                                                <div class="billing-adress" id="open3">
                                                    <div class="contact-form form-style">
                                                        <div class="row text-left">
                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                <label for="fname4">First Name</label>
                                                                <input type="text" placeholder="" id="fname4"
                                                                    name="fname">
                                                            </div>
                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                <label for="fname3">Last Name</label>
                                                                <input type="text" placeholder="" id="fname3"
                                                                    name="fname">
                                                            </div>
                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                <label for="Country2">Country</label>
                                                                <select name="address" id="Country2"
                                                                    class="form-control">
                                                                    <option disabled="" selected="">United State
                                                                    </option>
                                                                    <option>Bangladesh</option>
                                                                    <option>India</option>
                                                                    <option>Srilanka</option>
                                                                    <option>Pakisthan</option>
                                                                    <option>Afgansthan</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                <label for="City2">Dristrict</label>
                                                                <input type="text" placeholder="" id="City2"
                                                                    name="City">
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-12">
                                                                <label for="Adress2">Address</label>
                                                                <input type="text" placeholder="" id="Adress2"
                                                                    name="Adress">
                                                            </div>
                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                <label for="Post">Post Code</label>
                                                                <input type="text" placeholder="" id="Post" name="Post">
                                                            </div>
                                                            <div class="col-lg-6 col-md-12 col-12">
                                                                <label for="emails">Email Adress</label>
                                                                <input type="text" placeholder="" id="emails"
                                                                    name="email">
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-12">
                                                                <label for="emaild">Phone No.</label>
                                                                <input type="text" placeholder="" id="emaild"
                                                                    name="email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="note-area">
                                                    <p>Order Notes </p>
                                                    <textarea name="massage"
                                                        placeholder="Note about your order"></textarea>
                                                </div>
                                                
                                               
                                                <p class="form-submit m-5 text-center">
                                                    <input value="Save &amp; Continue" class="submit" type="submit">
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="cout-order-area">
                                    <div class="oreder-item ">
                                        <ul>
                                            <li class="o-header">Your Order<span>( 6 )</span></li>
                                            <li>Product 1 X 1<span>50</span></li>
                                            <li>Product 2 X 1<span>50</span></li>
                                            <li>Product 3 X 2<span>100</span></li>
                                            <li>Product 4 X 1<span>50</span></li>
                                            <li class="o-middle">Product 5 X 1<span>50</span></li>
                                            <li class="s-total">Sub Total<span>400</span></li>
                                            <li>( + ) VAT<span>100</span></li>
                                            <li>( + ) Eco Tax <span>100</span></li>
                                            <li>( - ) Discount Price<span>100</span></li>
                                            <li class="o-bottom">Total price <span>500</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
				<!-- /.row end -->
			</div>
			<!-- /.container-fluid end -->
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