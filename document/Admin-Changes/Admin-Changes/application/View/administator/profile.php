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
            <div class="col-md-6 stretch-card">
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
            <div class="col-md-6 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Logins</h4>
                  <hr>
                  <?php $action=base_url().'administrator/profile/password';?>
                  <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>
                    <div class="form-group">
                      <label for="exampleInputName1">Old Password <span class="text-danger">*</span></label>
                      <input class="form-control" name="oldpassword" type="text"  role="presentation">
                            <?php echo '<div class="text-danger">' . form_error('oldpassword') . '</div>' ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">New Password<span class="text-danger">*</span></label>
                      <input class="form-control" name="password" type="text"  role="presentation">
                            <?php echo '<div class="text-danger">' . form_error('password') . '</div>' ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Confirm Password<span class="text-danger">*</span></label>
                      <input class="form-control" name="confirm_password" type="text"  role="presentation">
                            <?php echo '<div class="text-danger">' . form_error('confirm_password') . '</div>' ?>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success mr-2 pull-right">Update Password</button>
                  <?php echo form_close(); ?> 
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-md-6 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Contact Details</h4>
                  <hr>
                  <?php $action=base_url().'administrator/profile/contact';?>
                  <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>
                    <div class="form-group">
                      <label for="exampleInputName1">Firm Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="firm_name" name="firm_name" value="<?php echo $firm['firm_name']; ?>" placeholder="Firm Name">
                      <?php echo '<div class="text-danger">' . form_error('firm_name') . '</div>' ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Slogan <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="slogan" name="slogan" value="<?php echo $firm['slogan']; ?>" placeholder="Slogan">
                      <?php echo '<div class="text-danger">' . form_error('slogan') . '</div>' ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Address <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="address" name="address" value="<?php echo $firm['address']; ?>" placeholder="Address">
                      <?php echo '<div class="text-danger">' . form_error('address') . '</div>' ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Email address <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" id="cemail" name="cemail" value="<?php echo $firm['cemail']; ?>" placeholder="Email">
                      <?php echo '<div class="text-danger">' . form_error('cemail') . '</div>' ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Contact No <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="contactno" name="contactno" value="<?php echo $firm['contactno']; ?>" placeholder="Contact No">
                      <?php echo '<div class="text-danger">' . form_error('contactno') . '</div>' ?>
                    </div>
                    
                    <hr>
                    <button type="submit" class="btn btn-success mr-2 pull-right"><?php echo $button_value;?></button>
                  <?php echo form_close(); ?> 
                </div>
              </div>
            </div>

            <div class="col-md-6 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Social Links</h4>
                  <hr>
                  <?php $action=base_url().'administrator/profile/social';?>
                  <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>
                    <div class="form-group">
                      <label for="exampleInputName1">Facebook</label>
                      <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $firm['facebook']; ?>" placeholder="Facebook">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Twitter</label>
                      <input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo $firm['twitter']; ?>" placeholder="Twitter">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Instagram</label>
                      <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo $firm['instagram']; ?>" placeholder="Instagram">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Linkedin</label>
                      <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php echo $firm['linkedin']; ?>" placeholder="Linkedin">
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputName1">Website</label>
                      <input type="text" class="form-control" id="website" name="website" value="<?php echo $firm['website']; ?>" placeholder="Website">
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputName1">Youtube</label>
                      <input type="text" class="form-control" id="youtube" name="youtube" value="<?php echo $firm['youtube']; ?>" placeholder="Youtube">
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputName1">Pinterest</label>
                      <input type="text" class="form-control" id="pinterest" name="pinterest" value="<?php echo $firm['pinterest']; ?>" placeholder="Pinterest">
                    </div>                    
                    <hr>
                    <button type="submit" class="btn btn-success mr-2 pull-right"><?php echo $button_value;?></button>
                  <?php echo form_close(); ?> 
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
</body>
</html>