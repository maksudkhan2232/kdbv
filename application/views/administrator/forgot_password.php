<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo FIRM_NAME ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo  base_url(); ?>assest/administrator/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo  base_url(); ?>assest/administrator/vendors/iconfonts/puse-icons-feather/feather.css">
  <link rel="stylesheet" href="<?php echo  base_url(); ?>assest/administrator/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo  base_url(); ?>assest/administrator/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo  base_url(); ?>assest/administrator/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo  base_url(); ?>assest/administrator/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth login-full-bg">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-dark text-left p-5">
              <h2>Forgot Password</h2>
              
              <?php $this->load->view('administrator/common/errors');?> 
              <form id="loginform" class="pt-5" action="<?php echo base_url(); ?>administrator/home/reset_link" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" name="identity" id="identity" placeholder="Enter your Email" required>
                  <i class="mdi mdi-account"></i>
                  <?php echo '<div id="error_message" class="text-danger">'. form_error('identity').'</div>' ?>
                </div>
                
                <div class="mt-5">
                  <button type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium" /> Send</button></span>
                </div>
                <div class="mt-3 text-center">
                 <p>Remember your password ? <a href="<?php echo base_url(); ?>administrator/home" class="auth-link" style="color:#ff9800">Login Now</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?php echo  base_url(); ?>assest/administrator/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?php echo  base_url(); ?>assest/administrator/js/off-canvas.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/js/hoverable-collapse.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/js/misc.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/js/settings.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/js/todolist.js"></script>
  <!-- endinject -->
</body>
</html>
