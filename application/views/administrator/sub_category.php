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
          <div class="row justify-content-md-center mb-5">
            <div class="col-md-8">
				<?php $this->load->view('administrator/common/errors');?> 
                 <div id="errormsg"></div>
            </div>
            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Category</h4>
                          <hr>
                   <form id="frmShopBanner" method="post" enctype="multipart/form-data" action="<?php echo base_url()."administrator/ajax_committee/savebanner"; ?>">
                      <input type="hidden" name="bannnerno" id="bannnerno" value="">
                    <div class="form-group">
                      <label for="exampleInputName1">Category Photo</label>
                      <div class="row">
                          <div class="col-md-6">
                            <input type="file" id="prodImage1" data-num="1" name="prodImage1" class="file-upload-default allbannerimg">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info" type="button">Upload Photo</button>
                              </span>
                            </div>
                          </div>
                          <?php 
                              if(isset($id) && $id!="")
                              {
                                $img=base_url().'uploads/committee/'.$photo;
                              }
                              else{
                                $img=base_url().'uploads/book.png';
                              }    ?>
                          <div class="form-group">
                            <label for="exampleInputName1">&nbsp;</label>
                            <a id="previewbanner_link" href="<?php echo  $img; ?>" target="_blank">
                              <img id="previewbanner1" src="<?php echo  $img; ?>" width="70">
                            </a>
                            <div style="color:#000099;font-size:14px;">Image Size  = Width : <font color="#FF0000">400 px</font> &nbsp;&nbsp;&nbsp;&nbsp; Height : <font color="#FF0000">300 px</font></div>
                          </div>
                      </div>
                      </div>
                  </form>       
                  <?php if(isset($id) && $id!=""){
                            $action=base_url().'administrator/committee/edit_member/'.$id;
                          }else{
                            $id=0;
                            $action=base_url().'administrator/committee/add_member';
                          }?>
                 <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="old_image" value="<?php echo $photo; ?>">
                   <?php if(isset($id) && $id!="")
                    {
                      $edit_image = $photo;
                    }else{
                      $edit_image = "";
                    } ?>
                    <input type="hidden" name="photo" id="photo" value="<?php echo $edit_image; ?>">
                    
                   
                   <div class="row">
                    <div class="col-md-6">                   
	                    <div class="form-group">
                      <label for="exampleInputName1">Colletion Type <span class="text-danger">*</span></label>
                      <select name='brand_id' id="brand_id" class="form-control">
                        <option value=''>Select Category</option>
                        <?php foreach ($categories as $key => $value) { ?>
                          
                          <option <?php if($brand_id==$value['id']){ echo 'selected'; } ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                        <?php
                        } ?>
                      </select>
                      <?php echo '<div class="text-danger">'.form_error('brand_id').'</div>' ?>
                    </div>
                    </div>
                    <div class="col-md-6">                                       
                    	<div class="form-group">
                      <label for="exampleInputName1">Category Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="designation" name="designation" value="<?php echo $designation; ?>" placeholder="Enter Category Name">
                      <?php echo '<div class="text-danger">'.form_error('designation').'</div>' ?>
                    </div>
                    </div>
                   </div> 
                    
                    
                    <a href="<?php echo base_url('administrator/master/sub_category');?>" class="btn btn-outline-danger mt-3">Cancel</a>
                    <button type="submit" id="btn_submit" class="btn btn-success mr-2 pull-right  mt-3"><?php echo $button_value;?></button>
                  <?php echo form_close(); ?> 
                </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-md-center">  
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List of Categories</h4>
                  <hr>
                  <div class="table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Photo</th>
                        <th>Colletion</th>
                        <th>Category Name</th>
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
                          <td><?php echo $val['image']; ?></td>
                          <td><?php echo $val['category_id']; ?></td>
                          <td><?php echo $val['name']; ?></td>
                          <td><?php if($val['status'] == 1){ ?>
                            <button type="button" class="btn btn-sm btn-toggle changestatus active" data-table="sub_category" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="1" autocomplete="off">
                            <div class="handle"></div>
                            </button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-sm btn-toggle changestatus" data-table="sub_category" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="0" autocomplete="off">
                            <div class="handle"></div>
                            </button>
                            <?php } ?>
                          </td>
                          <td><a href="<?php echo base_url(); ?>administrator/committee/edit_member/<?php echo $val['id']; ?>" class="mb-2">
                          <i class="fa fa-pencil"></i></a>
                          <?php /*?>&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="javascript:void(0);" onClick="check_confirm_delete('<?php echo $val['id']; ?>');"><i class="fa fa-trash text-danger"></i></a><?php */?>
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