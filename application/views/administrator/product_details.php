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
    <div id="errormsg"></div>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-7 grid-margin stretch-card offset-md-2">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"><?php echo $button_value;?></h4>
                <hr>
                <?php if(isset($id) && $id!=""){

                              $action=base_url().'administrator/product/edit';

                            }else{

                              $action=base_url().'administrator/product/add';

                    } ?>
                <form action="<?php echo $action; ?>" id="myForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" onSubmit="return validate()">
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="collectiontype">Colletion Type <span class="text-danger">*</span></label>
                        <select name='collectiontype' id="collectiontype" class="form-control" onChange="GetCollectionWiseCategory(this.value);">
                          <option value=''>Select Colletion Type</option>
                          <?php foreach ($colletion as $key => $value) { ?>
                          <option <?php if($collectiontype==$value['id']){ echo 'selected'; } ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                          <?php

                              } ?>
                        </select>
                        <?php echo '<div class="text-danger">'.form_error('collectiontype').'</div>' ?> </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="categoryid">Category Name <span class="text-danger">*</span></label>
                        <select name='categoryid' id="categoryid" class="form-control">
                          <option value=''>Select Category</option>
                          <?php foreach ($category as $key => $value) { ?>
                          <option <?php if($categoryid==$value['id']){ echo 'selected'; } ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                          <?php

                              } ?>
                        </select>
                        <?php echo '<div class="text-danger">'.form_error('categoryid').'</div>' ?> </div>
                    </div>
                  </div>
                  <div class="row">
                    <!--   <div class="col-md-6">                   

                          <div class="form-group">

                            <label for="name">Product Name <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Enter Product Name">

                            <?php echo '<div class="text-danger">'.form_error('name').'</div>' ?>

                          </div>

                        </div> -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="productcode">Product Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="productcode" name="productcode" value="<?php echo $productcode; ?>" placeholder="Enter Product Code">
                        <?php echo '<div class="text-danger">'.form_error('productcode').'</div>' ?> </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="price">Price </label>
                        <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>" placeholder="Enter Price">
                        <?php echo '<div class="text-danger">'.form_error('price').'</div>' ?> </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <h4 class="card-title">Gender <span class="text-danger">*</span></h4>
                      <div class="col-md-12 mb-5">
                        <div class="form-group">
                          <?php 

                                foreach ($gender as $key => $value) { 

                              ?>
                          <div class="row">
                            <div class="chiller_cb">
                              <input id="gender<?php echo $value['id']; ?>" name="gender[]" type="checkbox"  value="<?php echo $value['name']; ?>" <?php if(isset($selectedgender)){ if(in_array($value['name'], $selectedgender)) { echo "checked"; } } ?> >
                              <label for="gender<?php echo $value['id']; ?>"><?php echo $value['name']; ?> </label>
                              <span></span> </div>
                          </div>
                          <?php

                                } 

                              ?>
                          <?php echo '<div class="text-danger">'.form_error('gender[]').'</div>' ?>
                          <div class="text-danger" id="cate_error" style="display: none;">
                            <p>Please Select Atleast One Gender.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <h4 class="card-title">Product Highlights</h4>
                      <div class="col-md-12 mb-5">
                        <div class="form-group">
                          <?php 

                                foreach ($highlights as $key => $value) { 

                              ?>
                          <div class="row">
                            <div class="chiller_cb">
                              <input id="highlights<?php echo $value['id']; ?>" name="highlights[]" type="checkbox"  value="<?php echo $value['name']; ?>" <?php if(isset($selectedhighlight)){ if(in_array($value['name'], $selectedhighlight)) {echo "checked"; } } ?>>
                              <label for="highlights<?php echo $value['id']; ?>"><?php echo $value['name']; ?> </label>
                              <span></span> </div>
                          </div>
                          <?php

                                } 

                              ?>
                          <div class="text-danger" id="cate_error" style="display: none;">
                            <p>Please Select Atleast One Highlights.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h4 class="card-title">Product Images <span class="text-danger">*</span></h4>
                      <div class="form-group mb-5">
                        <div class="row">
                          <div class="col-md-6">
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" name="image_name[]" class="file-upload-default" multiple="" >
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                              <span class="input-group-append">
                              <button class="file-upload-browse btn btn-info" type="button">Upload Photo</button>
                              </span> </div>
                          </div>
                          <div style="color:#000099;font-size:14px;"> &nbsp; &nbsp; &nbsp;Image Size  = Width : 1024 px &nbsp;&nbsp;&nbsp;&nbsp; Height : 1024 px</div>
                        </div>
                        <?php echo '<div class="text-danger">'.form_error('image_name[]').'</div>' ?> </div>
                    </div>
                  </div>
                  <div class="row">
                    <?php

                            if(!empty($image))

                            {

                              foreach ($image as $key => $value) { ?>
                    <div class="col-md-3" id="productimage<?php echo $value['id']; ?>">
                      <div class="img-wrapper text-center"> <img src="<?php echo  base_url().'uploads/product/thumbnails/'.$value['image_name']; ?>" class="img-thumbnail">
                        <div class="img-overlay text-center"> <a onClick="check_confirm_delete('<?php echo $value['id']; ?>');" href="javascript:void(0);" class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </a> </div>
                      </div>
                    </div>
                    <?php

                              }

                            }

                            else

                            {

                              $img=base_url().'uploads/book.png';

                            } 

                          ?>
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="description">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="10" id="description" name="description" placeholder="Enter Description"><?php echo $description; ?></textarea>
                    <?php echo '<div class="text-danger">'.form_error('description').'</div>' ?> </div>
                  <hr>
                  <h4 class="card-title">Extra Field </h4>
                  <div class="row"  id="extrafields">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="extrafield">Field </label>
                        <input type="text" class="form-control" id="extrafield" name="extrafield[]" placeholder="Enter Field Name ">
                        <?php echo '<div class="text-danger">'.form_error('extrafield').'</div>' ?> </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="extrafieldvalue">Value </label>
                        <input type="text" class="form-control" id="extrafieldvalue" name="extrafieldvalue[]"  placeholder="Enter Field Value">
                        <?php echo '<div class="text-danger">'.form_error('extrafieldvalue').'</div>' ?> </div>
                    </div>
                  </div>
                  <div class="row" id="addmoreextrafield">
                    <div class="col-md-12">
                      <center>
                        <button type="button" class="btn btn-info mr-2 btn-sm" onClick="AddMoreExtraField();"> <i class="fa fa-plus"></i> Add More </button>
                      </center>
                    </div>
                  </div>
                  <br>
                  <?php

                          if(!empty($extrafileds)){

                            foreach ($extrafileds as $key => $value) { 

                      ?>
                  <div class="row" id="ProductExtraFiled<?php echo $value['id']; ?>">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="extrafield">Field </label>
                        <input type="text" class="form-control" value="<?php echo $value['ename']; ?>">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="extrafieldvalue">Value </label>
                        <input type="text" class="form-control" value="<?php echo $value['evalue']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group"> <br>
                        <a onClick="check_confirm_extra_delete('<?php echo $value['id']; ?>');" href="javascript:void(0);" class="btn btn-danger mr-2"> <i class="fa fa-trash"></i> </a> </div>
                    </div>
                  </div>
                  <?php

                            }

                          }

                      ?>
                  <div class="row mt-4">
                    <div class="col-md-12"> <a href="<?php echo base_url('administrator/product');?>" class="btn btn-outline-danger">Cancel</a>
                      <button type="submit" class="btn btn-success mr-2  pull-right"><?php echo $button_value;?></button>
                    </div>
                  </div>
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
<script src="<?php echo  base_url(); ?>assest/administrator/js/general.js"></script>
<script type="text/javascript">

  function check_confirm_delete(row_id)

  {

    swal({

          title: "Delete",

          text: 'Are You Sure To Delete this Produc Image ???',

          icon: "error",

          buttons: true,

          dangerMode: true,

        })

        .then((willDelete) => {

          if (willDelete) {

            $.ajax({

              type:'POST',

              url: "<?php echo base_url() ?>"+"administrator/product/delete_product_photo/"+row_id,

              success:function()

              {

                swal("Your Product Image Delete Successfully.");

                $("#productimage"+row_id).remove();

              }

            }); 

          } else {

            //swal("Your imaginary file is safe!");

          }

        })

  }

  function check_confirm_extra_delete(row_id)

  {

    swal({

          title: "Delete",

          text: 'Are You Sure To Delete this Filed ???',

          icon: "error",

          buttons: true,

          dangerMode: true,

        })

        .then((willDelete) => {

          if (willDelete) {

            $.ajax({

              type:'POST',

              url: "<?php echo base_url() ?>"+"administrator/product/delete_product_filed/"+row_id,

              success:function()

              {

                swal("Your Product Extra Filed Delete Successfully.");

                $("#ProductExtraFiled"+row_id).remove();

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
