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
              <div class="col-md-4 ">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Price</h4>
                    <hr>
                    <?php if(isset($id) && $id!=""){
                    $action=base_url().'administrator/master/edit_price/'.$id;
                    }else{
                    $id=0;
                    $action=base_url().'administrator/master/add_price';
                    }?>
                    <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                   
                    <div class="form-group">
                      <label for="exampleInputName1">Title <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="name" name="name" onChange="check_duplicate('product_pricerange','<?php echo $id ?>','name',this.value)" value="<?php echo $name; ?>" placeholder="Range Title">
                      <?php echo '<div class="text-danger">'.form_error('name').'</div>' ?>
                      <span class="text-danger" id="duplicate_errormsg" style="display: none;"></span>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputName1">Min Price <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="pricemin" name="pricemin" value="<?php echo $pricemin; ?>" placeholder="Min Price">
                      <?php echo '<div class="text-danger">'.form_error('pricemin').'</div>' ?>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputName1">Max Price <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="pricemax" name="pricemax" value="<?php echo $pricemax; ?>" placeholder="Max Price">
                      <?php echo '<div class="text-danger">'.form_error('pricemax').'</div>' ?>
                    </div>

                    <hr>
                    <a href="<?php echo base_url('administrator/master/price');?>" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" id="btn_submit" class="btn btn-success mr-2 pull-right"><?php echo $button_value;?></button>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">View Price Range</h4>
                    <hr>
                    <div class="table-responsive">
                      <table id="order-listing" class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Range</th>
                            <th>Status</th>
                            <th>Actions</th>
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
                            <td><?php echo $val['name']; ?></td>
                            <td><?php echo $val['pricemin']; ?> - <?php echo $val['pricemax']; ?></td>
                            <td><?php if($val['status'] == 1){ ?>
                              <button type="button" class="btn btn-sm btn-toggle changestatus active" data-table="product_pricerange" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="1" autocomplete="off">
                              <div class="handle"></div>
                              </button>
                              <?php } else { ?>
                              <button type="button" class="btn btn-sm btn-toggle changestatus" data-table="product_pricerange" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="0" autocomplete="off">
                              <div class="handle"></div>
                              </button>
                              <?php } ?>
                            </td>
                            <td>
                              <a href="<?php echo base_url(); ?>administrator/master/edit_price/<?php echo $val['id']; ?>" class="btn btn-outline-primary">Edit</a>
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
  <