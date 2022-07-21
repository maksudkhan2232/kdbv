<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class products extends MY_Controller {
    public function __construct()
    {
        parent::__construct();	
        $this->load->model('administrator/Crud_Model');
    }

	public function index()
	{
		
		$data['title'] = "Products";
		$this->load->view('products',$data);
	}
	public function ProductQuickView()
	{
		$productid = $this->input->post('productid');
		$ReturnDetails=array();
		$ProductDetailsHtml='';
		if($productid!=''){
			$ProductDetail=$this->Crud_Model->getDatafromtablewheresingle('product',array('status'=>1,'id'=>$productid));
            if(!empty($ProductDetail)){
            	$ProductImageDetail=$this->Crud_Model->getDatafromtablewhere('product_image',array('product_id'=>$productid),'ASC');
            	$ProductExtraDetail=$this->Crud_Model->getDatafromtablewhere('product_extra',array('product_id'=>$productid),'ASC');
     //        	$ProductDetailsHtml .='<div class="row">';
     //        		$ProductDetailsHtml .='<div class="col-12">';
					// 	$ProductDetailsHtml .='<span class="close-qv">';
					// 		$ProductDetailsHtml .='<i class="flaticon-close"></i>';
					// 	$ProductDetailsHtml .='</span>';
					// $ProductDetailsHtml .='</div>';
					// $ProductDetailsHtml .='<div class="col-md-6">';
					// 	$ProductDetailsHtml .='<div class="quickview-slider">';
					//   		$ProductDetailsHtml .='<div class="slider-for">';
					//   			if(!empty($ProductImageDetail)){
					//   				foreach ($ProductImageDetail as $pikey => $pivalue) {
					//   					$ProductDetailsHtml .='<div class="">';
					//     					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/'.$pivalue['image_name'].'" alt="'.$ProductDetail['productcode'].'">';
					//     				$ProductDetailsHtml .='</div>';
					//   				}
					//   			}else{
					//   				$ProductDetailsHtml .='<div class="">';
					// 					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/noimagethumb.jpg" alt="'.$ProductDetail['productcode'].'">';
					// 				$ProductDetailsHtml .='</div>';
					//   			}
					//   		$ProductDetailsHtml .='</div>';
					//   		$ProductDetailsHtml .='<div class="slider-nav">';
					//   			if(!empty($ProductImageDetail)){
					//   				foreach ($ProductImageDetail as $pikey => $pivalue) {
					//   					$ProductDetailsHtml .='<div class="">';
					//     					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/'.$pivalue['image_name'].'" alt="'.$ProductDetail['productcode'].'">';
					//     				$ProductDetailsHtml .='</div>';
					//   				}
					//   			}else{
					//   				$ProductDetailsHtml .='<div class="">';
					// 					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/noimage.jpg" alt="'.$ProductDetail['productcode'].'">';
					// 				$ProductDetailsHtml .='</div>';
					//   			}
					//   		$ProductDetailsHtml .='</div>';
					//   	$ProductDetailsHtml .='</div>';
					// $ProductDetailsHtml .='</div>';
					// $ProductDetailsHtml .='<div class="col-md-6">';
					// 	$ProductDetailsHtml .='<div class="product-details">';
					// 		$ProductDetailsHtml .='<h5 class="pro-title">';
					// 			$ProductDetailsHtml .='<a href="javascript:void(0);">'.$ProductDetail['productcode'].'</a>';
					// 		$ProductDetailsHtml .='</h5>';
					// 		if($ProductDetail['price']!='0'){
					// 			$ProductDetailsHtml .='<span class="price">₹ '.$ProductDetail['price'].'</span>';	
					// 		}				          	
					// 	  	$ProductDetailsHtml .='<div class="size-variation"> <span>size :</span>';
					// 	        $ProductDetailsHtml .='<select name="size-value">';
					// 	          $ProductDetailsHtml .='<option value="">1</option>';
					// 	          $ProductDetailsHtml .='<option value="">2</option>';
					// 	          $ProductDetailsHtml .='<option value="">3</option>';
					// 	          $ProductDetailsHtml .='<option value="">4</option>';
					// 	        $ProductDetailsHtml .='</select>';
					// 	    $ProductDetailsHtml .='</div>';
					// 	    $ProductDetailsHtml .='<div class="cart-subtotal" style="background-color:#ffffff;padding:10px;">';
					// 	  		$ProductDetailsHtml .='<ul style="padding-left:0px;list-style:none;">';
					// 	  			if(!empty($ProductExtraDetail)){
					// 	  				foreach ($ProductExtraDetail as $pekey => $pevalue) {
					// 	  					$ProductDetailsHtml .='<li><span>'.ucwords($pevalue['ename']).'</span>'.ucwords($pevalue['evalue']).'</li>';
					// 	  				}
					// 	  			}
					// 	      	$ProductDetailsHtml .='</ul>';
					// 	  	$ProductDetailsHtml .='</div>';
					// 	  	$ProductDetailsHtml .='<div class="add-tocart-wrap">';
					// 	    	$ProductDetailsHtml .='<div class="cart-plus-minus-button">';
					// 	      		$ProductDetailsHtml .='<input type="text" value="1" name="qtybutton" class="cart-plus-minus">';
					// 	    	$ProductDetailsHtml .='</div>';
					// 	    	$ProductDetailsHtml .='<a href="javascript:void(0);" class="add-to-cart" style="width:45%;margin-right:10px;">';
					// 	    		$ProductDetailsHtml .='<i class="flaticon-shopping-purse-icon"></i>';
					// 	    		$ProductDetailsHtml .=' Add to Cart';
					// 	    	$ProductDetailsHtml .='</a>';
					// 	    	$ProductDetailsHtml .='<a href="" class="add-to-cart" style="width:50px;">';
					// 	    		$ProductDetailsHtml .='<i class="flaticon-eye"></i>';
					// 	    	$ProductDetailsHtml .='</a>';
					// 	   	$ProductDetailsHtml .='</div>';
					// 	$ProductDetailsHtml .='</div>';
					// $ProductDetailsHtml .='</div>';
     //        	$ProductDetailsHtml .='</div>';
            	$ReturnDetails['status']='success';
				$ProductDetailsHtml ='';					
	  			if(!empty($ProductImageDetail)){
	  				foreach ($ProductImageDetail as $pikey => $pivalue) {
	  					$ProductDetailsHtml .='<div class="">';
	    					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/'.$pivalue['image_name'].'" alt="'.$ProductDetail['productcode'].'">';
	    				$ProductDetailsHtml .='</div>';
	  				}
	  			}else{
	  				$ProductDetailsHtml .='<div class="">';
						$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/noimagethumb.jpg" alt="'.$ProductDetail['productcode'].'">';
					$ProductDetailsHtml .='</div>';
	  			}
		  		$ReturnDetails['sliderfor']=$ProductDetailsHtml;
		  			
				  		
		  		$ProductDetailsHtml .='';
	  			if(!empty($ProductImageDetail)){
	  				foreach ($ProductImageDetail as $pikey => $pivalue) {
	  					$ProductDetailsHtml .='<div class="">';
	    					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/'.$pivalue['image_name'].'" alt="'.$ProductDetail['productcode'].'">';
	    				$ProductDetailsHtml .='</div>';
	  				}
	  			}else{
	  				$ProductDetailsHtml .='<div class="">';
						$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/noimage.jpg" alt="'.$ProductDetail['productcode'].'">';
					$ProductDetailsHtml .='</div>';
	  			}
	  			$ReturnDetails['slidernav']=$ProductDetailsHtml;
				  			
				$ProductDetailsHtml='';
				$ProductDetailsHtml .='<div class="product-details">';
					$ProductDetailsHtml .='<h5 class="pro-title">';
						$ProductDetailsHtml .='<a href="javascript:void(0);">'.$ProductDetail['productcode'].'</a>';
					$ProductDetailsHtml .='</h5>';
					if($ProductDetail['price']!='0'){
						$ProductDetailsHtml .='<span class="price">₹ '.$ProductDetail['price'].'</span>';	
					}				          	
				  	$ProductDetailsHtml .='<div class="size-variation"> <span>size :</span>';
				        $ProductDetailsHtml .='<select name="size-value">';
				          $ProductDetailsHtml .='<option value="">1</option>';
				          $ProductDetailsHtml .='<option value="">2</option>';
				          $ProductDetailsHtml .='<option value="">3</option>';
				          $ProductDetailsHtml .='<option value="">4</option>';
				        $ProductDetailsHtml .='</select>';
				    $ProductDetailsHtml .='</div>';
				    $ProductDetailsHtml .='<div class="cart-subtotal" style="background-color:#ffffff;padding:10px;">';
				  		$ProductDetailsHtml .='<ul style="padding-left:0px;list-style:none;">';
				  			if(!empty($ProductExtraDetail)){
				  				foreach ($ProductExtraDetail as $pekey => $pevalue) {
				  					$ProductDetailsHtml .='<li><span>'.ucwords($pevalue['ename']).'</span>'.ucwords($pevalue['evalue']).'</li>';
				  				}
				  			}
				      	$ProductDetailsHtml .='</ul>';
				  	$ProductDetailsHtml .='</div>';
				  	$ProductDetailsHtml .='<div class="add-tocart-wrap">';
				    	$ProductDetailsHtml .='<div class="cart-plus-minus-button">';
				      		$ProductDetailsHtml .='<input type="text" value="1" name="qtybutton" class="cart-plus-minus">';
				    	$ProductDetailsHtml .='</div>';
				    	$ProductDetailsHtml .='<a href="javascript:void(0);" class="add-to-cart" style="width:45%;margin-right:10px;">';
				    		$ProductDetailsHtml .='<i class="flaticon-shopping-purse-icon"></i>';
				    		$ProductDetailsHtml .=' Add to Cart';
				    	$ProductDetailsHtml .='</a>';
				    	$ProductDetailsHtml .='<a href="" class="add-to-cart" style="width:50px;">';
				    		$ProductDetailsHtml .='<i class="flaticon-eye"></i>';
				    	$ProductDetailsHtml .='</a>';
				   	$ProductDetailsHtml .='</div>';
				$ProductDetailsHtml .='</div>';
				$ReturnDetails['productdetails']=$ProductDetailsHtml;
			
			}else{
				$ProductDetailsHtml .='';	
			}
		}else{
        	 $ProductDetailsHtml .='';
        }
        echo json_encode($ReturnDetails);exit;
	}

}


