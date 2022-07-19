<section class="product-banner-two-area padding-120">
  <div class="container container-two">
    <div class="section-heading">
      <h3>Shop by <span>Gender</span></h3>
    </div>
    <div class="row justify-content-center">
      <?php
        if(!empty($GenderDetails)){
            foreach($GenderDetails as $gkey=>$gval){
      ?>
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class="prod-banner-two"> 
                <a href="<?php echo  base_url(); ?>shopby/gender/<?php echo $gval['slug'];?>"> 
                  <img src="<?php echo  base_url(); ?>uploads/gender/<?php echo $gval['image'];?>" alt="<?php echo ucwords($gval['name']);?>">
                  <div class="pb-info">
                    <p><?php echo ucwords($gval['name']);?></p>
                    <h6>Collections</h6>
                  </div>
                </a> 
              </div>
            </div>
      <?php
            }
        }
      ?>
    </div>
  </div>
</section>