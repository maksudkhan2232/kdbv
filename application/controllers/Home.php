<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    public function __construct()
    {
        parent::__construct();	
        $this->load->model('administrator/Crud_Model');
    }

	public function index()
	{
		
		$this->data['SliderDetails']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
		// echo "<pre>";
		// print_r($this->data['SliderDetails']);exit;
		// TRENDING COLLECTIONS
		$trending=array('highlight'=>"TRENDING COLLECTIONS");
		$product_details=array();
		foreach ($this->Crud_Model->GetProductDetails($trending) as $key => $v) 
		{
			$ProductImageDetail=$this->Crud_Model->getDatafromtablewhere('product_image',array('product_id'=>$v['id']),'ASC');
			$ProductExtraDetail=$this->Crud_Model->getDatafromtablewhere('product_extra',array('product_id'=>$v['id']),'ASC');
			$ProductDetailsHtml ='';					
				if(!empty($ProductImageDetail)){
					foreach ($ProductImageDetail as $pikey => $pivalue) {
						$ProductDetailsHtml .='<div class="">';
						$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/'.$pivalue['image_name'].'" alt="'.$v['productcode'].'">';
					$ProductDetailsHtml .='</div>';
					}
				}else{
					$ProductDetailsHtml .='<div class="">';
					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/noimagethumb.jpg" alt="'.$v['productcode'].'">';
				$ProductDetailsHtml .='</div>';
				}
				$v['sliderfor'] = $ProductDetailsHtml ;

				$ProductDetailsHtml .='';
				if(!empty($ProductImageDetail)){
					foreach ($ProductImageDetail as $pikey => $pivalue) {
						$ProductDetailsHtml .='<div class="">';
						$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/'.$pivalue['image_name'].'" alt="'.$v['productcode'].'">';
					$ProductDetailsHtml .='</div>';
					}
				}else{
					$ProductDetailsHtml .='<div class="">';
					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/noimage.jpg" alt="'.$v['productcode'].'">';
				$ProductDetailsHtml .='</div>';
				}
				$v['slidernav']=$ProductDetailsHtml;



			$ProductDetailsHtml='';
			$ProductDetailsHtml .='<div class="product-details">';
				$ProductDetailsHtml .='<h5 class="pro-title">';
					$ProductDetailsHtml .='<a href="javascript:void(0);">'.$v['productcode'].'</a>';
				$ProductDetailsHtml .='</h5>';
				if($v['price']!='0'){
					$ProductDetailsHtml .='<span class="price">₹ '.$v['price'].'</span>';	
				}				          	
			  	
			    $ProductDetailsHtml .='<div class="cart-subtotal" style="background-color:#ffffff;padding:10px;">';
			  		$ProductDetailsHtml .='<ul style="padding-left:0px;list-style:none;">';
			  			if(!empty($ProductExtraDetail)){
			  				foreach ($ProductExtraDetail as $pekey => $pevalue) {
			  					if($pekey<4){
			  						$ProductDetailsHtml .='<li><span>'.ucwords($pevalue['ename']).'</span>'.ucwords($pevalue['evalue']).'</li>';
			  					}
			  				}
			  			}
			      	$ProductDetailsHtml .='</ul>';
			  	$ProductDetailsHtml .='</div>';
			  	$ProductDetailsHtml .='<div class="add-tocart-wrap">';
			    	$ProductDetailsHtml .='<div class="cart-plus-minus-button">';
			      		$ProductDetailsHtml .='<input type="text" value="1" name="qtybutton" class="cart-plus-minus" id="qty'.$v['id'].'" min="1">';
			    	$ProductDetailsHtml .='</div>';
			    	$ProductDetailsHtml .='<a href="javascript:void(0);" class="add-to-cart" style="width:45%;margin-right:10px;" onclick="return addtocart('.$v['id'].');">';
			    		$ProductDetailsHtml .='<i class="flaticon-shopping-purse-icon"></i>';
			    		$ProductDetailsHtml .=' Add to Cart';
			    	$ProductDetailsHtml .='</a>';
			    	$ProductDetailsHtml .='<a href="'.base_url().'/products/view/'.$v['slug'].'" class="add-to-cart" style="width:50px;">';
			    		$ProductDetailsHtml .='<i class="flaticon-eye"></i>';
			    	$ProductDetailsHtml .='</a>';
			   	$ProductDetailsHtml .='</div>';
			$ProductDetailsHtml .='</div>';
			$v['productdetails']=$ProductDetailsHtml;
			
			$product_details[] = $v;
		}
		$this->data['TrendingCollectionDetails']=$product_details;


		// TRENDING COLLECTIONS SIDE IMAGE
		$this->data['TrendingCollectionSideImage']=$this->Crud_Model->getDatafromtablewheresingle('trending',array('id'=>1));

		// NEW ARRIVAL
		$newarrival=array('highlight'=>"NEW ARRIVAL");
		$product_details=array();
		foreach ($this->Crud_Model->GetProductDetails($newarrival) as $key => $v) 
		{
			$ProductImageDetail=$this->Crud_Model->getDatafromtablewhere('product_image',array('product_id'=>$v['id']),'ASC');
			$ProductExtraDetail=$this->Crud_Model->getDatafromtablewhere('product_extra',array('product_id'=>$v['id']),'ASC');
			$ProductDetailsHtml ='';					
				if(!empty($ProductImageDetail)){
					foreach ($ProductImageDetail as $pikey => $pivalue) {
						$ProductDetailsHtml .='<div class="">';
						$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/'.$pivalue['image_name'].'" alt="'.$v['productcode'].'">';
					$ProductDetailsHtml .='</div>';
					}
				}else{
					$ProductDetailsHtml .='<div class="">';
					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/thumbnails/noimagethumb.jpg" alt="'.$v['productcode'].'">';
				$ProductDetailsHtml .='</div>';
				}
				$v['sliderfor'] = $ProductDetailsHtml ;

				$ProductDetailsHtml .='';
				if(!empty($ProductImageDetail)){
					foreach ($ProductImageDetail as $pikey => $pivalue) {
						$ProductDetailsHtml .='<div class="">';
						$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/'.$pivalue['image_name'].'" alt="'.$v['productcode'].'">';
					$ProductDetailsHtml .='</div>';
					}
				}else{
					$ProductDetailsHtml .='<div class="">';
					$ProductDetailsHtml .='<img src="'.base_url().'uploads/product/noimage.jpg" alt="'.$v['productcode'].'">';
				$ProductDetailsHtml .='</div>';
				}
				$v['slidernav']=$ProductDetailsHtml;



			$ProductDetailsHtml='';
			$ProductDetailsHtml .='<div class="product-details">';
				$ProductDetailsHtml .='<h5 class="pro-title">';
					$ProductDetailsHtml .='<a href="javascript:void(0);">'.$v['productcode'].'</a>';
				$ProductDetailsHtml .='</h5>';
				if($v['price']!='0'){
					$ProductDetailsHtml .='<span class="price">₹ '.$v['price'].'</span>';	
				}				          	
			  	
			    $ProductDetailsHtml .='<div class="cart-subtotal" style="background-color:#ffffff;padding:10px;">';
			  		$ProductDetailsHtml .='<ul style="padding-left:0px;list-style:none;">';
			  			if(!empty($ProductExtraDetail)){
			  				foreach ($ProductExtraDetail as $pekey => $pevalue) {
			  					if($pekey<4){
			  						$ProductDetailsHtml .='<li><span>'.ucwords($pevalue['ename']).'</span>'.ucwords($pevalue['evalue']).'</li>';
			  					}
			  				}
			  			}
			      	$ProductDetailsHtml .='</ul>';
			  	$ProductDetailsHtml .='</div>';
			  	$ProductDetailsHtml .='<div class="add-tocart-wrap">';
			    	$ProductDetailsHtml .='<div class="cart-plus-minus-button">';
			      		$ProductDetailsHtml .='<input type="text" value="1" name="qtybutton" class="cart-plus-minus" id="qty'.$v['id'].'" min="1">';
			    	$ProductDetailsHtml .='</div>';
			    	$ProductDetailsHtml .='<a href="javascript:void(0);" class="add-to-cart" style="width:45%;margin-right:10px;" onclick="return addtocart('.$v['id'].');">';
			    		$ProductDetailsHtml .='<i class="flaticon-shopping-purse-icon"></i>';
			    		$ProductDetailsHtml .=' Add to Cart';
			    	$ProductDetailsHtml .='</a>';
			    	$ProductDetailsHtml .='<a href="'.base_url().'/products/view/'.$v['slug'].'" class="add-to-cart" style="width:50px;">';
			    		$ProductDetailsHtml .='<i class="flaticon-eye"></i>';
			    	$ProductDetailsHtml .='</a>';
			   	$ProductDetailsHtml .='</div>';
			$ProductDetailsHtml .='</div>';
			$v['productdetails']=$ProductDetailsHtml;
			
			$product_details[] = $v;
		}
		$this->data['NewArrivalCollectionDetails']=$product_details;
		// echo "<pre>";
		// print_r($this->data['TrendingCollectionDetails']);
		// exit;

		$this->data['title'] = "Home";
		// echo "<pre>";
		// print_r($this->data['SliderDetails']);
		// // echo $this->data['DailyRateChangerDetails'];
		// exit;
		$this->load->view('home',$this->data);
	}
}
