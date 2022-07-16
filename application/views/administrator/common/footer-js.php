  <script src="<?php echo  base_url(); ?>assest/administrator/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/vendors/js/vendor.bundle.addons.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/js/off-canvas.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/js/hoverable-collapse.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/js/misc.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/js/settings.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/js/todolist.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/js/dashboard.js"></script>
  <script src="<?php echo  base_url(); ?>assest/front/js/jquery.toast.js"></script>
  <!-- End custom js for this page-->

  <script src="<?php echo  base_url(); ?>assest/administrator/js/data-table.js"></script>
  <script src="<?php echo  base_url(); ?>assest/administrator/js/formpickers.js"></script>
<?php /*?>  <script src="<?php echo  base_url(); ?>assest/front/js/right.js"></script><?php */?>
  <script type="text/javascript">
   $(document).on("keypress keyup keydown",".priceOnly",function (e) {
       // if the letter is not digit then display error and don't type anything
       // alert(e.which )
      if(e.which==37 || e.which==39){
              return true;
          }
      if (e.which != 110 &&e.which != 46 && e.which != 9 && e.which != 13 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which < 96 || e.which > 105)) {
          //$("#errmsg").html("Digits Only").show().fadeOut("slow");
          return false;
      }
    });
  </script>
  <script type="text/javascript">
  	$('.changestatus').click(function (){
		var table = $(this).attr('data-table');
		var id = $(this).attr('data-id');
		var field_name = $(this).attr('data-field');
		var id_name = $(this).attr('data-id-name');
		var status = 0;
		var htmlsuccess = '<div class="col-md-12"><div class="alert alert-icon alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button><i class="mdi mdi-check-all"></i>Status Change Success</div></div>';
		var htmlerror = '<div class="col-md-12"><div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button><i class="mdi mdi-check-all"></i>Status Change Failed</div></div>';
		if(!$(this).hasClass('active')){
			status = 1;
		}
	
		jQuery.ajax( {
			type: "POST",
			url: "<?php echo base_url(); ?>"+"administrator/Change_status/chageStatus",
			dataType: 'json',
			data: {"table": table,"id":id ,"status": status,"field_name":field_name,"id_name":id_name,},
			async: false,
			success: function(response) {
				console.log(response.data)
				if(response.data == true){
				  $('#errormsg').html(htmlsuccess);
				  $("html, body").animate({ scrollTop: 0 }, "slow");
				}else{
				  $('#errormsg').html(htmlerror);
				  $("html, body").animate({ scrollTop: 0 }, "slow");
				}
			}
		});
	  
	});

  function change_status(t)
	{
	      var ctr_id = t.id;
	      var table = $('#'+ctr_id).attr('data-table');
	      var id = $('#'+ctr_id).attr('data-id');
	      var field_name = $('#'+ctr_id).attr('data-field');
	      var id_name = $('#'+ctr_id).attr('data-id-name');
	      var status = 0;
	      var htmlsuccess = '<div class="col-md-12"><div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Status Change Suceessfully.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div></div>';
	      var htmlerror = '<div class="col-md-12"><div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>Status Change Failed</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div></div>';
	      if(!$('#'+ctr_id).hasClass("active") ){
	          status = 1;
	      }
	      jQuery.ajax( {
	          type: "POST",
	          url: "<?php echo base_url(); ?>"+"administrator/Change_status/chageStatus",
	          dataType: 'json',
	          data: {"table": table,"id":id ,"status": status,"field_name":field_name,"id_name":id_name,},
	          async: false,
	          success: function(response) {
	              if(response.data == true){
	                $('#errormsg').html(htmlsuccess);
	                $("html, body").animate({ scrollTop: 0 }, "slow");
	              }else{
	                $('#errormsg').html(htmlerror);
	                $("html, body").animate({ scrollTop: 0 }, "slow");
	              }
	          }
	      });
	}

	//START LOGOUT POPUP
	function check_confirm()
	{
	    swal({
	          title: "Logout",
	          text: 'Are You Sure To Signout ???',
	          icon: "error",
	          buttons: true,
	          dangerMode: true,
	        })
	        .then((willDelete) => {
	          if (willDelete) {
	              window.location.href = '<?php echo base_url('administrator/home/logout'); ?>';
	          } else {
	            //swal("Your imaginary file is safe!");
	          }
	        })
	}
	//END LOGOUT POPUP
  </script>