<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Checkout |  <?php echo $WebsiteInformation['firm_name'];?></title>
<?php $this->load->view('common/common_css');?>
<link rel="stylesheet" href="<?php echo  base_url(); ?>assest/frontend/css/font-awesome.min.css">
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
  <div class="loading style-2" style="display: none;"><div class="loading-wheel"></div></div>
<div class="site-content">
  <?php $this->load->view('common/header');?>
  <section class="breadcrumb-area">
    <div class="container-fluid custom-container">
      <div class="row">
        <div class="col-xl-12">
          <div class="bc-inner">
            <p> <a href="<?php echo base_url(); ?>">Home  |</a> <a href="<?php echo base_url().'order'; ?>">View Cart  |</a> Check Out </p>
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
                <?php  if($message!='') { ?>
                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <?php echo $message;?> </div>
                <?php  } ?>
              </div>
              <div class="col-lg-8 col-12">
                <form action="<?php echo base_url(); ?>order/placeorder/" id="myForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <div class="caupon-wrap s2"  id="shippingaddresspanel">
                    <div class="biling-item">
                      <div class="coupon coupon-3">
                        <label id="toggle2">Shiping Address</label>
                      </div>
                      <div class="billing-adress">
                        <div class="biling-item-2" id="shippingaddressform">
                          <div class="billing-adress" id="">
                            <div class="contact-form form-style">
                              <div class="row text-left">
                                <div class="col-lg-12 col-md-12 col-12">
                                  <label for="sname">Name <span class="text-danger">*</span></label>
                                  <input type="text" placeholder="Enter Your Name." name="sdata[name]" id="sname" value="<?php echo $CustomerDetails['name'];?>">
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                  <label for="saddress">Address <span class="text-danger">*</span></label>
                                  <input type="text" placeholder="Enter Your Address." id="saddress" name="sdata[address]" value="<?php echo $CustomerDetails['address'];?>">
                                </div>
                                <div class="col-lg-6 col-md-12 col-12">
                                  <label for="scountry">Country <span class="text-danger">*</span></label>
                                  <?php /*?><select name="sdata[country]" id="scountry" class="form-control">
                                    <option value="India" selected>India</option>
                                  </select><?php */?>
                                  <select name="sdata[country]" id="scountry" class="form-control" onChange="return getcountrywisestate(this.value);">
									<?php
                                        foreach ($CountryDetails as $skey => $svalue) {
                                          if($svalue['id']==$CustomerDetails['country']){
                                            $sel='selected';
                                          }else{
                                            $sel='';
                                          }
                                          echo '<option value="'.$svalue['id'].'" '.$sel.'>'.ucwords($svalue['name']).'</option>';
                                        }
                                   ?>
                                </select>
                                </div>
                                <div class="col-lg-6 col-md-12 col-12">
                                  <label for="sstate">State <span class="text-danger">*</span></label>
                                  
                                  
                                  <select name="sdata[state]" id="state" class="form-control">
                                    <option value="">Select State</option>
                                    <?php
                                    $sele='';
                                    foreach ($StateDetails as $skey => $svalue) {
                                        if(isset($CustomerDetails['state']) && $CustomerDetails['state']!=''){
                                            if($svalue['id']==$CustomerDetails['state']){
                                                $sele="selected";
                                            }else{
                                                $sele='';
                                              }
                                        }
                                        echo '<option value="'.$svalue['id'].'" '.$sele.'>'.ucwords($svalue['name']).'</option>';
                                    }
                                   ?>
                                </select>
                                  
                                </div>
                                <div class="col-lg-6 col-md-12 col-12">
                                  <label for="scity">City <span class="text-danger">*</span></label>
                                  <input type="text" placeholder="Enter Your City Name."  id="scity" name="sdata[city]" value="<?php echo $CustomerDetails['city'];?>">
                                </div>
                                <div class="col-lg-6 col-md-12 col-12">
                                  <label for="spincode">Pincode <span class="text-danger">*</span></label>
                                  <input type="text" placeholder="Enter Your Pincode."  id="spincode" name="sdata[pincode]" value="<?php echo $CustomerDetails['pincode'];?>">
                                </div>
                                <div class="col-lg-6 col-md-12 col-12">
                                  <label for="smobileno">Mobile No. <span class="text-danger">*</span></label>
                                  <input type="text" placeholder="Enter Your Mobile No."  id="smobileno" name="sdata[mobileno]" value="<?php echo $CustomerDetails['mobileno'];?>">
                                </div>
                                <div class="col-lg-6 col-md-12 col-12">
                                  <label for="semail">Email Id <span class="text-danger">*</span></label>
                                  <input type="email" placeholder="Enter Your Email."  id="semail" name="sdata[email]" value="<?php echo $CustomerDetails['email'];?>">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="note-area">
                            <p>Order Notes </p>
                            <textarea name="ordernote" id="ordernote" onBlur="return orderspecialnote();" placeholder="Please Enter Note About Your Order."><?php echo $ordernote;?></textarea>
                          </div>
                          <p class="form-submit m-5 text-center">
                            <input value="Place Order" class="submit" type="submit" id="PlaceOrder">
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
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
                      <li> <?php echo $cartvalue['options']['product_code'];?>
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
                        </span> </li>
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
        </div>
      </div>
    </div>
  </section>
  <?php  } else { ?>
  <section class="cart-area">
    <div class="container-fluid custom-container">
      <div class="row">
        <div class="col-xl-12">
          <div class="row cart-btn-section">
            <div class="col-12 col-sm-8 col-lg-6">
              <div class="cart-btn-left"> Your Cart is Empty </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-6">
              <div class="cart-btn-right" > <a href="<?php echo base_url(); ?>" style="width: 100% !important;">Continue Shopping</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php  } ?>
  <section class="login-now">
    <div class="container-fluid custom-container">
      <div class="col-12"> <span>If you have any query. Please Contact Us</span> <a href="tel:<?php echo $WebsiteInformation['mobileno'];?>" class="btn-two">+91 <?php echo $WebsiteInformation['mobileno'];?></a> </div>
    </div>
  </section>
  <?php $this->load->view('common/footer');?>
  <!-- Back to top -->
  <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
  <?php //$this->load->view('common/quick-view');?>
</div>
<?php $this->load->view('common/main-search');?>
<?php $this->load->view('common/common_js');?>

<script type="text/javascript">
  $(document).ready(function(){    
      $(".loading").attr('style',"display: none;");
  });
   $("#myForm").on('submit',function(e){
          $(".loading").attr('style',"display: block;");
       }) 
</script>
</body>
</html>
