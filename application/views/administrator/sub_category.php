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

                           <?php if(isset($id) && $id!=""){

                            $action=base_url().'administrator/master/edit_subcategory/'.$id;

                          }else{

                            $id=0;

                            $action=base_url().'administrator/master/add_subcategory';

                          }?>

                 <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>

                  

                    <div class="form-group">

                      <label for="exampleInputName1">Category Photo</label>

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

                          </div>







                          <?php 

                              if(isset($id) && $id!="")

                              {

                                $img=base_url().'uploads/category/'.$image;

                              }

                              else{

                                $img=base_url().'uploads/book.png';

                              }    ?>

                          <div class="form-group">

                            <label for="exampleInputName1">&nbsp;</label>

                            <a id="previewbanner_link" href="<?php echo  $img; ?>" target="_blank">

                              <img id="previewbanner1" src="<?php echo  $img; ?>" width="70">

                            </a>

                            <div style="color:#000099;font-size:14px;">Image Size  = Width : <font color="#FF0000">600 px</font> &nbsp;&nbsp;&nbsp;&nbsp; Height : <font color="#FF0000">450 px</font><br><a href="<?php echo base_url(); ?>uploads/sample/category.jpg" target="_blank">Download Sample</a></div>

                          </div>

                      </div>

                      </div>

                  

                 

                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                   <div class="row">

                    <div class="col-md-6">                   

	                    <div class="form-group">

                      <label for="exampleInputName1">Colletion Type <span class="text-danger">*</span></label>

                      <div class="row">

                        <?php foreach ($categories as $key => $value) {



                          $chk = "";

                          if(isset($collection) && in_array($value['id'], $collection) )

                          {

                            $chk="checked";

                          }

                          ?>

                          <div class="col-md-6">

                             

                            <div class="chiller_cb mb-3">

                              <input <?php echo $chk; ?> id="myCheckbox<?php echo $value['id']; ?>" type="checkbox" name="brand_id[]" value="<?php echo $value['id']; ?>">

                              <label for="myCheckbox<?php echo $value['id']; ?>" style="line-height:20px;"><?php echo $value['name']; ?></label>

                              <span></span> 

                            </div>

                          </div>

                          <?php

                        } ?>

                        <?php echo '<div class="text-danger">'.form_error('brand_id[]').'</div>' ?>

                      </div>



                    </div>

                    </div>

                    <div class="col-md-6">                                       

                    	<div class="form-group">

                      <label for="exampleInputName1">Category Name <span class="text-danger">*</span></label>

                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Enter Category Name" onChange="check_duplicate('sub_category','<?php echo $id ?>','name',this.value)">

                      <?php echo '<div class="text-danger">'.form_error('name').'</div>' ?>

                      <span class="text-danger" id="duplicate_errormsg" style="display: none;"></span>

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

                      	<th>Image</th>

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

						$img=base_url().'uploads/category/'.$val['image'];						    

					  	

                      ?>

                        <tr>

                          <td><?php echo $i; ?></td>

                          <td> <img  src="<?php echo  $img; ?>" style="border-radius:0px;width:100px;height:auto;"></td>

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

                          <td><a href="<?php echo base_url(); ?>administrator/master/edit_subcategory/<?php echo $val['id']; ?>" class="mb-2">

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

    function check_duplicate(table_name,row_id,field_name,field_value)

    {

    if(table_name != '' && field_name != '' && field_value != '')

    {

    $.ajax({

    type:'POST',

    url:'<?php echo base_url(); ?>administrator/master/check_duplicate',

    data:{'table_name':table_name,'row_id':row_id,'field_name':field_name,'field_value':field_value},

    dataType:'JSON',

    success:function(data)

    {

    if(data.error == 1)

    {

    $("#duplicate_errormsg").show();

    $("#duplicate_errormsg").text(data.msg);

    $("#btn_submit").prop('disabled',true);

    }

    else

    {

    $("#duplicate_errormsg").hide();

    $("#duplicate_errormsg").text('');

    $("#btn_submit").prop('disabled',false);

    }

    },

    });

    }

    }

    </script>

</body>

</html>