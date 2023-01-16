<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Details |  KD Bhindi Jewellers</title>
    <?php $this->load->view('common/common_css');?>
    <link rel="stylesheet" href="<?php echo  base_url(); ?>assest/frontend/share/jquery.floating-social-share.min.css" type="text/css">
    <style type="text/css">
    .btn-primary
    {
    margin-right:10px;
    margin-bottom:10px;
    }
    /* Green */
    .whtsappsuccess {
    border-color: #04AA6D;
    color: green;
    padding:8px 8px;
    margin-bottom:5px;
    }
    .whtsappsuccess:hover {
    background-color: #04AA6D;
    color: white;
    }
    </style>
  </head>
  <body id="home-version-1" class="home-version-1" data-style="default">
    <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
    <div class="site-content">
      <?php $this->load->view('common/header');?>
      <section class="breadcrumb-area">
        <div class="container-fluid custom-container">
          <div class="row">
            <div class="col-xl-12">
              <div class="bc-inner">
                <p><a href="<?php echo base_url(); ?>">Home  |</a> <a href="<?php echo base_url(); ?>collections/">Collections  |</a> <?php echo $CollectionName;?></p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="shop-area style-two" style="padding-bottom: 45px;">
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="row">
                <div class="col-lg-6 col-xl-6">
                  <!-- Product View Slider -->
                  <div class="quickview-slider">
                    <div class="slider-for">
                      <?php
                      $ProductDetailsHtml='';
                      if(!empty($ProductImageDetail)){
                      foreach ($ProductImageDetail as $pikey => $pivalue) {
                      $ProductDetailsHtml .='<div class="">';
                        $ProductDetailsHtml .='<img src="'.base_url().'uploads/product/'.$pivalue['image_name'].'" alt="Thumb">';
                      $ProductDetailsHtml .='</div>';
                      }
                      }else{
                      $ProductDetailsHtml .='<div class="">';
                        $ProductDetailsHtml .='<img src="'.base_url().'uploads/product/noimagethumb.jpg" alt="Thumb">';
                      $ProductDetailsHtml .='</div>';
                      }
                      echo $ProductDetailsHtml;
                      ?>
                    </div>
                    <div class="slider-nav">
                      <?php
                      $ProductDetailsHtml='';
                      if(!empty($ProductImageDetail)){
                      foreach ($ProductImageDetail as $pikey => $pivalue) {
                      $ProductDetailsHtml .='<div class="">';
                        $ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/'.$pivalue['image_name'].'" alt="Thumb">';
                      $ProductDetailsHtml .='</div>';
                      }
                      }else{
                      $ProductDetailsHtml .='<div class="">';
                        $ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/noimagethumb.jpg" alt="Thumb">';
                      $ProductDetailsHtml .='</div>';
                      }
                      echo $ProductDetailsHtml;
                      ?>
                    </div>
                  </div>
                  <!-- /.quickview-slider -->
                </div>
                <!-- /.col-xl-6 -->
                <div class="col-lg-6 col-xl-6">
                  <div class="product-details">
                    <h5 class="pro-title"> <a href="javascript:void(0);"><?php echo $ProductDetails['productcode'];?></a> </h5>
                    <p style="padding: 0px;"><?php echo $ProductDetails['collectionshortname'];?> / <span style="color: #d19e66;"><?php echo $ProductDetails['categoryname'];?></span></p>
                    <?php
                    if($v['price']!='0' and $v['price']!=''){
                    echo '<span class="price">Price : ₹.'.$v['price'].'</span>';
                    }else{
                    //echo '<span class="price"></span>';
                    }
                    ?>
                    <?php /*?>  <span>SKU: N/A</span>
                    <p>Tags
                      <a href="#">boys,</a>
                      <a href="#"> dress,</a>
                      <a href="#">Rok-dress</a>
                    </p>
                    <ul>
                      <li>Lorem ipsum dolor sit amet</li>
                      <li>quis nostrud exercitation ullamco</li>
                      <li>Duis aute irure dolor in reprehenderit</li>
                    </ul> <?php */?>
                    <br><div class="">
                      <!-- <h5>Additional information</h5> -->
                      <style type="text/css">
                      .first{
                      width: 40% !important;
                      }
                      .secound{
                      width: 50% !important;
                      }
                      .sin-aditional-info{
                      border-bottom: 1px solid #d6d4d3;
                      border-right: 1px solid #d6d4d3;
                      }
                      </style>
                      <div class="info-wrap">
                        <?php
                        $ProductDetailsHtml='';
                        if(!empty($ProductExtraDetail)){
                        foreach ($ProductExtraDetail as $pekey => $pevalue) {
                        $ProductDetailsHtml .='<div class="sin-aditional-info">';
                          $ProductDetailsHtml .='<div class="first">';
                            $ProductDetailsHtml .=ucwords($pevalue['ename']);
                          $ProductDetailsHtml .='</div>';
                          $ProductDetailsHtml .='<div class="secound">';
                            $ProductDetailsHtml .=ucwords($pevalue['evalue']);
                          $ProductDetailsHtml .='</div>';
                        $ProductDetailsHtml .='</div>';
                        }
                        }
                        echo $ProductDetailsHtml;
                        ?>
                      </div>
                    </div>
                    <br>
                    <p style="padding: 20px 0px 20px;"> <?php echo nl2br($ProductDetails['description']);?> </p>
                    <div class="add-tocart-wrap">
                      <div class="cart-plus-minus-button">
                        <input type="text" value="1" name="qtybutton" class="cart-plus-minus" id="qty<?php echo $ProductDetails['id'];?>" min="1">
                      </div>
                      <a href="javascript:void(0);" class="add-to-cart" onClick="return addtocart(<?php echo $ProductDetails['id'];?>);"><i class="flaticon-shopping-purse-icon"></i>Add to Cart</a>
                      <?php /*?>   <a href="javascript:void(0);" onClick="FavoriteProducts(<?php echo $ProductDetails['id'];?>);"><i class="flaticon-valentines-heart"></i></a> <?php */?>
                    </div>
                    <br>
                    <div class="row d-flex justify-content-center">
                      <div class="col-lg-12 col-xl-12">
                        <div class="product-social"> <span>Share :</span>
                        <ul id="share_div">
                          <!-- <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                          <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                          <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li> -->
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-4 col-xl-5">
                      <?php  $cur_url = $actual_link;   ?>
                      <a class="btn whtsappsuccess" href="https://api.whatsapp.com/send?phone=+91<?php echo $WebsiteInformation['contactno'];?>&amp;text=Hello, *<?php echo $WebsiteInformation['firm_name'];?>*, I'm interested in your *<?php echo ucwords($ProductDetails['collectionshortname'])." / ".$ProductDetails['categoryname']." / ".$ProductDetails['productcode']; ?>* Product." target="_blank"><img src="<?php echo base_url(); ?>assest/frontend/media/images/whatsapp.png" style="width:25px;height:auto;"> Whatsapp Inquiry</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-xl-6 -->
              <!-- <div class="col-xl-12">
                <div class="product-des-tab">
                  <ul class="nav nav-tabs " role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">DESCRIPTION</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ADDITIONAL INFORMATION</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">REVIEWS (1)</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <div class="prod-bottom-tab-sin description">
                        <h5>Description</h5>
                        <p>
                          <?php echo nl2br($ProductDetails['description']);?>
                        </p>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="prod-bottom-tab-sin">
                        <h5>Additional information</h5>
                        <div class="info-wrap">
                          <?php
                          $ProductDetailsHtml='';
                          if(!empty($ProductExtraDetail)){
                          foreach ($ProductExtraDetail as $pekey => $pevalue) {
                          $ProductDetailsHtml .='<div class="sin-aditional-info">';
                            $ProductDetailsHtml .='<div class="first">';
                              $ProductDetailsHtml .=ucwords($pevalue['ename']);
                            $ProductDetailsHtml .='</div>';
                            $ProductDetailsHtml .='<div class="secound">';
                              $ProductDetailsHtml .=ucwords($pevalue['evalue']);
                            $ProductDetailsHtml .='</div>';
                          $ProductDetailsHtml .='</div>';
                          }
                          }
                          echo $ProductDetailsHtml;
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                      <div class="prod-bottom-tab-sin">
                        <h5>Review (1)</h5>
                        <div class="product-review">
                          <div class="reviwer">
                            <img src="<?php echo  base_url(); ?>assest/frontend/media/images/reviewer.png" alt="">
                            <div class="review-details">
                              <span>Posted by Tonoy - Published on  March 22, 2018</span>
                              <div class="rating">
                                <ul>
                                  <li><a href="#"><i class="far fa-star"></i></a></li>
                                  <li><a href="#"><i class="far fa-star"></i></a></li>
                                  <li><a href="#"><i class="far fa-star"></i></a></li>
                                  <li><a href="#"><i class="far fa-star"></i></a></li>
                                  <li><a href="#"><i class="far fa-star"></i></a></li>
                                </ul>
                              </div>
                              <p>But I must explain to you how all this mistaken idea of denouncipleasure and praisi pain was born and I will give you a complete.</p>
                            </div>
                          </div>
                          <div class="add-your-review">
                            <h6>ADD A REVIEW</h6>
                            <p>YOUR RATING* </p>
                            <div class="rating">
                              <ul>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                              </ul>
                            </div>
                            <div class="raing-form">
                              <input type="hidden" name="productid" id="productid" value="<?php echo $ProductDetails['id'];?>">
                              <input type="text" name="reviewname" id="reviewname" placeholder="Enter Your Name" value="">
                              <textarea name="review" id="review" placeholder="Enter Your Review"></textarea>
                              <input type="button" name="review_submit" id="review_submit">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.col-xl-9 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <?php
    if(!empty($RelatedProduct)){
    ?>
    <section class="banner-product" style="padding: 67px 0 75px;">
      <div class="container-fluid custom-container">
        <div class="section-heading pb-30">
          <h3>Related <span>Products</span></h3>
        </div>
        <!-- section-heading-->
        <div class="row">
          <!-- Col end-->
          <div class="no-padding col-xl-12 col-lg-12">
            <div class="relprod-carousel owl-carousel owl-theme">
              <?php //foreach(array_chunk($RelatedProduct, 2) as $RelatedProductCollection ) {
              foreach(array_chunk($RelatedProduct,1) as $RelatedProductCollection ) { ?>
              <div class="sin-prod-car">
                <?php
                foreach($RelatedProductCollection as $tckey=>$tcval){
                ?>
                <div class="sin-product style-two small">
                  <div class="pro-img"> <img src="<?php echo base_url(); ?>uploads/product/thumbnails/<?php echo $tcval['image_name'];?>" alt="<?php echo $tcval['productcode'];?>"> </div>
                  <?php
                  if (strpos($tcval['highlight'], 'NEW ARRIVAL') !== false) {
                  ?>
                  <span class="new-tag"> New </span>
                  <?php
                  }
                  ?>
                  <div class="mid-wrapper">
                    <h5 class="pro-title"> <a href="<?php echo base_url().'products/view/'.$tcval['slug'];?>"><?php echo $tcval['productcode'];?></a> </h5>
                    <p><?php echo $tcval['collectionshortname'];?> / <span><?php echo $tcval['categoryname'];?></span></p>
                  </div>
                  <div class="icon-wrapper">
                    <?php /* ?><div class="pro-icon">
                      <ul>
                        <li><a href="javascript:void(0);" onClick="FavoriteProducts(<?php echo $tcval['id'];?>);"><i class="flaticon-valentines-heart"></i></a></li>
                        <li> <a href="javascript:void(0);" class="triggersss" data-id="<?php echo $tcval['id'];?>" id="productquickview" onClick="TrendingQuickView(<?php echo $tcval['id'];?>);"> <i class="flaticon-eye"></i> </a> </li>
                      </ul>
                    </div><?php */ ?>
                    <div class="add-to-cart"> <?php /* ?><a href="javascript:void(0);" onClick="return addtocart(<?php echo $tcval['id'];?>);">add to cart</a><?php */ ?><a href="<?php echo base_url().'products/view/'.$tcval['slug'];?>" type="button" class="btn-outline-dark">View</a> </div>
                  </div>
                </div>
                <?php
                }
                ?>
              </div>
              <?php
              }
              ?>
            </div>
          </div>
          <!-- Col end-->
        </div>
        <!-- /.row -->
      </div>
      <!-- Container End -->
    </section>
    <?php
    }
    ?>
    <!--=========================-->
    <!--=   Subscribe area      =-->
    <?php $this->load->view('common/gender-collections');?>
    <?php $this->load->view('common/subscribe');?>
    <?php $this->load->view('common/footer');?>
    <!-- footer-widget-area -->
    <!-- Back to top
    ============================================= -->
    <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
  
  <?php $this->load->view('common/quick-view');?>
</div>
<?php $this->load->view('common/main-search');?>
<?php $this->load->view('common/common_js');?>
<script src="<?php echo  base_url(); ?>assest/frontend/share/jquery.floating-social-share.min.js"></script>

 <script type="text/javascript">
    $("#share_div").floatingSocialShare({
        buttons: [
          "facebook", "linkedin", "twitter","mail","whatsapp", 
          "telegram"
        ],
        title: document.title,
        text: "share with : ",
        url: "<?php echo $actual_link; ?>"
    });
    </script>
</body>
</html>