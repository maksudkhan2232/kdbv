<!doctype html>
<html>
<head>
<!-- Meta Data -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Photo Gallery |  KD Bhindi Jewellers</title>
<?php $this->load->view('common/common_css');?>
<?php /*?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css"><?php */?>
<link rel="stylesheet" href="<?php echo  base_url(); ?>assest/frontend/css/lightbox/lightbox.min.css">
<style type="text/css">
.lightbox-gallery {
	background-image: linear-gradient(#4A148C, #E53935);
	background-repeat: no-repeat;
	color: #000;
	overflow-x: hidden
}
.lightbox-gallery p {
	color:#fff
}
.lightbox-gallery h2 {
	font-weight:bold;
	margin-bottom:40px;
	padding-top:40px;
	color:#fff
}
@media (max-width:767px) {
.lightbox-gallery h2 {
margin-bottom:25px;
padding-top:25px;
font-size:24px
}
}
.lightbox-gallery .intro {
	font-size:16px;
	max-width:500px;
	margin:0 auto 40px
}
.lightbox-gallery .intro p {
	margin-bottom:0
}
.lightbox-gallery .photos {
	padding-bottom:20px
}
.lightbox-gallery .item {
	padding-bottom:30px
}

</style>
</head>
<body id="home-version-1" class="home-version-1" data-style="default">
<div class="site-content">
  <?php $this->load->view('common/header');?>
  <!--=========================-->
  <!--=        Breadcrumb         =-->
  <!--=========================-->
  <section class="breadcrumb-area">
    <div class="container-fluid custom-container">
      <div class="row">
        <div class="col-xl-12">
          <div class="bc-inner">
            <p><a href="<?php echo base_url(); ?>">Home  |</a> Gallery</p>
          </div>
        </div>
        <!-- /.col-xl-12 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
  <!--=========================-->
  <section class="shop-area">
    <div class="container container-two">
      <div class="row">
        <div class="col-12">
          <div class="section-heading">
            <h3>Photo<span> Gallery</span></h3>
          </div>
          <div class="collection-content">
            <div class="row photos" id="load_data">
              <div id="load_data_message"></div>
            </div>
            <div class="load-more-wrapper"> <a href="javascript:;" id="load_more" class="btn-two">Load More</a> </div>
            <!-- /.load-more-wrapper -->
          </div>
          <!-- /.shop-content -->
        </div>
        <!-- /.col-xl-9 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <?php $this->load->view('common/subscribe');?>
  <?php $this->load->view('common/footer');?>
  <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
  <?php $this->load->view('common/quick-view');?>
</div>
<?php $this->load->view('common/main-search');?>
<?php $this->load->view('common/common_js');?>
<?php /*?><script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script><?php */?>
<script src="<?php echo  base_url(); ?>assest/frontend/css/lightbox/lightbox.min.js"></script>
<script>
  $(document).ready(function(){
    var limit = 8;
    var start = 0;
    var action = 'inactive';
    var t_data = 0;
    function load_data(limit, start)
    {
      $.ajax({
        url:"<?php echo base_url(); ?>gallery/fetch_photo_gallery",
        method:"POST",
        dataType:'json',
        data:{limit:limit, start:start},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('');
            action = 'active';
          }
          else
          {
            $('#load_data').append(data.gdata);
            t_data = t_data+limit;
            if(t_data>=data.total_rows)
            {
              $("#load_more").hide();
            }
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start);
    }
    $("#load_more").on("click",function(){
       if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        
        action = 'active';
        start = start + limit;
        setTimeout(function(){
         // load_data(limit, start);
        }, 1000);
         load_data(limit, start);
      }
    });

  });
</script>
</body>
</html>