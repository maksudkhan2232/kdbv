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
                  <h4 class="card-title"><?php echo $button_value;?> Photo Gallery</h4>
                  <hr>
                  
                  <?php if(isset($id) && $id!=""){
                    	$action=base_url().'administrator/gallery/edit_photo/'.$id;
                  }else{
                   		$action=base_url().'administrator/gallery/add_photo';
                  }?>
                 <?php echo form_open_multipart($action, array('id' => 'myForm'));?>
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="old_image" value="<?php echo $image; ?>">
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
                    <input type="hidden" name="cover_image" id="cover_image" value="">
                    <div class="form-group mb-5 mt-4">
                      <label for="exampleInputName1">Gallery Images</label>
                      <div class="row">
                      <div class="col-md-6">
                        <input type="file" accept="image/x-png,image/gif,image/jpeg" id="file-uploader" name="image_name[]" class="file-upload-default" multiple="">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-info" type="button">Upload Images</button>
                          </span>
                        </div>
                        <p id="feedback"></p>
                        <br>
                      </div>
                      </div>
                      <div class="row">
                          <?php
                          if(!empty($event_detail))
                          {
                            foreach ($event_detail as $key => $value) { ?>
                              <div class="col-md-3">
                                <div class="img-wrapper text-center">
                                  <img src="<?php echo  base_url().'uploads/photo/thumb/'.$value['image_name']; ?>" class="img-thumbnail">
                                  <div class="img-overlay text-center">
                                    <a onClick="check_confirm_delete('<?php echo $value['id']; ?>');" href="javascript:void(0);" class="btn btn-sm btn-danger">
                                      <i class="fa fa-trash"></i>
                                    </a>  
                                  </div>
                                </div>
                              </div>
                            <?php
                            }
                          }
                          else
                          {
                            $img=base_url().'uploads/book.png';
                          } ?>
                     </div>
                     <?php echo '<div class="text-danger">'.form_error('image_name').'</div>' ?>
                    </div>
                    <hr>
                    <a href="<?php echo base_url('administrator/gallery/photo');?>" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" class="btn btn-success mr-2 pull-right"><?php echo $button_value;?> Photo Gallery</button>
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
          text: 'Are You Sure To Delete this Gallery Image ???',
          icon: "error",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type:'POST',
              url: "<?php echo base_url() ?>"+"administrator/gallery/delete_sub_photo/"+row_id,
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
  
  
  
    const fileUploader = document.getElementById('file-uploader');

fileUploader.addEventListener('change', (event) => {
  const files = event.target.files;
  console.log('files', files);
  
  // show the upload feedback
  const feedback = document.getElementById('feedback');
  const msg = `${files.length} file(s) uploaded successfully!`;
            feedback.innerHTML = msg;
});
	  
</script>
</body>
</html>

