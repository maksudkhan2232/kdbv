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
            <p> <a href="<?php echo base_url(); ?>">Home  |</a> View Cart </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="cart-area">
    <div class="container-fluid custom-container">
      <?php
					if(count($this->cart->contents()) > 0){
            ?>
      <div class="row">
        <div class="col-xl-9">
          <div class="cart-table">
            <div class="table-responsive">
            	<table class="tables">
              <thead>
                <tr>
                  <th></th>
                  <th>Image</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>unit price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php  foreach ($this->cart->contents() as $cartkey => $cartvalue) { ?>
                <tr id="cart<?php echo $cartvalue['rowid'];?>">
                  <td><a href="javascript:void(0);" onClick="return removetocart('<?php echo $cartvalue['rowid'];?>');">X</a> </td>
                  <td><a href="#">
                    <div class="product-image"> <img alt="<?php echo $cartvalue['options']['product_code'];?>" src="<?php echo base_url(); ?>uploads/product/thumbnails/<?php echo $cartvalue['options']['product_image'];?>" width="100"> </div>
                    </a> </td>
                  <td><div class="product-title"> <a href="#"><?php echo $cartvalue['options']['product_code'];?></a> </div></td>
                  <td><div class="quantity">
                      <input type="number" value="<?php echo $cartvalue['qty'];?>" id="quantity<?php echo $cartvalue['rowid'];?>" onChange="return updatetocart('<?php echo $cartvalue['rowid'];?>');" min="0">
                    </div></td>
                  <td><ul>
                      <li>
                        <div class="price-box"> <span class="price" id="price<?php echo $cartvalue['rowid'];?>">
                          <?php 
							if($cartvalue['price']!='' && $cartvalue['price']!='0'){
							  echo '₹ '.$cartvalue['price'];
							  echo ' X '.$cartvalue['qty'];
							}else{
								 echo ' - ';
							}
						  ?>
                          </span> </div>
                      </li>
                    </ul></td>
                  <td><div class="total-price-box"> <span class="price" id="pricetotal<?php echo $cartvalue['rowid'];?>">
                      <?php 
						if($cartvalue['price']!='' && $cartvalue['price']!='0'){
						  echo '₹ '.($cartvalue['price']*$cartvalue['qty']);
						}else{
							 echo ' - ';
						}
					  ?>
                      </span> </div></td>
                </tr>
                <?php  } ?>
              </tbody>
            </table>
            </div>
          </div>
          <div class="row cart-btn-section">
          <?php /*?>   <div class="col-12 col-sm-8 col-lg-6">
								<div class="cart-btn-left">
									<a class="coupon-code" href="#">Coupon Code</a>
									<a href="#">Apply Coupon</a>
								</div>
							</div> <?php */?>
            <div class="col-12 col-sm-12 col-lg-12">
              <div class="cart-btn-right" > <a href="<?php echo base_url(); ?>" style="width: 100% !important;">Continue Shopping</a> </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3">
          <div class="cart-subtotal">
            <p>SUBTOTAL</p>
            <ul id="cartsubtotal">
              <?php  if ($this->cart->contents()) {
					$carttotal= $this->cart->total();
					if($carttotal!='' and $carttotal!='0'){
						echo '<li><span>Sub-Total:</span>₹ '.number_format($carttotal).'</li>';    
						echo '<li><span>TOTAL:</span>₹ '.number_format($carttotal).'</li>';
					}
					//$carthtml .='<li><span>Tax (-4.00):</span>$11.00</li>';
					//$carthtml .='<li><span>Shipping Cost:</span>$00.00</li>';
				 } ?>
            </ul>
            <div class="note"> <span>Order Note :</span>
              <textarea name="ordernote" id="ordernote" onBlur="return orderspecialnote();" placeholder="Please Enter Order Special Note."><?php echo $ordernote;?></textarea>
            </div>
            <a href="<?php echo  base_url(); ?>order/checkout">Proceed To Checkout</a> </div>
        </div>
      </div>
      <?php  } else { ?>
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
      <?php  } ?>
     </div>
  </section>
  <?php $this->load->view('common/subscribe');?>
  <?php $this->load->view('common/footer');?>
  <!-- Back to top -->
  <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
  <?php //$this->load->view('common/quick-view');?>
</div>
<?php $this->load->view('common/main-search');?>
<?php $this->load->view('common/common_js');?>
</body>
</html>