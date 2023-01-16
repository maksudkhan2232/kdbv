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
            <div class="col-md-12">
              <div id="errormsg"></div>
              <?php $this->load->view('administrator/common/errors');?>            	
            </div>
          </div>
          <div class="row">
            
            <div class="col-md-4 ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Slider</h4>
				          <hr>
                  <?php if(isset($id) && $id!=""){
        				  	$action=base_url().'administrator/slider/edit';
        				  }else{
        				  	$action=base_url().'administrator/slider/add';
        				  }?>
                 <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    
                    <div class="form-group">
                      <label for="exampleInputName1">Slider Image <span class="text-danger">*</span></label>
                      <div class="row">
                          <div class="col-md-12">
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" name="image" class="file-upload-default" <?php if(!isset($id) || $id==""){ echo "Required"; } ?> >
                            
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info" type="button">Upload Photo</button>
                              </span>
                            </div>
                            <?php echo '<div class="text-danger">'.form_error('image').'</div>' ?>
                          </div>
                          <?php 
                              if(isset($id) && $id!="")
                              {
                                $img=base_url().'uploads/slider/'.$image;
                              }
                              else{
                                $img=base_url().'uploads/book.png';
                              }    ?>
                          
                         <div class="col-md-12">
                          <div class="form-group">
                            
                            <a id="previewbanner_link" href="<?php echo  $img; ?>" target="_blank">
                              <img id="previewbanner1" src="<?php echo  $img; ?>" style="width:75px;">
                            </a>                            
                          </div>
                          <div style="color:#000099;font-size:14px;text-align:center;">
                          Image Size  = Width : <font color="#FF0000">1920 px</font> &nbsp;&nbsp;&nbsp;&nbsp; Height : <font color="#FF0000">844 px</font><br>
                          Upload Image Type - <font color="#FF0000">JPG / JPEG</font></div>
                         </div> 
                      </div>
                      </div>
                    
                    <div class="form-group mb-5">
                      <label for="exampleInputName1">Title <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Name">
                      <?php echo '<div class="text-danger">'.form_error('name').'</div>' ?>
                    </div>
                    <?php /*?><div class="form-group">
                      <label for="exampleInputName1">Link <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="linkurl" name="linkurl" value="<?php echo $linkurl; ?>" placeholder="link url">
                      <?php echo '<div class="text-danger">'.form_error('linkurl').'</div>' ?>
                    </div><?php */?>
                    <input type="hidden" name="linkurl" id="linkurl" value="">
                    
					          <hr>
                    <a href="<?php echo base_url('administrator/dashboard');?>" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" class="btn btn-success mr-2 pull-right"><?php echo $button_value;?></button>
                  <?php echo form_close(); ?> 
                </div>
              </div>
            </div>
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View Slider</h4>
                  <hr>
                  <div class="table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Title</th>                        
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1;
                      if(!empty($viewdata)){
                      foreach($viewdata as $key=>$val)
                      {
					   $img=base_url().'uploads/slider/'.$val['image'];
                      ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td style="line-height:28px;">
                          <a  href="<?php echo  $img; ?>" target="_blank">
                              <img src="<?php echo  $img; ?>" style="border-radius:0px;width:90px;height:auto;">
                            </a>   </td>
                          <td style="line-height:28px;"><?php echo $val['title']; ?></td>
                          <td><?php if($val['status'] == 1){ ?>
                            <button type="button" class="btn btn-sm btn-toggle changestatus active" data-table="slider" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="1" autocomplete="off">
                            <div class="handle"></div>
                            </button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-sm btn-toggle changestatus" data-table="slider" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="0" autocomplete="off">
                            <div class="handle"></div>
                            </button>
                            <?php } ?>
                          </td>
                          <td><a href="<?php echo base_url(); ?>administrator/slider/editview/<?php echo $val['id']; ?>" class="btn btn-outline-primary mb-2">Edit</a>&nbsp;&nbsp;<a href="javascript:void(0);" onClick="check_confirm_delete('<?php echo $val['id']; ?>');" class="btn btn-outline-danger">Delete</a></td>
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
          text: 'Are You Sure To Delete this Slider ?',
          icon: "error",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
             
              window.location.href = "<?php echo base_url() ?>"+"administrator/slider/delete/"+row_id;
          } else {
            //swal("Your imaginary file is safe!");
          }
        })
  }
</script>
</body>
</html>