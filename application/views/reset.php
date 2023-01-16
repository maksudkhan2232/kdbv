<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password |  KD Bhindi Jewellers</title>
    <?php $this->load->view('common/common_css');?>
    <link rel="stylesheet" href="<?php echo  base_url(); ?>assest/frontend/css/font-awesome.min.css">
    <?php /*?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><?php */?>
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
                <p><a href="<?php echo base_url(); ?>">Home  |</a> Reset Password</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="contact-area">
        <div class="container-fluid custom-container">
          <div class="checkout-area section-padding">
            <div class="container">
              <div class="checkout-wrap">
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
                    <div class="caupon-wrap s1 active-border" id="loginpanel">
                      <div class="coupon coupon-active">
                        <label id="toggle1">Reset Password</label>
                      </div>
                      <div class="create-account">
                        <div class="contact-form form-style text-left">
                          <div class="row d-flex justify-content-center">
                            <div class="col-lg-8 col-12">
                              <form action="<?php echo base_url(); ?>customer/reset/" id="LoginForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" onSubmit="return login();">
                                <div class="row">
                                  <div class="col-xl-12">
                                    <input type="email" placeholder="Enter Your Registered Email"  id="email" name="email">
                                  </div>
                                  <div class="col-xl-12">
                                    <input type="submit" class="cart-btn" value="Reset">
                                  </div>
                                  <div class="col-md-12 text-right mb-2"><a href="<?php echo base_url(); ?>customer"  style="color:#d29e6c">Login Now</a></div>
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
              </div>
            </div>
          </div>
        </section>
        <?php $this->load->view('common/inner_contact.php');?>
        <?php $this->load->view('common/footer');?>
        <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
        <?php $this->load->view('common/quick-view');?>
   </div>
      <?php $this->load->view('common/main-search');?>
      <?php $this->load->view('common/common_js');?>
      <script type="text/javascript">
	   $(document).ready(function(){    
			$(".loading").attr('style',"display: none;");
		});
		 $("#LoginForm").on('submit',function(e){		 
       var eid = $("#email").val();
        if(eid!="")
        {
			    $(".loading").attr('style',"display: block;");
        }
		 })	
		
		setTimeout(function(){
		$('#myDiv').fadeOut(500);
		}, 5000);

     
      </script>
    </body>
  </html>