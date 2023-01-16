<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('administrator/common/header-js');?>
</head>
<body>
  <div class="container-scroller">
    <?php $this->load->view('administrator/common/header');?>
    <div class="container-fluid page-body-wrapper">
      <?php $this->load->view('administrator/common/right_sidebar');?>
      <?php $this->load->view('administrator/common/sidebar');?>
      <div class="main-panel">
        <div class="content-wrapper">
          <?php $this->load->view('administrator/common/errors');?> 
          <div class="row">
            <div class="col-md-4 stretch-card mb-4">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Customer Details</h4>
                  <hr>

                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $customer['name']; ?></h5>
                       <ul class="list-group list-group-flush">
                          <li class="list-group-item"><?php echo $customer['address']; ?></li>
                          <li class="list-group-item"><?php echo $customer['city']; ?> <?php echo $customer['pincode']; ?></li>
                          <li class="list-group-item"><?php echo $customer['state_name']; ?> - <?php echo $customer['country_name']; ?></li>
                          <li class="list-group-item">Contact : <?php echo $customer['mobileno']; ?></li>
                          <li class="list-group-item">Email : <?php echo $customer['email']; ?></li>
                        </ul>
                    </div>                   
                  </div>
                   
                </div>
              </div>
            </div>
            <div class="col-md-8 stretch-card mb-4">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Customer Orders</h4>
                  <hr>
                 <div class="row">
                           <div class="col-12">
                              <div class="table-responsive">
                                 <table id="order_listing" class="table">
                                    <thead>
                                       <tr>
                                          <th>Sr No.</th>
                                          <th>Order No.</th>
                                          <th>Date Time</th>
                                          <th>Total Product</th>
                                         <?php /*?> <th>Status</th><?php */?>
                                          <th>View</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                      <?php $j=1; foreach ($orders as $key => $v) { ?>

                                        <tr>
                                          <td><?php echo $j; ?></td>  
                                          <td><?php echo $v['OrderNo']; ?></td>
                                          <td><?php echo date("d-m-Y",strtotime($v['OrderDate']))." ".date("h:i A",strtotime($v['OrderTime'])); ?></td>
                                          <td><?php echo $v['TotalProducts']; ?></td>
                                          <?php /*?><td><?php echo $v['OrderStatus']; ?></td><?php */?>
                                          <td><a href="<?php echo base_url(); ?>administrator/order/view/<?php echo $v['OrderID']; ?>" target="_blank" class="btn btn-outline-primary">View</a></td>

                                        </tr>

                                      <?php $j++; } ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                </div>
              </div>
            </div>
          </div>

        

        </div>

        <?php $this->load->view('administrator/common/footer');?>
        <!-- partial -->
      </div>
    </div>
  </div>
<?php $this->load->view('administrator/common/footer-js');?> 
 <script type="text/javascript">
            $(document).ready(function() {
              $('#order_listing').DataTable();
            });
      </script>
</body>
</html>