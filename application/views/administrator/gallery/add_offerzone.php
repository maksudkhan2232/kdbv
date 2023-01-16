<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('administrator/common/header-js');?>
  <style type="text/css">
    .image-overlay-data {
    width: 100%;
    text-align: center;
    font-size: 18px;
    border-radius: 0 0 8px 8px;
    padding: 5px 0;
    background: #002173;
    position: absolute;
    color: #fff;
    bottom: 0;
}
  </style>
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
                  <h4 class="card-title"><?php echo $button_value;?> Offer</h4>
                  <hr>
                  
                  <?php if(isset($id) && $id!=""){
                    $action=base_url().'administrator/offerzone/edit_offerzone/'.$id;
                  }else{
                    $action=base_url().'administrator/offerzone/add_offerzone';
                  }?>
                 <?php echo form_open_multipart($action, array('id' => 'myForm'));?>
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="old_image" value="<?php echo $image; ?>">
                    
                    
                    
                    
                    <div class="form-group mb-3">
                        <label for="exampleInputName1">Cover Image<span class="text-danger">*</span>                        
                        </label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" id="cover_image" name="cover_image" class="file-upload-default" >
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info" type="button">Upload Photo</button>
                              </span>
                            </div>
                            <?php echo '<div class="text-danger">'.form_error('cover_image').'</div>' ?>
                          </div>
                          
                          <?php 
                              if(isset($id) && $id!="")
                              {
                                $img=base_url().'uploads/offer/'.$image;
                              }
                              else{
                                $img=base_url().'uploads/book.png';
                              } ?>
                          <div class="col-md-6"> 
                          <div class="form-group mt-3">
                            <label for="exampleInputName1">&nbsp;</label>
                            <a id="previewbanner_link" href="<?php echo  $img; ?>" target="_blank">
                              <img id="previewbanner1" src="<?php echo  $img; ?>" width="100">
                            </a>
                          </div>
                          <div style="color:#000099;font-size:14px;">
                           	 Image Size  = Width : <font color="#FF0000">900 px</font> &nbsp;&nbsp; Height : <font color="#FF0000">500 px</font>
                           
                             

                        </div>
                          </div>	
                      </div>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                      <label for="exampleInputName1">Title <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Title">
                      <?php echo '<div class="text-danger">'.form_error('name').'</div>' ?>
                    </div>
                     
                   
                    <?php if(isset($id) && $id!="")
                    {
                      $edit_image = $image;
                    }else{
                      $edit_image = "";
                    } ?>
                    <input type="hidden" name="old_cover_image" id="old_cover_image" value="<?php echo $edit_image; ?>">
                    <div class="form-group mb-5 mt-4">
                      <label for="exampleInputName1">Document</label>
                      <div class="row">
                      <div class="col-md-6">
                        <input type="file" name="image" class="file-upload-default" >
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-info" type="button">Upload Document</button>
                          </span>
                        </div><br>
                      </div>
                      </div>
                      <div class="row">
                          <?php
                          if(!empty($document))
                          {
                            ?>
                              <div class="col-md-6">
                                <div class="text-left">
                                  <div class=" text-left">
                                    <a title="View" class="btn btn-sm btn-info" href="<?php echo  base_url().'uploads/offer/'.$document; ?>" target="_blank"><i class="fa fa-eye"></i> View</a>
                                    <a  title="Delete" onClick="check_confirm_delete('<?php echo $id; ?>');" href="javascript:void(0);" class="btn btn-sm btn-danger">
                                      <i class="fa fa-trash"></i> Delete
                                    </a>  
                                  </div>
                                </div>
                              </div>
                            <?php
                           
                          }
                          else
                          {
                            $img=base_url().'uploads/book.png';
                          } ?>
                     </div>
                     <?php echo '<div class="text-danger">'.form_error('image_name').'</div>' ?>
                    </div>
                    <hr>
                    <a href="<?php echo base_url('administrator/offerzone');?>" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" class="btn btn-success mr-2 pull-right"><?php echo $button_value;?> Offer</button>
                  <?php //echo form_close(); ?> 
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
  function check_confirm_delete(row_id)
  {
    swal({
          title: "Delete",
          text: 'Are You Sure To Delete this Offer Document ???',
          icon: "error",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type:'POST',
              url: "<?php echo base_url() ?>"+"administrator/offerzone/delete_sub_photo/"+row_id,
              success:function()
              {
                location.reload();
              }
            }); 
          } else {
            //swal("Your imaginary file is safe!");
          }
        })
  }
</script>
</body>
</html>

