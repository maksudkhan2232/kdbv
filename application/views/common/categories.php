<section class="category-area padding-120">
    <div class="container-fluid custom-container">
      <div class="section-heading">
        <h3>Shop by <span>Category</span></h3>
      </div>
      <div class="category-carousel owl-carousel owl-theme">
        <?php
          if(!empty($CategoryDetails)){
              foreach($CategoryDetails as $ckey=>$cval){
        ?>
              <div class="sin-category"> <img src="<?php echo  base_url(); ?>uploads/category/<?php echo $cval['image'];?>" alt="<?php echo ucwords($cval['name']);?>">
                <div class="cat-name"> <a href="javascript:void(0);">
                  <h5><?php echo ucwords($cval['name']);?></h5>
                  </a> </div>
              </div>
        <?php
              }
          }
        ?>
      </div>
      <!-- .row -->
    </div>
    <!-- .container-fluid -->
  </section>