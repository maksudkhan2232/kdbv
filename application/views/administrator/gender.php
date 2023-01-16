<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('administrator/common/header-js');?>
  <link rel="stylesheet" href="<?php echo  base_url(); ?>assest/administrator/summernote/dist/summernote-bs4.css">  
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
          <?php if(isset($id) && $id!=""){ ?>
          <div class="row justify-content-md-center mb-5">
            <div class="col-md-8">
              
				        <?php $this->load->view('administrator/common/errors');?> 
                 <div id="errormsg"></div>
                    </div>
                    <div class="col-md-8">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Edit Gender</h4>
                                  <hr>
                                   <?php
                                    $action=base_url().'administrator/master/edit_gender/'.$id;
                                  echo form_open_multipart($action, array('id' => 'myForm'));?>
                          
                                <div class="form-group">
                                  <label for="exampleInputName1">Gender Photo</label>
                                  <div class="row">
                                      <div class="col-md-6">
                                        <input type="file" accept="image/x-png,image/gif,image/jpeg" class="file-upload-default" name="image">
                                        <div class="input-group col-xs-12">
                                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                          <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-info" type="button">Upload Photo</button>
                                          </span>
                                        </div>
                                        <?php echo '<div class="text-danger">'.form_error('image').'</div>' ?>
                                      <?php 
                                          if(isset($id) && $id!="")
                                          {
                                            $img=base_url().'uploads/gender/'.$image;
                                          }
                                          else{
                                            $img=base_url().'uploads/book.png';
                                          }    ?>
                                      <div class="form-group">
                                        <label for="exampleInputName1">&nbsp;</label>
                                        <a id="previewbanner_link" href="<?php echo  $img; ?>" target="_blank">
                                          <img id="previewbanner1" src="<?php echo  $img; ?>" width="70">
                                        </a>
                                        <div style="color:#000099;font-size:14px;">Image Size  = Width : <font color="#FF0000">545 px</font> &nbsp;&nbsp;&nbsp;&nbsp; Height : <font color="#FF0000">369 px</font></div>
                                      </div>
                                      </div>
                                  </div>
                                </div>
                          
                         
                          <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">                           
                            <a href="<?php echo base_url('administrator/master/gender');?>" class="btn btn-outline-danger mt-3">Cancel</a>
                            <button type="submit" id="btn_submit" class="btn btn-success mr-2 pull-right  mt-3"><?php echo $button_value;?></button>
                          <?php echo form_close(); ?> 
                        </div>
                      </div>
                    </div>
          </div>
          <?php }else{ ?>
          <div class="row justify-content-md-center">  
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List of Gender</h4>
                  <hr>
                  <div class="table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1;
                      if(!empty($viewdata)){
                      foreach($viewdata as $key=>$val)
                      {
					  	
                      ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><a href="<?php echo base_url()."uploads/gender/".$val['image']; ?>" target="_blank">
                              <img src="<?php echo base_url()."uploads/gender/".$val['image']; ?>" style="width:100px;height:auto;border-radius:0;">
                            </a></td>
                          <td><?php echo $val['name']; ?></td>
                          <td><?php if($val['status'] == 1){ ?>
                            <button type="button" class="btn btn-sm btn-toggle changestatus active" data-table="gender" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="1" autocomplete="off">
                            <div class="handle"></div>
                            </button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-sm btn-toggle changestatus" data-table="gender" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="0" autocomplete="off">
                            <div class="handle"></div>
                            </button>
                            <?php } ?>
                          </td>
                          <td><a href="<?php echo base_url(); ?>administrator/master/edit_gender/<?php echo $val['id']; ?>" class="mb-2">
                          <i class="fa fa-pencil"></i></a>
                          </td>
                        </tr>
                      <?php
                      $i++;
                      } } ?>
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
          
          
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
<script src="<?php echo  base_url(); ?>assest/administrator/js/file-upload.js"></script>

</body>
</html>