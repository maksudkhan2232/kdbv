<footer class="footer-widget-area style-two">
    <div class="container-fluid custom-container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
          <div class="footer-widget style-two">
            <div class="logo"> <a href="javascript:void(0);"><img src="<?php echo  base_url(); ?>assest/frontend/media/images/logo.svg" height="120" width="200" alt=""></a> </div>
            <p>Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat vel illum dolore eu olestie.</p>
            <div class="time-table">
              <p>Opening time</p>
              <span>Monday - Saturday   ( 9.00 to 21.00 )</span> <span>Sunday    ( 9.00 to 14.00 )</span> </div>
          </div>
        </div>
        <!-- /.col-xl-3 -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-2">
          <div class="footer-widget style-two">
            <h3>Get To Know Us</h3>
            <div class="footer-menu">
              <ul>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>about">About Us</a></li>
                <li><a href="<?php echo base_url(); ?>collections">Collections</a></li>
                <li><a href="<?php echo base_url(); ?>gallery">Photo Gallery</a></li>
                <li><a href="<?php echo base_url(); ?>customer/review">Customer Reviews</a></li>
                <li><a href="<?php echo base_url(); ?>contact">Contact Us</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /.col-xl-3 -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-2">
          <div class="footer-widget style-two">
            <h3>Quick Shop</h3>
            <div class="footer-menu">
              <ul>
                <li><a href="<?php echo base_url().'shopby/trending/';?>">Trending Collections</a></li>
                <?php
                  foreach ($CollectionDetails as $ctkey => $ctvalue) {
                ?>
                    <li>
                      <a href="<?php echo  base_url(); ?>shopby/collections/<?php echo $ctvalue['slug'];?>"><?php echo ucwords($ctvalue['name']);?></a>
                    </li>
                <?php
                  }
                ?>
                <li><a href="javascript:void(0);">Offers</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /.col-xl-3 -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-2">
          <div class="footer-widget style-two">
            <h3>Policies</h3>
            <div class="footer-menu">
              <ul>
                <li><a href="<?php echo base_url(); ?>privacypolicy">Privacy Policy</a></li>
                <li><a href="<?php echo base_url(); ?>refundpolicy">Refund Policy</a></li>
                <li><a href="<?php echo base_url(); ?>exchangepolicy">Exchange Policy</a></li>
                <li><a href="<?php echo base_url(); ?>shippingpolicy">Shipping Policy</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /.col-xl-3 -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <div class="footer-widget style-two">
            <h3>Gallery</h3>
            <div class="footer-instagram">
              <ul>
                <li><a href="javascript:void(0);"><img src="<?php echo  base_url(); ?>assest/frontend/media/images/instagram/6.jpg" alt=""></a></li>
                <li><a href="javascript:void(0);"><img src="<?php echo  base_url(); ?>assest/frontend/media/images/instagram/7.jpg" alt=""></a></li>
                <li><a href="javascript:void(0);"><img src="<?php echo  base_url(); ?>assest/frontend/media/images/instagram/8.jpg" alt=""></a></li>
                <li><a href="javascript:void(0);"><img src="<?php echo  base_url(); ?>assest/frontend/media/images/instagram/9.jpg" alt=""></a></li>
                <li><a href="javascript:void(0);"><img src="<?php echo  base_url(); ?>assest/frontend/media/images/instagram/10.jpg" alt=""></a></li>
                <li><a href="javascript:void(0);"><img src="<?php echo  base_url(); ?>assest/frontend/media/images/instagram/11.jpg" alt=""></a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /.col-xl-3 -->
      </div>
      <div class="footer-bottom">
        <div class="row">
          <div class="col-md-12 col-lg-6 col-xl-6 order-1 order-lg-1">
            <p>© <span><?php echo date('Y');?></span> All Rights Reserved by <span>KD Bhindi</span></p>
          </div>
          <!-- /.col-xl-6 -->
          <div class="col-md-12 col-lg-6 col-xl-6 order-2 order-lg-2">
            <div class="footer-payment-icon text-center"> Developed by <a href="https://vinayakwebinfotech.com/" target="_blank" style="color:#d19e66">Vinayak Infotech</a> </div>
          </div>
          <!-- /.col-xl-6 -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- container-fluid -->
  </footer>