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
        <div class="row d-flex justify-content-center">
          <div class="col-md-8 ">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Add SEO</h4>
                <hr>
                <?php if(isset($id) && $id!=""){
                    $action=base_url().'administrator/seo/edit';
                  }else{
                    $action=base_url().'administrator/seo/add';
                  }?>
                <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>
                <?php if($page=='Home'){ 'selected'; } ?>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <div class="form-group mb-5">
                  <label for="page">Select Page <span class="text-danger">*</span></label>
                  <select class="form-control" id="page" name="page">
                    <option value="" <?php if($page==''){ 'selected' ;} ?>>Select Page Name</option>
                    <option value="home" <?php if($page=='home'){ echo 'selected' ;} ?>>Home</option>
                    <option value="about" <?php if($page=='about'){ echo 'selected' ;} ?>>About Us</option>
                    <option value="contact" <?php if($page=='contact'){ echo 'selected' ;} ?>>Contact Us</option>
                    <option value="gallery" <?php if($page=='gallery'){ echo 'selected' ;} ?>>Gallery</option>
                    <option value="offers" <?php if($page=='offers'){ echo 'selected' ;} ?>>Offers</option>
                    <option value="shopby" <?php if($page=='shopby'){ echo 'selected' ;} ?>>Shopby</option>
                    <option value="collections" <?php if($page=='collections'){ echo 'selected' ;} ?>>Collections</option>
                    <option value="GeneralCommon" <?php if($page=='GeneralCommon'){ echo 'selected' ;} ?>>General Common Page</option>
                    <option value="privacypolicy" <?php if($page=='privacypolicy'){ echo 'selected' ;} ?>>Privacy Policy</option>
                    <option value="refundpolicy" <?php if($page=='refundpolicy'){ echo 'selected' ;} ?>>Refund Policy</option>
                    <option value="exchangepolicy" <?php if($page=='exchangepolicy'){ echo 'selected' ;} ?>>Exchange Policy</option>
                    <option value="shippingpolicy" <?php if($page=='shippingpolicy'){ echo 'selected' ;} ?>>Shipping Policy</option>
                    <?php /* ?>
                          <option value="LoginRegistration" <?php if($page=='LoginRegistration'){ echo 'selected' ;} ?>>Login / Registration</option>
                          <option value="CartPage" <?php if($page=='CartPage'){ echo 'selected' ;} ?>>Cart Page</option>
                          <option value="NotFound" <?php if($page=='NotFound'){ echo 'selected' ;} ?>>Not Found Page</option>
                          <option value="CustomerReviews" <?php if($page=='CustomerReviews'){ echo 'selected' ;} ?>>Customer Reviews</option>
                         <?php */ ?>
                  </select>
                  <?php echo '<div class="text-danger">'.form_error('page').'</div>' ?> </div>
                <div class="form-group mb-5">
                  <label for="seotitle">Title <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="seotitle" name="seotitle" value="<?php echo $seotitle; ?>" placeholder="Name">
                  <?php echo '<div class="text-danger">'.form_error('seotitle').'</div>' ?> </div>
                <div class="form-group mb-5">
                  <label for="seodescription">Description <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="seodescription" name="seodescription" placeholder="Description"><?php echo $seodescription; ?></textarea>
                  <?php echo '<div class="text-danger">'.form_error('seodescription').'</div>' ?> </div>
                <div class="form-group mb-5">
                  <label for="seokeywords">Keywords (Press Tab) <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="seokeywords" name="seokeywords" value="<?php echo $seokeywords; ?>" placeholder="For Example Gold, Sliver, About">
                  <?php echo '<div class="text-danger">'.form_error('seokeywords').'</div>' ?> </div>
                <input type="hidden" name="linkurl" id="linkurl" value="">
                <hr>
                <a href="<?php echo base_url('administrator/seo');?>" class="btn btn-outline-danger">Cancel</a>
                <button type="submit" class="btn btn-success mr-2 pull-right"><?php echo $button_value;?></button>
                <?php echo form_close(); ?> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="content-wrapper">  
        <div class="row mb-5">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">SEO Details</h4>
                <hr>
                <div class="table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                        <th>Sr No.</th>
                        <th>Page</th>
                        <th>Title</th>
                        <?php /*?><th>Description</th><?php */?>
                        <th>Keywords</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1;
                      if(!empty($viewdata)){
                      foreach($viewdata as $key=>$val)
                      {
              $img=base_url().'uploads/seo/'.$val['image'];
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td style="line-height:28px;"><?php echo strtoupper($val['page']); ?></td>
                        <td style="line-height:28px;"><?php echo $val['seotitle']; ?></td>
                        <?php /*?><td style="line-height:28px;"><?php echo $val['seodescription']; ?></td><?php */?>
                        <td style="line-height:28px;"><?php echo $val['seokeywords']; ?></td>
                        <td><?php if($val['status'] == 1){ ?>
                          <button type="button" class="btn btn-sm btn-toggle changestatus active" data-table="seo" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="1" autocomplete="off">
                          <div class="handle"></div>
                          </button>
                          <?php } else { ?>
                          <button type="button" class="btn btn-sm btn-toggle changestatus" data-table="seo" data-field="status" data-id-name="id" data-id="<?php echo $val['id'];?>" data-toggle="button" aria-pressed="0" autocomplete="off">
                          <div class="handle"></div>
                          </button>
                          <?php } ?>
                        </td>
                        <td><a href="<?php echo base_url(); ?>administrator/seo/editview/<?php echo $val['id']; ?>" class="btn btn-outline-primary mb-2">Edit</a>&nbsp;&nbsp;<a href="javascript:void(0);" onClick="check_confirm_delete('<?php echo $val['id']; ?>');" class="btn btn-outline-danger">Delete</a></td>
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
          text: 'Are You Sure To Delete this seo ?',
          icon: "error",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
              window.location.href = "<?php echo base_url() ?>"+"administrator/seo/delete/"+row_id;
          } else {
            //swal("Your imaginary file is safe!");
          }
        })
  }

  $('#seokeywords').tagsInput({
    'width': '100%',
    'interactive': true,
    'defaultText': 'Add Tages',
    'removeWithBackspace': true,
    'minChars': 0,
    'placeholderColor': '#666666'
  });

</script>
</body>
</html>