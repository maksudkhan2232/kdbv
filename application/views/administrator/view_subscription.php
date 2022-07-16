<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('administrator/common/header-js');?>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php $this->load->view('administrator/common/header');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php $this->load->view('administrator/common/right_sidebar');?>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php $this->load->view('administrator/common/sidebar');?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
            <div id="errormsg"></div>
            <?php $this->load->view('administrator/common/errors');?> 
         
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="card-title">View Subscription</h4>              
               <a class="pull-right btn btn-warning btn-sm" style="" href="<?php echo base_url(); ?>administrator/subscription/createexcel"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
            </div>
            <hr />
              <div class="row">
            
                <div class="col-12">
                
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Email</th>
                          <th>Date</th>
                      </tr>
                    </thead>
                    
                    <tbody>
					          <?php $i=1; foreach($viewdata as $key=>$val)
                    {
                    ?>
                      <tr>
                      	<td><?php echo $i; ?></td>                        
                        <td><?php echo $val['email']; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($val['created_at'])) ; ?></td>
                      </tr>
                    <?php
					           $i++;
                    } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php $this->load->view('administrator/common/footer');?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
<?php $this->load->view('administrator/common/footer-js');?> 
</body>
</html>