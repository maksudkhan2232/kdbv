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
 
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php $this->load->view('administrator/common/sidebar');?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php $this->load->view('administrator/common/errors');?> 
         
          <div class="row">
            
            <div class="col-md-6 grid-margin stretch-card offset-md-3">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Change Password</h4>
				  <hr>
                  <?php $action=base_url().'administrator/change_password'; ?>
                  <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>
                    <div class="form-group">
                      <label for="exampleInputName1">Old Password <span class="text-danger">*</span></label>
                      <input type="password" class="form-control" name="opassword" id="opassword"  placeholder="Old Password">
                      <?php echo '<div id="error_message">'.form_error('opassword').'</div>' ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">New Password <span class="text-danger">*</span></label>
                      <input type="password" class="form-control" name="npassword" id="npassword"  placeholder="New Password">
                      <?php echo '<div id="error_message">'.form_error('npassword').'</div>' ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Confirm Password <span class="text-danger">*</span></label>
                      <input type="password" class="form-control" name="cpassword" id="cpassword"   placeholder="Confirm Password">
                      <?php echo '<div id="error_message">'.form_error('cpassword').'</div>' ?>
                    </div>
					<hr>
                    <button type="submit" class="btn btn-success mr-2 pull-right"><?php echo $button_value;?></button>
                  <?php echo form_close(); ?> 
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