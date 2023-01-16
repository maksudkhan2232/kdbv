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
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">View Product</h4>
                <a href="<?php echo base_url(); ?>administrator/product/add" class="btn btn-success mr-2 ">Add New Product</a>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div id="errormsg"></div>
                  <?php $this->load->view('administrator/common/errors');?>             
                </div>
              </div>
              <hr />
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Image</th>
                          <th>Collection</th>
                          <th>Category</th>
                          <th>Product Code</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
					          <?php 
                      $i=1; 
                      foreach($viewdata as $key=>$val){
                    ?>
                      <tr>
                      	<td><?php echo $i; ?></td>
                        <td>
                          <?php
							if($val['image_name']!='')
							{
								$im='uploads/product/'.$val['image_name'];
								if(file_exists($im))
								{
									$img=base_url().'uploads/product/'.$val['image_name'];
								}else{
									$img=base_url().'uploads/book.png';
								}
							}else{
								$img=base_url().'uploads/book.png';
							}
						 ?>
                          <img src="<?php echo $img; ?>" alt="<?php echo $val['name']; ?>"></td>
                          <td style="line-height:22px;"><?php echo $val['collectionname']; ?></td>
                          <td><?php echo $val['categoryname']; ?></td>
                          <td><?php echo $val['productcode']; ?></td>
                          <td><?php if($val['status'] == 1){ ?>
                              <button type="button" class="btn btn-sm btn-toggle changestatus active" data-table="product" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="1" autocomplete="off">
                              <div class="handle"></div>
                              </button>
                          <?php } else { ?>
                              <button type="button" class="btn btn-sm btn-toggle changestatus" data-table="product" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="0" autocomplete="off">
                              <div class="handle"></div>
                              </button>
                          <?php } ?>
                          </td>
                          <td>
                            <a href="<?php echo base_url(); ?>administrator/product/editview/<?php echo $val['id']; ?>" class="btn btn-outline-primary mb-2">Edit</a>&nbsp;&nbsp;
                            <!-- <a href="javascript:void(0);" onClick="check_confirm_delete('<?php echo $val['id']; ?>');" class="btn btn-outline-danger">Delete</a> -->
                          </td>
                      </tr>
                    <?php
					             $i++;
                      } 
                    ?>
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
<script type="text/javascript">
  function check_confirm_delete(row_id)
  {

    swal({
          title: "Delete",
          text: 'Are You Sure To Delete this Product ???',
          icon: "error",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
             
              window.location.href = "<?php echo base_url() ?>"+"administrator/product/delete_product/"+row_id;
          } else {
            //swal("Your imaginary file is safe!");
          }
        })
  }
</script>
</body>
</html>