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
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card offset-md-2">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><?php echo $button_value;?> Advertisement</h4>
                    <hr>
                    <?php if(isset($id) && $id!=""){
                              $action=base_url().'administrator/advertisement/edit';
                            }else{
                              $action=base_url().'administrator/advertisement/add';
                    } ?>
                    <form action="<?php echo $action; ?>" id="myForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" onSubmit="return validate()">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                      <label for="exampleInputName1">Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Name">
                      <?php echo '<div class="text-danger">'.form_error('name').'</div>' ?>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">City <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>" placeholder="City">
                      <?php echo '<div class="text-danger">'.form_error('city').'</div>' ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Website Link</label>
                      <input type="text" class="form-control" id="weblink" name="weblink" value="<?php echo $weblink; ?>" placeholder="Website URL">
                      <?php echo '<div class="text-danger">'.form_error('weblink').'</div>' ?>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">Image</label>
                      <div class="row">
                        <div class="col-md-6">
                          <input type="file" accept="image/x-png,image/gif,image/jpeg" name="file" class="file-upload-default">
                          <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Home Logo">
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-info" type="button">Upload Photo</button>
                            </span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <?php if(isset($image) && $image != ''){
                                        $im='uploads/advertisement/'.$image;
                                        if(file_exists($im))
                                        {
                                          $img=base_url().'uploads/advertisement/'.$image;
                                        }else{
                                          $img=base_url().'uploads/book.png';
                                        }
                                    }else{
                                      $img=base_url().'uploads/book.png';
                          } ?>
                          <div class="form-group">
                            <label for="exampleInputName1">&nbsp;</label>
                            <a href="<?php echo  $img; ?>" target="_blank"><img src="<?php echo  $img; ?>" width="50"></a>
                          </div>
                          <div style="color:#000099;font-size:14px;">Image Size  = Width : 800 px &nbsp;&nbsp;&nbsp;&nbsp; Height : 800 px</div>
                        </div>
                      </div>
                    </div>
                    <h4 class="card-title">Select Category<span class="text-danger">*</span></h4>
                    <div class="col-md-6">
                      <div class="form-group">
                        <?php foreach ($ads_category as $key => $v) {
                          if(in_array($v['id'], $category)){
                            $chek= "checked";
                          }else{ $chek= ""; }
                          ?>
                          <div class="row">
                          <div class="chiller_cb">
                            <input id="myCheckbox<?php echo $v['id']; ?>" name="add_category[]" type="checkbox"  <?php echo $chek; ?> value="<?php echo $v['id']; ?>">
                            <label for="myCheckbox<?php echo $v['id']; ?>"><?php echo $v['name']; ?></label>
                            <span></span> </div>
                        </div>
                        
                        
                          
                          
                       <?php } ?>
                       <div class="text-danger" id="cate_error" style="display: none;"><p>Please Select Atleast One Category.</p></div>
                      </div>
                    </div>
                    <hr>
                    <a href="<?php echo base_url('administrator/advertisement');?>" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" class="btn btn-success mr-2 pull-right"><?php echo $button_value;?> Advertisement</button>
                    </form>
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
    <script type="text/javascript">
      function validate() {
        var sel=0;
        $('input[name="add_category[]"]').each(function(){
          if ($(this).is(':checked'))
          {
            sel = 1;  
          } 
          });
          if(sel==0){
            $("#cate_error").show();
            return false;
          }else{
            $("#cate_error").hide();
            return true;
          }
      }
    </script>
  </body>
</html>