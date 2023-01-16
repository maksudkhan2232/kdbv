<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard |  <?php echo $WebsiteInformation['firm_name'];?></title>
<?php $this->load->view('common/common_css');?>
<style type="text/css">
.list-group-item.active {
  z-index: 2;
  color: #fff;
  background-color: #3f3f3f !important;
  border-color: #3f3f3f !important;
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
            <p><a href="<?php echo base_url(); ?>">Home  |</a> Dashboard</p>
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
          <?php if($message!=''){ ?>
          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <?php echo $message;?> </div>
          <?php  } ?>
        </div>
        <style type="text/css">
      .account-details a{
        margin-top: 20px;
      }
    </style>
        <div class="col-xl-3">
          <div class="account-details">
            <p> Welcome <?php echo ucwords($CustomerDetails['name']);?> </p>
            <div class="list-group"> 
            <a href="<?php echo base_url(); ?>customer/" class="list-group-item list-group-item-action active"> Orders </a> 
            <a href="<?php echo base_url(); ?>customer/favoriteproducts/" class="list-group-item list-group-item-action">Favorite Product</a> 
            <a href="<?php echo base_url(); ?>customer/profile/" class="list-group-item list-group-item-action">Profile</a> 
            <a href="<?php echo base_url(); ?>customer/password/" class="list-group-item list-group-item-action">Reset Password</a>
            <a href="<?php echo base_url(); ?>customer/logout" class="list-group-item list-group-item-action">LogOut</a> </div>
          </div>
          <!-- /.cart-subtotal -->
        </div>
        <!-- /.col-xl-3 -->
        <div class="col-xl-9">
          <div class="account-table">
            <div class="section-heading">
              <h3>Order <span> History</span></h3>
            </div>
            <table class="tables">
              <thead>
                <tr>
                  <th>Order No</th>
                  <th>Inquiry Date</th>
                   <th>Detail</th>
                  <?php /*?><th>Total Product</th>
                  <th>Fulfillment Status</th>
                  <th>Total</th><?php */?>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if(!empty($GetOrderDetails)){
                    foreach($GetOrderDetails as $tckey=>$tcval){ ?>
                      <tr>
                        <td><a href="<?php echo base_url(); ?>customer/orderview/<?php echo $tcval['OrderID'];?>">#ORD<?php echo $tcval['OrderNo'];?></a> </td>
                        <td><?php echo date('d-m-Y',strtotime($tcval['OrderDate']));?> </td>
                        <td><a href="<?php echo base_url(); ?>customer/orderview/<?php echo $tcval['OrderID'];?>" class="btn btn-outline-dark">View</a></td>
                        <?php /*?><td><?php echo $tcval['TotalProducts'];?> </td>
                        <td>
                            <?php echo $tcval['OrderStatus'];?>
                            <?php                                                 
                              if($tcval['Remark']!='0' AND $tcval['Remark']!=''){
                                echo "<br>";
                                echo nl2br($tcval['Remark']);
                              }   
                            ?>
                        </td>
                        <td>
                          <?php 
                            if($tcval['TotalValue']!='0' AND $tcval['TotalValue']!=''){
                              echo '₹. '.$tcval['TotalValue'];
                            }else{
                              echo ' - ';
                            }                                                  
                          ?>
                        </td><?php */?>
                      </tr>
                <?php  
                    }
                  }else{
                ?>
                <tr>
                  <td colspan="3">You haven't any order yet.</td>
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
  <?php $this->load->view('common/inner_contact');?>
  <?php $this->load->view('common/footer');?>
  <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
  <?php $this->load->view('common/quick-view');?>
</div>
<?php $this->load->view('common/main-search');?>
<?php $this->load->view('common/common_js');?>
</body>
</html>