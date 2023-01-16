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
              <div class="sin-category">
                 <a href="<?php echo  base_url(); ?>shopby/category/<?php echo $cval['slug'];?>"  class="img-hover-zoom">
                 	<img src="<?php echo  base_url(); ?>uploads/category/<?php echo $cval['image'];?>" alt="<?php echo ucwords($cval['name']);?>">
                 </a>   
                <div class="cat-name"> 
                  <a href="<?php echo  base_url(); ?>shopby/category/<?php echo $cval['slug'];?>">
                    <h5><?php echo ucwords($cval['name']);?></h5>
                  </a> 
                </div>
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