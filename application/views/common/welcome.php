<?php 
  if(!empty($WelcomeNoteDetails)){

?>
<div class="modal popup-2" id="exampleModaltwo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-body popup-banner style-two" style="background-image: url(<?php echo base_url()."uploads/welcomenote/".$WelcomeNoteDetails['image']; ?>);">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        <?php 
          if($WelcomeNoteDetails['title']!=''){
            echo '<h3>Get the Product <span>Delivered Daily!</span></h3>';
          }
          if($WelcomeNoteDetails['description']!=''){
            echo '<p>Give me your email and you will be daily updated with the latest product & detail!.</p>';
          }
        ?>
        <div class="popup-subscribe">
          <div class="subscribe-wrapper">
            <input placeholder="Enter your Email" type="email" id="subscribeemailpopup" >
            <button type="submit" id="subscribesubmitpopup">SUBSCRIBE</button>
          </div>
        </div>
        <!-- <input type="checkbox" name="vehicle" value="Bike"> -->
        <!-- <span>Don't show this popup again</span>  -->
      </div>
    </div>
</div>

<?php
  }
?>
