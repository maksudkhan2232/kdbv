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
          <div class="col-lg-5 mx-auto">
            <div class="auth-form-dark text-left p-5">
              <h2 class="text-center" style="font-weight:bold;">
              <img src="<?php echo base_url(); ?>assest/administrator/images/logo.svg" height="auto" width="200"></h2>           
               <h2>Admin Login</h2>
              <?php $this->load->view('administrator/common/errors');?> 
              <form id="loginform" class="pt-2" action="<?php echo base_url(); ?>administrator/home/check" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" name="admin_email" id="admin_email" placeholder="Enter your Registred Email" style="padding:15px 10px;">
                  <i class="mdi mdi-account"></i>
                  <?php echo '<div id="error_message" class="text-warning">'. form_error('admin_email').'</div>' ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" placeholder="Enter your Password" name="admin_password" id="admin_password"  style="padding:15px 10px;">
                  <i class="mdi mdi-eye"></i>
                  <?php echo '<div id="error_message" class="text-warning">'. form_error('admin_password').'</div>' ?>
                </div>
                <div class="mt-5">
                  <button type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium" /> Login</button></span>
                </div>
                <div class="mt-3 text-center">
                  <a href="<?php echo base_url(); ?>administrator/home/forgot_password" class="auth-link text-white">Forgot Password ?</a>
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