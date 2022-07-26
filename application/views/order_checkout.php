<!doctype html>
<html>
   <head>
      <!-- Meta Data -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Cart |  KD Bhindi Jewellers</title>
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
				            	<a href="<?php echo base_url().'order'; ?>">View Cart  |</a>
				            	Check Out
				            </p>
				         </div>
				      </div>
				   	</div>
				</div>				
			</section>
			<?php
				if(count($this->cart->contents()) > 0){
	      ?>
					<section class="contact-area">
				    	<div class="container-fluid custom-container">
				    		<div class="checkout-area section-padding">
				                <div class="container">
				                    
				                        <div class="checkout-wrap">
				                            <div class="row">
				                                <div class="col-lg-8 col-12">
				                                    <div class="caupon-wrap s1 active-border" id="loginpanel">
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
				                                          <form action="<?php echo base_url(); ?>order/registrationwithplaceorder/" id="myForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" onSubmit="return registrationwithplaceorder();">
					                                          <div class="billing-adress" id="open2">
					                                                <div class="contact-form form-style text-left" id="newuserregistrationform">
					                                                    <div class="row">
					                                                        <div class="col-lg-6 col-md-12 col-12">
					                                                            <label for="name">Name <span class="text-danger">*</span></label>
					                                                            <input type="text" placeholder="Enter Your Name." id="name" name="data[name]">
					                                                        </div>
					                                                        <div class="col-lg-12 col-md-12 col-12">
					                                                            <label for="address">Address <span class="text-danger">*</span></label>
					                                                            <input type="text" placeholder="Enter Your Name." id="address" name="data[address]">
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
																					                  echo '<option value="'.$cvalue['StateID'].'">'.ucwords($cvalue['State_Name']).'</option>';
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
					                                                            <label for="email">Password<span class="text-danger">*</span></label>
					                                                            <input type="password" placeholder="Enter Your Password."  id="password" name="data[password]">
					                                                        </div>                                                  
					                                                    </div>
					                                                </div>
					                                                <div class="biling-item-2" id="shippingaddressform">
					                                                    <input id="toggle3" type="checkbox" name="differentshipaddress" id="differentshipaddress">
					                                                    <label class="fontsize" for="toggle3">Ship to a different
					                                                        address?</label>
					                                                    <div class="billing-adress" id="open3">
					                                                        <div class="contact-form form-style">
					                                                           <div class="row text-left">
							                                                        <div class="col-lg-6 col-md-12 col-12">
							                                                            <label for="name">Name <span class="text-danger">*</span></label>
							                                                            <input type="text" placeholder="Enter Your Name." id="sdata[name]" name="name">
							                                                        </div>
							                                                        <div class="col-lg-12 col-md-12 col-12">
							                                                            <label for="address">Address <span class="text-danger">*</span></label>
							                                                            <input type="text" placeholder="Enter Your Name." id="address" name="sdata[address]">
							                                                        </div>
							                                                        <div class="col-lg-6 col-md-12 col-12">
							                                                            <label for="country">Country <span class="text-danger">*</span></label>
							                                                            <select name="sdata[country]" id="country" class="form-control">
							                                                               <option value="India" selected>India</option>
							                                                            </select>
							                                                        </div>
							                                                        <div class="col-lg-6 col-md-12 col-12">
							                                                            <label for="state">State <span class="text-danger">*</span></label>
							                                                            <select name="sdata[state]" id="state" class="form-control">
							                                                            	<option value="">Select State</option>
							                                                            	<?php
																							                foreach ($StateDetails as $skey => $svalue) {
																							                  echo '<option value="'.$cvalue['StateID'].'">'.ucwords($cvalue['State_Name']).'</option>';
																							                }
																							               ?>
							                                                            </select>
							                                                        </div>                                                  
							                                                        <div class="col-lg-6 col-md-12 col-12">
							                                                            <label for="city">City <span class="text-danger">*</span></label>
							                                                            <input type="text" placeholder="Enter Your City Name."  id="city" name="sdata[city]">
							                                                        </div>
							                                                        <div class="col-lg-6 col-md-12 col-12">
							                                                            <label for="pincode">Pincode <span class="text-danger">*</span></label>
							                                                            <input type="text" placeholder="Enter Your Pincode."  id="pincode" name="sdata[pincode]">
							                                                        </div>                                                    
							                                                        <div class="col-lg-6 col-md-12 col-12">
							                                                            <label for="mobileno">Mobile No. <span class="text-danger">*</span></label>
							                                                            <input type="text" placeholder="Enter Your Mobile No."  id="mobileno" name="sdata[mobileno]">
							                                                        </div>
							                                                        <div class="col-lg-6 col-md-12 col-12">
							                                                            <label for="email">Email Id <span class="text-danger">*</span></label>
							                                                            <input type="email" placeholder="Enter Your Email."  id="email" name="sdata[email]">
							                                                        </div>                                                  
							                                                    </div>
					                                                        </div>
					                                                    </div>
					                                                     <div class="note-area">
					                                                        <p>Order Notes </p>
					                                                        <textarea name="ordernote" id="ordernote" onblur="return orderspecialnote();" placeholder="Please Enter Note About Your Order."><?php echo $ordernote;?></textarea>
					                                                     </div>
					                                                    	<p class="form-submit m-5 text-center">
					                                                        <input value="Place Order" class="submit" type="submit">
					                                                      </p>                                                
					                                                </div>
					                                          </div>
				                                          <form>
				                                       </div>
				                                    </div>	
				                                    <div class="caupon-wrap s2"  id="shippingaddresspanel">
				                                        <div class="biling-item">
				                                            <div class="coupon coupon-3">
				                                                <label id="toggle2">Shiping Address</label>
				                                            </div>
				                                            <div class="billing-adress">
				                                                <div class="biling-item-2" id="shippingaddressform">
				                                                    <input id="toggle3" type="checkbox">
				                                                   <div class="billing-adress" id="open3">
				                                                        <div class="contact-form form-style">
				                                                           <div class="row text-left">
						                                                        <div class="col-lg-6 col-md-12 col-12">
						                                                            <label for="name">Name <span class="text-danger">*</span></label>
						                                                            <input type="text" placeholder="Enter Your Name." id="sdata[name]" name="name">
						                                                        </div>
						                                                        <div class="col-lg-12 col-md-12 col-12">
						                                                            <label for="address">Address <span class="text-danger">*</span></label>
						                                                            <input type="text" placeholder="Enter Your Name." id="address" name="sdata[address]">
						                                                        </div>
						                                                        <div class="col-lg-6 col-md-12 col-12">
						                                                            <label for="country">Country <span class="text-danger">*</span></label>
						                                                            <select name="sdata[country]" id="country" class="form-control">
						                                                               <option value="India" selected>India</option>
						                                                            </select>
						                                                        </div>
						                                                        <div class="col-lg-6 col-md-12 col-12">
						                                                            <label for="state">State <span class="text-danger">*</span></label>
						                                                            <select name="sdata[state]" id="state" class="form-control">
						                                                            	<option value="">Select State</option>
						                                                            	<?php
																						                foreach ($StateDetails as $skey => $svalue) {
																						                  echo '<option value="'.$cvalue['StateID'].'">'.ucwords($cvalue['State_Name']).'</option>';
																						                }
																						               ?>
						                                                            </select>
						                                                        </div>                                                  
						                                                        <div class="col-lg-6 col-md-12 col-12">
						                                                            <label for="city">City <span class="text-danger">*</span></label>
						                                                            <input type="text" placeholder="Enter Your City Name."  id="city" name="sdata[city]">
						                                                        </div>
						                                                        <div class="col-lg-6 col-md-12 col-12">
						                                                            <label for="pincode">Pincode <span class="text-danger">*</span></label>
						                                                            <input type="text" placeholder="Enter Your Pincode."  id="pincode" name="sdata[pincode]">
						                                                        </div>                                                    
						                                                        <div class="col-lg-6 col-md-12 col-12">
						                                                            <label for="mobileno">Mobile No. <span class="text-danger">*</span></label>
						                                                            <input type="text" placeholder="Enter Your Mobile No."  id="mobileno" name="sdata[mobileno]">
						                                                        </div>
						                                                        <div class="col-lg-6 col-md-12 col-12">
						                                                            <label for="email">Email Id <span class="text-danger">*</span></label>
						                                                            <input type="email" placeholder="Enter Your Email."  id="email" name="sdata[email]">
						                                                        </div>                                                  
						                                                    </div>
				                                                        </div>
				                                                    </div>
				                                                     <div class="note-area">
				                                                        <p>Order Notes </p>
				                                                        <textarea name="ordernote" id="ordernote" onblur="return orderspecialnote();" placeholder="Please Enter Note About Your Order."><?php echo $ordernote;?></textarea>
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
				                                            		<?php
																				if(count($this->cart->contents()) > 0){
																            ?>
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
				                          										//	<li>( + ) Eco Tax <span>100</span></li>
				                          										//	<li>( - ) Discount Price<span>100</span></li>
																		         }
																				?>
				                                            	</ul>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
				                        </div>
				                    </form>
				                </div>
				            </div>
				    	</div>
					</section>
			<?php 
					}else{
				?>
					<section class="cart-area">
						<div class="container-fluid custom-container">
							<div class="row">
								<div class="col-xl-12">
									<div class="row cart-btn-section">
										<div class="col-12 col-sm-8 col-lg-6">
											<div class="cart-btn-left">
												
												Your Cart is Empty 
											</div>
										</div>
										<div class="col-12 col-sm-4 col-lg-6">
											<div class="cart-btn-right" >
												<a href="<?php echo base_url(); ?>" style="width: 100% !important;">Continue Shopping</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				<?php 
					}
				?>
			
			
			<section class="login-now">
				<div class="container-fluid custom-container">
					<div class="col-12">
						<span>If you have any query. Please Contact Us</span>
						<a href="tel:<?php echo $WebsiteInformation['mobileno'];?>" class="btn-two">+91 <?php echo $WebsiteInformation['mobileno'];?></a>
					</div>
				</div>
			</section>
			<?php $this->load->view('common/footer');?> 
		 	<!-- Back to top -->
		 	<div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
			<?php //$this->load->view('common/quick-view');?> 
		</div>
      	<?php $this->load->view('common/main-search');?> 
      	<?php $this->load->view('common/common_js');?> 
   </body>
</html>

