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
                  <form id="frmShopBanner" method="post" enctype="multipart/form-data" action="<?php echo base_url()."administrator/ajax_banner/savebanner"; ?>">
                      <input type="hidden" name="bannnerno" id="bannnerno" value="">
                    <div class="form-group">
                      <label for="exampleInputName1">Cover Image</label>
                      <div class="row">
                          <div class="col-md-6">
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" id="prodImage1" data-num="1" name="prodImage1" class="file-upload-default allbannerimg">
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
                                $img=base_url().'uploads/offer/'.$image;
                              }
                              else{
                                $img=base_url().'uploads/book.png';
                              } ?>
                          <div class="form-group">
                            <label for="exampleInputName1">&nbsp;</label>
                            <a id="previewbanner_link" href="<?php echo  $img; ?>" target="_blank">
                              <img id="previewbanner1" src="<?php echo  $img; ?>" width="70">
                            </a>
                            <div style="color:#000099;font-size:14px;">Image Size  = Width : 900 px &nbsp;&nbsp;&nbsp;&nbsp; Height : 500 px</div>
                          </div>
                      </div>
                      </div>
                  </form>
                  <?php if(isset($id) && $id!=""){
                    $action=base_url().'administrator/offerzone/edit_offerzone/'.$id;
                  }else{
                    $action=base_url().'administrator/offerzone/add_offerzone';
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
                    <input type="hidden" name="cover_image" id="cover_image" value="<?php echo $edit_image; ?>">
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
                              <div class="col-md-3">
                                <div class="text-center">
                                  <div class=" text-center">
                                    <a title="View" class="btn btn-sm btn-info" href="<?php echo  base_url().'uploads/offer/'.$document; ?>" target="_blank"><i class="fa fa-eye"></i></a>
                                    <a  title="Delete" onClick="check_confirm_delete('<?php echo $id; ?>');" href="javascript:void(0);" class="btn btn-sm btn-danger">
                                      <i class="fa fa-trash"></i>
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

<script src="<?php echo  base_url(); ?>assest/cropper/cropper.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo  base_url(); ?>assest/cropper/cropper.css">

  <script type="text/javascript">
    $('.allbannerimg').on('change', function() {
      datanum = $(this).attr("data-num");
      $("#bannnerno").val(datanum);
      $('#bannerimage_name').val('');
      $("#banner-preview-profile-pic").html('');
      $('#bannerx').val(1);
      $('#bannery').val(1);
      $('#bannerw').val(900);
      $('#bannerh').val(500);
      $('#banner_pic_modal').modal({show:true});
      $("#frmShopBanner").ajaxForm(
      {
        target: '#banner-preview-profile-pic',
        success: function(response) {
            var $image = $('#bannerphoto');
            var $dataX = 1;//$('#dataX');
            var $dataY = 1;//$('#dataY');
            var $dataHeight = 500;//$('#dataHeight');
            var $dataWidth = 900;//$('#dataWidth');
            var $dataRotate = 0;//$('#dataRotate');
            var $dataScaleX = 1;//$('#dataScaleX');
            var $dataScaleY = 1;//$('#dataScaleY');
            var options = {
              cropBoxResizable: false,
               // aspectRatio: 3 / 1,
                fillColor: "#fff",
                dragMode: 'none',
                data: {
                  x: 1,
                  y: 1,
                  width: 900,
                  height: 500,
              },
                crop: function (e) {
                  $('#bannerx').val(Math.round(e.detail.x));
                  $('#bannery').val(Math.round(e.detail.y));
                  $('#bannerw').val(Math.round(e.detail.height));
                  $('#bannerh').val(Math.round(e.detail.height));
                }
              };
            // Cropper
            $image.on({
              ready: function (e) {
                //console.log(e.type);
              },
              cropstart: function (e) {
                //console.log(e.type, e.detail.action);
              },
              cropmove: function (e) {
                //console.log(e.type, e.detail.action);
              },
              cropend: function (e) {
                //console.log(e.type, e.detail.action);
              },
              crop: function (e) {
                //console.log(e.type);
              },
              zoom: function (e) {
                //console.log(e.type, e.detail.ratio);
              }
            }).cropper(options);
            $(".product-loading").css("display", "none");
            $('#bannerimage_name').val($('#bannerphoto').attr('file-name'));
        }
      }).submit();
    });
  function zoomplusbanner() {
    $("#bannerphoto").cropper("zoom", 0.1);
  }
  function zoomminusbanner() {
    $("#bannerphoto").cropper("zoom", -0.1);
  }
  function rotateleftbanner() {
    $("#bannerphoto").cropper("rotate", -45);
  }
  function rotaterightbanner() {
    $("#bannerphoto").cropper("rotate", 45);
  }

function savecropbanner() {
    params = {
      targetUrl: '<?php echo base_url()."administrator/ajax_banner/bannerimagetempoffer"; ?>',
      action: 'bannerimagetempoffer',
      x: $('#bannerx').val(),
      y: $('#bannery').val(),
      w: $('#bannerw').val(),
      h: $('#bannerh').val()
    };
    CropBanner(params);
}

function CropBanner(params) {
    var cropcanvas = $('#bannerphoto').cropper('getCroppedCanvas');
    var ext = $("#ext").val();
    if (ext == "jpg" || ext == "jpeg" || ext == "JPG" || ext == "JPEG") {
      var croppng = cropcanvas.toDataURL("image/jpeg");
    }
    else {
      var croppng = cropcanvas.toDataURL("image/png");
    }
    $.ajax({
      type: 'POST',
      dataType:'JSON',
      url: '<?php echo base_url()."administrator/ajax_banner/bannerimagetempoffer"; ?>',
      data: {
        pngimageData: croppng,
        imageext: ext,
        action: 'bannerimagetempoffer',
        filename: $("#bannerimage_name").val()
      },
      success: function(output) {
        $('#banner_pic_modal').modal('hide');
        var bannerhtml= output.img_path;
        $("#previewbanner1").attr('src',bannerhtml); 
        $("#previewbanner_link").attr('href',bannerhtml); 
        $("#cover_image").val(output.up_image); 
      }
    });
  }
  </script>

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

<div id="banner_pic_modal" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel-2">Crop Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="cropbannerimages" method="post" enctype="multipart/form-data" action="<?php echo base_url()."administrator/ajax_banner/savebanner"; ?>">
        <input type="hidden" name="bannerdoAction" id="bannerdoAction" value="savebanner" />
        <input type="hidden" id="bannerx" name="bannerx" value="1" />
        <input type="hidden" id="bannery" name="bannery" value="1" />
        <input type="hidden" id="bannerw" name="bannerw" value="800" />
        <input type="hidden" id="bannerh" name="bannerh" value="436" />
        <input type="hidden" name="banneraction" value="" id="banneraction" />
        <input type="hidden" name="bannerimage_name" value="" id="bannerimage_name" />
        <div class="col-12 product-loading">
          <div class="lds-ellipsis">
            <div><img src="<?php echo base_url()."uploads/loader.gif"; ?>" height="500" width="900"></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
        </div>
        <div id='banner-preview-profile-pic'> </div>
        </form>
      </div>
    </div>
  </div>
</div>