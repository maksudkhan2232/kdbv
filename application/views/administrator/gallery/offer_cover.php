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
            <div class="row d-flex justify-content-center">
              <div class="col-md-12">
                <div id="errormsg"></div>
                <?php $this->load->view('administrator/common/errors');?>
              </div>
              <div class="col-md-6 ">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">OFFER Cover Photo</h4>
                    <hr>
                    <?php 
                    $action=base_url().'administrator/offerzone/coverupdate';
                    ?>
                    <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>
                    
                    <div class="form-group">
                        <label for="exampleInputName1">Home Page Offer Cover Photo <span class="text-danger">*</span>                        
                        </label>
                        <div class="row">
                          <div class="col-md-12">
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" id="image" name="image" class="file-upload-default" >
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info" type="button">Upload Photo</button>
                              </span>
                            </div>
                            <?php echo '<div class="text-danger">'.form_error('image').'</div>' ?>
                          </div>
                          <?php $img=base_url().'uploads/offer/'.$photo; ?>
                          <div class="form-group mt-3">
                            <label for="exampleInputName1">&nbsp;</label>
                            <a id="previewbanner_link" href="<?php echo  $img; ?>" target="_blank">
                              <img id="previewbanner1" src="<?php echo  $img; ?>" width="100">
                            </a>
                          </div>
                          <div style="color:#000099;font-size:14px;text-align:center;">
                            Image Size  = Width : <font color="#FF0000">1920 px</font> &nbsp;&nbsp;&nbsp;&nbsp; Height : <font color="#FF0000">800 px</font>
                          	
                             

                        </div>
                        
                             
                       	</div>
                        
                       
                        
                        	<div class="form-group row mt-4 mb-2">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label"><b>Offer Status</b></label>
                          <div class="col-sm-9">
                            <div class="form-group">
                         <?php if($status == 1){ ?>
                              <button type="button" class="btn btn-sm btn-toggle changestatus active" data-table="offer_cover" data-field="status" data-id-name="id" data-id="1" data-toggle="button" aria-pressed="1" autocomplete="off">
                              <div class="handle"></div>
                              </button>
                              <?php } else { ?>
                              <button type="button" class="btn btn-sm btn-toggle changestatus" data-table="offer_cover" data-field="status" data-id-name="id" data-id="1" data-toggle="button" aria-pressed="0" autocomplete="off">
                              <div class="handle"></div>
                              </button>
                              <?php } ?>
                         </div>
                          </div>
                        </div>
                        
                        
                       
                        
                    </div>
                    
                    <hr>
                    
                    <button type="submit" id="btn_submit" class="btn btn-success mr-2 pull-right">Update</button>
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
    <script src="<?php echo  base_url(); ?>assest/administrator/js/file-upload.js"></script>
  
  </body>
  </html>