<?php
	if($this->session->flashdata('errors')){
?>
	<div class="col-md-12">
		<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert" id="myDiv">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
			<i class="mdi mdi-check-all"></i>
				<?php echo  $this->session->flashdata('errors'); ?>
		</div>
	</div>
<?php 
	} 
	elseif($this->session->flashdata('success')) {
?>
	<div class="col-md-12">
		<div class="alert alert-icon alert-success alert-dismissible fade in" role="alert" id="myDiv">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
			<i class="mdi mdi-check-all"></i>
				<?php echo  $this->session->flashdata('success'); ?>
		</div>
	</div>
<?php 
	}
elseif($this->session->flashdata('img_err')) {
?>
	<div class="col-md-12">
		<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert" id="myDiv">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
			<i class="mdi mdi-check-all"></i>
				<?php echo  $this->session->flashdata('img_err'); ?>
		</div>
	</div>
<?php 
	}
?>
<script type="text/javascript">
    setTimeout(function(){
        $('#myDiv').fadeOut(500);
    }, 5000);
</script>