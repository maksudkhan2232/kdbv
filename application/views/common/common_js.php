<!-- Dependency Scripts -->
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/jquery/jquery.min.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/popper.js/popper.min.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/owl.carousel/js/owl.carousel.min.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/wow/js/wow.min.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/isotope-layout/js/isotope.pkgd.min.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/imagesloaded/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/jquery.countdown/js/jquery.countdown.min.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/venobox/js/venobox.min.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/slick-carousel/js/slick.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/headroom/js/headroom.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/dependencies/jquery-ui/js/jquery-ui.min.js"></script>
<!-- Site Scripts -->
<script src="<?php echo  base_url(); ?>assest/frontend/js/app.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/js/marquee.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/js/main.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/js/sweetalert2@10.js"></script>
<script src="<?php echo  base_url(); ?>assest/frontend/js/general.js"></script>
<!--<script src="assets/js/right.js"></script>-->
<!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
	// $(document).ready(function(){
	// 	$( "#SearchTypeAhead" ).autocomplete({
	//         source: function( request, response ) {
	//           // Fetch data
	//           $.ajax({
	//             url:base_url+'Products/ProductSearch/',
	//             type: 'post',
	//             dataType: "json",
	//             data: {
	//               search: request.term
	//             },
	//             success: function( data ) {
	//               response( data );
	//             }
	//           });
	//         },
	//         select: function (event, ui) {
	//           // Set selection
	//           //$('#SearchTypeAhead').val(ui.item.label); // display the selected text
	//           $('#SearchTypeAhead').html(ui.item.label); // save selected id to input
	//           return false;
	//         }
 //      	});
 	//    });
 	// $(document).ready(function(){
		// $( "#SearchTypeAhead" ).typeahead({
	 //        source: function( request, response ) {
	 //          // Fetch data
	 //          $.ajax({
	 //            url:base_url+'Products/ProductSearch/',
	 //            type: 'post',
	 //            dataType: "json",
	 //            data: {
	 //              search: request.term
	 //            },
	 //            success: function( data ) {
	 //            	console.log(data);
	 //              response( data );
	 //            }
	 //          });
	 //        },
	 //        select: function (event, ui) {
	 //          // Set selection
	 //          $('#SearchTypeAhead').val(ui.item.label); // display the selected text
	 //          //$('#SearchTypeAhead').html(ui.item.label); // save selected id to input
	 //          return false;
	 //        }
  //     	});
  //   });
	    if (jQuery('input#SearchTypeAhead').length > 0) {
		    jQuery('input#SearchTypeAhead').typeahead({
		      displayText: function(item) {
		           return item.name
		      },
		      afterSelect: function(item) {
		            this.$element[0].value = item.name;
		            jQuery("input#SearchTypeAhead").val(item.name);
		      },
		      source: function (query, process) {
		        jQuery.ajax({
	                url: base_url+'Products/ProductSearch/',
	                data: {query:query},
	                dataType: "json",
	                type: "POST",
	                success: function (data) {
	                	console.log(data);
	                    process(data)
	                }
	            })
		      }   
		    });
		}
</script>