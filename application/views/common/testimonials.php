<section class="testimonial-area bg-one padding-120">
    <div class="container container-two">
      <div class="section-heading pb-30">
        <h3>our happy <span>clients</span></h3>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <div class="testimonial-carousel owl-carousel owl-theme">
            <?php
              if(!empty($TestimonialDetails)){
                foreach($TestimonialDetails as $tkey=>$tval){
            ?>
            <div class="single-testimonial">
              <div class="tes-img"> 
                <img src="<?php echo  base_url(); ?>uploads/testimonial/<?php echo $tval['image'];?>" alt="<?php echo ucwords($tval['name']);?>"> 
              </div>
              <div class="tes-content">
                <p><?php echo $tval['desc'];?></p>
                <span><?php echo ucwords($tval['name']);?></span> 
              </div>
            </div>
            <?php
                }
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>