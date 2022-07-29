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
                <div class="col-xl-3">
                    <div class="account-details">
                        <p>Account</p>
                        <ul>
                            <li><?php echo ucwords($CustomerDetails['name']);?></li>
                            <li><?php echo $CustomerDetails['email'];?></li>
                            <li>
                                <?php 
                                    echo nl2br($CustomerDetails['address']);
                                    echo ",<br>";
                                    echo ucwords($CustomerDetails['city']);
                                    //echo ",<br>";
                                    //echo ucwords($CustomerDetails['state']);
                                ?>
                            </li>
                            <li>Mo.<?php echo $CustomerDetails['mobileno'];?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="account-table">
                        <h6>Order History</h6>
                        <table class="tables">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Date</th>
                                    <th>Payment Status </th>
                                    <th>Fulfillment Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#">#4545454</a>
                                    </td>
                                    <td>
                                        12-05-2017
                                    </td>
                                    <td>
                                        paid
                                    </td>
                                    <td>
                                        fullfilled
                                    </td>
                                    <td>
                                        150$
                                    </td>

                                </tr>
                                <!-- /.single product  -->
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#">#45585854</a>
                                    </td>
                                    <td>
                                        25-08-2018
                                    </td>
                                    <td>
                                        paid
                                    </td>
                                    <td>
                                        fullfilled
                                    </td>
                                    <td>
                                        180$
                                    </td>

                                </tr>
                                <!-- /.single product  -->
                            </tbody>
                        </table>

                    </div>
                    <!-- /.cart-table -->
                </div>
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