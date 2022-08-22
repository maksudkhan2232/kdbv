<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cart |  KD Bhindi Jewellers</title>
<?php $this->load->view('common/common_css');?>

</head>
<body id="home-version-1" class="home-version-1" data-style="default">
<div class="site-content">
  <?php $this->load->view('common/header');?>
  <section class="breadcrumb-area">
    <div class="container-fluid custom-container">
      <div class="row">
        <div class="col-xl-12">
          <div class="bc-inner">
            <p> <a href="<?php echo base_url(); ?>">Home  |</a> <a href="<?php echo base_url(); ?>customer/"> All Order </a> | View Order  </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="account-area">
   <div class="container-fluid custom-container">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <div class="container mb-5 mt-3">
                     <div class="row d-flex align-items-baseline">
                        <div class="col-xl-12">
                           <p style="color: #7e8d9f;font-size: 20px;">Invoice No &gt;&gt; <strong> #ORD<?php echo $OrderDetails['OrderNo'];?></strong></p>
                        </div>
                     </div>
                     <div class="container">
                        <div class="col-md-12">
                           <div class="text-center">
                              <!-- <i class="far fa-building fa-4x ms-0" style="color:#8f8061 ;"></i> -->
                              <p class="pt-2"><a href="<?php echo base_url(); ?>"> <img src="<?php echo  base_url(); ?>assest/frontend/media/images/logo.svg" height="100" width="400" alt=""> </a></p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xl-8">
                              <ul class="list-unstyled">
                                 <li class="text-muted">To: <span style="color:#8f8061 ;"><?php echo $OrderDetails['BillingName'];?></span></li>
                                 <li class="text-muted"><?php echo ucwords($OrderDetails['BillingCity']);?></li>
                                 <li class="text-muted"><?php echo ucwords($OrderDetails['statename']);?></li>
                                 <li class="text-muted"><?php echo ucwords($OrderDetails['BillingZipCode']);?></li>
                                 <li class="text-muted"><i class="fas fa-phone"></i> <?php echo ucwords($OrderDetails['BillingPhone']);?></li>
                                 <li class="text-muted"><i class="fas fa-envelope"></i> <?php echo $OrderDetails['BillingEmail'];?></li>
                              </ul>
                           </div>
                           <div class="col-xl-4">
                              <p class="text-muted">Invoice</p>
                              <ul class="list-unstyled">
                                 <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                                    class="fw-bold">ORD No :</span><?php echo $OrderDetails['OrderNo'];?></li>
                                 <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                                    class="fw-bold">Creation Date: </span><?php echo date('M d,Y',strtotime($OrderDetails['OrderDate']));?></li>
                                 <li class="text-muted">
                                    <i class="fas fa-circle" style="color:#8f8061;"></i> 
                                    <span class="me-1 fw-bold">Status:</span>
                                    <?php 
                                      if($OrderDetails['OrderStatus']=='Received'){
                                        echo '<span class="badge bg-info text-white fw-bold">Received</span>';
                                      }
                                      if($OrderDetails['OrderStatus']=='Accepted'){
                                        echo '<span class="badge bg-info text-white fw-bold">Received</span>';
                                      }
                                      if($OrderDetails['OrderStatus']=='Preparing'){
                                        echo '<span class="badge bg-warning text-black fw-bold">Processing</span>';
                                      }
                                      if($OrderDetails['OrderStatus']=='Dispatch'){
                                        echo '<span class="badge bg-warning text-black fw-bold">Dispatch</span>';
                                      }
                                      if($OrderDetails['OrderStatus']=='Delivered'){
                                        echo '<span class="badge bg-success text-white fw-bold">Delivered</span>';
                                      }
                                      if($OrderDetails['OrderStatus']=='Cancelled'){
                                        echo '<span class="badge bg-danger text-white fw-bold">Cancelled</span>';
                                      }
                                    ?>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xl-12">
                              <div class="account-table">
                                 <h6>Order History</h6>
                                 <table class="tables">
                                    <thead>
                                       <tr>
                                          <th>Sr No</th>
                                          <th>Date</th>
                                          <th>Product Code</th>
                                          <th>Product Image</th>
                                          <th>Collection</th>
                                          <th>Category</th>
                                          <th>QTY</th>
                                          <th>Price</th>
                                          <th>Total</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        if(!empty($OrderProductDetails)){
                                          foreach ($OrderProductDetails as $key => $value) {
                                      ?>  
                                            <tr>
                                              <td><?php echo ($key+1);?></td>
                                              <td><?php echo date('d-m-Y',strtotime($OrderDetails['OrderDate']));?></td>
                                              <td><?php echo $value['products_code'];?></td>
                                              <td><img src="<?php echo base_url(); ?>uploads/product/thumbnails/<?php echo $value['image_name'];?>"
                                                 class="w-50" height="100px" alt="<?php echo ucwords($value['products_name']);?>" /></td>
                                              <td><?php echo ucwords($value['collectionshortname']);?></td>
                                              <td><?php echo ucwords($value['categoryname']);?></td>
                                              <td><?php echo ucwords($value['products_qty']);?></td>
                                              <td><?php echo ucwords($value['products_price']);?></td>
                                              <td><?php echo ucwords($value['products_total_cost']);?></td>
                                           </tr>
                                      <?php
                                          }
                                        }
                                      ?>
                                    </tbody>
                                 </table>
                              </div>                             
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-xl-8">
                              <p class="ms-3"><?php echo ucwords($OrderDetails['BillingNote']);?></p>
                           </div>
                           <div class="col-xl-3">
                              <ul class="list-unstyled">
                                 <li class="text-muted ms-3"><span class="text-black me-4">SubTotal : </span>
                                    <?php 
                                      if($OrderDetails['SubValue']!='' && $OrderDetails['SubValue']!='0'){
                                        echo '₹ '.$OrderDetails['SubValue'];
                                      }else{
                                         echo ' - ';
                                      }
                                    ?>
                                 </li>
                                 <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Shipping : </span>
                                    <?php 
                                      echo ' - ';
                                    ?>
                                 </li>
                              </ul>
                              <p class="text-black float-start">
                                <span class="text-black me-3"> Total Amount : </span>
                                <span style="font-size: 25px;">
                                    <?php 
                                      if($OrderDetails['TotalValue']!='' && $OrderDetails['TotalValue']!='0'){
                                        echo '₹ '.$OrderDetails['TotalValue'];
                                      }else{
                                         echo ' - ';
                                      }
                                    ?>
                                </span>
                              </p>
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