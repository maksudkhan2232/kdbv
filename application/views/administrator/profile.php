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
          <?php $this->load->view('administrator/common/errors');?> 
          <div class="row">
            
            <div class="col-md-6 grid-margin stretch-card offset-md-3">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Profile</h4>
				          <hr>
                  <?php $action=base_url().'administrator/profile/edit';?>
                  <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>
                    <div class="form-group">
                      <label for="exampleInputName1">Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Name">
                      <?php echo '<div id="error_message">'.form_error('name').'</div>' ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Email address <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Email">
                      <?php echo '<div id="error_message">'.form_error('email').'</div>' ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Image</label>
                      <div class="row">
                      <div class="col-md-9">
                      <input type="file" name="file" class="form-control"/>
                      </div>
                      <div class="col-md-3">
                      <?php if(isset($image) && $image != ''){ 
            					  	$img=base_url().'uploads/administrator/'.$image;
            					  }else{
            					  	$img=base_url().'uploads/empty_user.png';
            					  }?>
                        <div class="form-group">
                            <label for="exampleInputName1">&nbsp;</label>
                           <img src="<?php echo $img; ?>" width="50">
                        </div>
                      </div>
                     </div>
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