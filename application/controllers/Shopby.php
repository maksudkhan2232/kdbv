<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopby extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('administrator/Crud_Model');
    }
    function index(){
		$type = $this->uri->segment(2);
		$typevalue = $this->uri->segment(3);
		
		
		if(isset($type) && $type!='' && $type=='collections'){
			if(isset($typevalue) && $typevalue!=''){
				
				$CollectionSingleDetails=$this->Crud_Model->getDatafromtablewheresingle('category',array('status'=>1,'slug'=>$typevalue));
				if(!empty($CollectionSingleDetails)){
					$SubType = $CollectionSingleDetails['name'];
					$CollectionId = $CollectionSingleDetails['id'];
					$collectionwise=array('collectiontype'=>$CollectionId);
					//$this->data['ProductDetails']=$this->Crud_Model->GetProductDetails($collectionwise);
					$product_details=array();
					foreach ($this->Crud_Model->GetProductDetails($collectionwise) as $key => $v) 
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
							$ProductDetailsHtml .='<p>'.$v['collectionshortname'].' / <span style="color: #d19e66;">'.$v['categoryname'].'</span></p>';
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

					$this->data['ProductDetails']=$product_details;
					$this->data['filedvalue'] = $CollectionId;
					// echo "<pre>";
					// print_r($this->data['ProductDetails']);
					// exit;
				}else{
					$this->data['title'] = "Collections";
					$this->load->view('collections',$this->data);
				}				
			}else{
				$this->data['title'] = "Collections";
				$this->load->view('collections',$this->data);
			}
		}else if(isset($type) && $type!='' && $type=='category'){
			$CollectionSingleDetails=$this->Crud_Model->getDatafromtablewheresingle('sub_category',array('status'=>1,'slug'=>$typevalue));
			if(!empty($CollectionSingleDetails)){
				$SubType = $CollectionSingleDetails['name'];
				$CategoryId = $CollectionSingleDetails['id'];
				$Categorywise=array('categoryid'=>$CategoryId);
				//$this->data['ProductDetails']=$this->Crud_Model->GetProductDetails($collectionwise);
				$product_details=array();
				foreach ($this->Crud_Model->GetProductDetails($Categorywise) as $key => $v) {

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
						$ProductDetailsHtml .='<p>'.$v['collectionshortname'].' / <span style="color: #d19e66;">'.$v['categoryname'].'</span></p>';
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
					    	$ProductDetailsHtml .='<a href="" class="add-to-cart" style="width:50px;">';
					    		$ProductDetailsHtml .='<i class="flaticon-eye"></i>';
					    	$ProductDetailsHtml .='</a>';
					   	$ProductDetailsHtml .='</div>';
					$ProductDetailsHtml .='</div>';
					$v['productdetails']=$ProductDetailsHtml;
					
					$product_details[] = $v;
				}

				$this->data['ProductDetails']=$product_details;
				$this->data['filedvalue'] = $CategoryId;
				// echo "<pre>";
				// print_r($this->data['ProductDetails']);
				// exit;
			}else{
			    redirect($this->data['base_url'].'collections/');
				// $this->data['title'] = "Collections";
				// $this->load->view('collections',$this->data);
			}
		}else if(isset($type) && $type!='' && $type=='gender'){
			$CollectionSingleDetails=$this->Crud_Model->getDatafromtablewheresingle('gender',array('status'=>1,'slug'=>$typevalue));
			if(!empty($CollectionSingleDetails)){
				$SubType = $CollectionSingleDetails['name'];
				$Gender = $CollectionSingleDetails['name'];
				$genderid = $CollectionSingleDetails['id'];
				$GenderWise=array('gender'=>$Gender);
				//$this->data['ProductDetails']=$this->Crud_Model->GetProductDetails($collectionwise);
				$product_details=array();
				foreach ($this->Crud_Model->GetProductDetails($GenderWise) as $key => $v) {

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
						$ProductDetailsHtml .='<p>'.$v['collectionshortname'].' / <span style="color: #d19e66;">'.$v['categoryname'].'</span></p>';
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
					    	$ProductDetailsHtml .='<a href="" class="add-to-cart" style="width:50px;">';
					    		$ProductDetailsHtml .='<i class="flaticon-eye"></i>';
					    	$ProductDetailsHtml .='</a>';
					   	$ProductDetailsHtml .='</div>';
					$ProductDetailsHtml .='</div>';
					$v['productdetails']=$ProductDetailsHtml;
					
					$product_details[] = $v;
				}

				$this->data['ProductDetails']=$product_details;
				$this->data['filedvalue'] = $Gender;
				
				// echo "<pre>";
				// print_r($this->data['ProductDetails']);
				// exit;
			}else{
			    redirect($this->data['base_url'].'collections/');
				// $this->data['title'] = "Collections";
				// $this->load->view('collections',$this->data);
			}			
		}else if(isset($type) && $type!='' && $type=='price'){
			$CollectionSingleDetails=$this->Crud_Model->getDatafromtablewheresingle('product_pricerange',array('status'=>1,'slug'=>$typevalue));
			if(!empty($CollectionSingleDetails)){
				$SubType = $CollectionSingleDetails['name'];
				$Priceid = $CollectionSingleDetails['id'];
				$PriceMin = $CollectionSingleDetails['pricemin'];
				$PriceMax = $CollectionSingleDetails['pricemax'];
				$PriceWise=array('pricemin'=>$PriceMin,'pricemax'=>$PriceMax);
				$ProductDetails=$this->Crud_Model->GetProductDetails($PriceWise);
				//print_r($ProductDetails);
				//exit;
				$product_details=array();
				foreach ($this->Crud_Model->GetProductDetails($PriceWise) as $key => $v) {

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
						$ProductDetailsHtml .='<p>'.$v['collectionshortname'].' / <span style="color: #d19e66;">'.$v['categoryname'].'</span></p>';
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
					    	$ProductDetailsHtml .='<a href="'.base_url().'/products" class="add-to-cart" style="width:50px;">';
					    		$ProductDetailsHtml .='<i class="flaticon-eye"></i>';
					    	$ProductDetailsHtml .='</a>';
					   	$ProductDetailsHtml .='</div>';
					$ProductDetailsHtml .='</div>';
					$v['productdetails']=$ProductDetailsHtml;
					
					$product_details[] = $v;
				}

				$this->data['ProductDetails']=$product_details;
				$this->data['filedvalue'] = $Priceid;
				// echo "<pre>";
				// print_r($this->data['ProductDetails']);
				// exit;
			}else{
			    redirect($this->data['base_url'].'collections/');
				// $this->data['title'] = "Collections";
				// $this->load->view('collections',$this->data);
			}	
			
		}else if(isset($type) && $type!='' && $type=='trending'){
			
			$trending=array('highlight'=>"TRENDING COLLECTIONS");
			$TRENDINGCOLLECTIONS=$this->Crud_Model->GetProductDetails($trending);
			
			if(!empty($TRENDINGCOLLECTIONS)){
				$SubType = 'TRENDING COLLECTIONS';
				$product_details=array();
				foreach ($TRENDINGCOLLECTIONS as $key => $v) {

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
						$ProductDetailsHtml .='<p>'.$v['collectionshortname'].' / <span style="color: #d19e66;">'.$v['categoryname'].'</span></p>';
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
					    	$ProductDetailsHtml .='<a href="'.base_url().'/products" class="add-to-cart" style="width:50px;">';
					    		$ProductDetailsHtml .='<i class="flaticon-eye"></i>';
					    	$ProductDetailsHtml .='</a>';
					   	$ProductDetailsHtml .='</div>';
					$ProductDetailsHtml .='</div>';
					$v['productdetails']=$ProductDetailsHtml;
					
					$product_details[] = $v;
				}

				$this->data['ProductDetails']=$product_details;
				$this->data['filedvalue'] = "trending";
			}else{
			    redirect($this->data['base_url'].'collections/');
				// $this->data['title'] = "Collections";
				// $this->load->view('collections',$this->data);
			}	
			
		}else if(isset($type) && $type!='' && $type=='newarrival'){
			
			$newarrival=array('highlight'=>"NEW ARRIVAL");
			$NEWARRIVAL=$this->Crud_Model->GetProductDetails($newarrival);
			
			if(!empty($NEWARRIVAL)){
				$SubType = 'NEW ARRIVAL';
				$product_details=array();
				foreach ($NEWARRIVAL as $key => $v) {

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
						$ProductDetailsHtml .='<p>'.$v['collectionshortname'].' / <span style="color: #d19e66;">'.$v['categoryname'].'</span></p>';
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
					    	$ProductDetailsHtml .='<a href="'.base_url().'/products" class="add-to-cart" style="width:50px;">';
					    		$ProductDetailsHtml .='<i class="flaticon-eye"></i>';
					    	$ProductDetailsHtml .='</a>';
					   	$ProductDetailsHtml .='</div>';
					$ProductDetailsHtml .='</div>';
					$v['productdetails']=$ProductDetailsHtml;
					
					$product_details[] = $v;
				}

				$this->data['ProductDetails']=$product_details;
				$this->data['filedvalue'] = "newarrival";
			}else{
				redirect($this->data['base_url'].'collections/');
				// $this->data['title'] = "Collections";
				// $this->load->view('collections',$this->data);
			}	
			
		}else if(isset($type) && $type!='' && $type=='search'){
			$searcharea=array('productcode'=>$typevalue,'name'=>$typevalue,'description'=>$typevalue,'gender'=>$typevalue,'highlight'=>$typevalue,'type'=>'search');
			$this->data['filedvalue'] = $typevalue;
			$SearchDetails=$this->Crud_Model->GetSearchProductDetails($searcharea);
			//print_r($SearchDetails);exit;
			if(!empty($SearchDetails)){
				$SubType = strtoupper($typevalue);
				$product_details=array();
				foreach ($SearchDetails as $key => $v) {

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
						$ProductDetailsHtml .='<p>'.$v['collectionshortname'].' / <span style="color: #d19e66;">'.$v['categoryname'].'</span></p>';
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
					    	$ProductDetailsHtml .='<a href="'.base_url().'/products" class="add-to-cart" style="width:50px;">';
					    		$ProductDetailsHtml .='<i class="flaticon-eye"></i>';
					    	$ProductDetailsHtml .='</a>';
					   	$ProductDetailsHtml .='</div>';
					$ProductDetailsHtml .='</div>';
					$v['productdetails']=$ProductDetailsHtml;
					
					$product_details[] = $v;
				}

				$this->data['ProductDetails']=$product_details;
			}else{
			    redirect($this->data['base_url'].'collections/');
				// $this->data['title'] = "Collections";
				// $this->load->view('collections',$this->data);
			}	
			
		}else{
			 redirect($this->data['base_url']);
		}
		// Get Available Category
		$GroupByCategory=array('GroupBy'=>"p.categoryid");
		$GroupByCategoryDetails=$this->Crud_Model->GetProductCollectionDetails($GroupByCategory);
		$this->data['GroupByCategoryDetails'] = $GroupByCategoryDetails;
		
		// Get Minimim Price and Maximum Price
		$ProductMinMaxPriceDetails=$this->Crud_Model->GetProductMinMaxPriceDetails();
		$this->data['ProductMinMaxPriceDetails'] = $ProductMinMaxPriceDetails;

		// Get Available Collection
		$GroupByCollection=array('GroupBy'=>"p.collectiontype");
		$GroupByCollectionDetails=$this->Crud_Model->GetProductCollectionDetails($GroupByCollection);
		$this->data['GroupByCollectionDetails'] = $GroupByCollectionDetails;

		// TRENDING COLLECTIONS
		$trending=array('highlight'=>"TRENDING COLLECTIONS",'Limit'=>5);
		$TrendingDetails=$this->Crud_Model->GetProductDetails($trending);
		$this->data['TrendingDetails'] = $TrendingDetails;

		// TRENDING COLLECTIONS SIDE IMAGE
		$this->data['TrendingCollectionSideImage']=$this->Crud_Model->getDatafromtablewheresingle('trending',array('id'=>1));
		
		$this->data['title'] = "Shop By";
		$this->data['type'] = $type;
		$this->data['SubType'] = $SubType;
		$this->data['typevalue'] = $typevalue;
		$this->load->view('shopby',$this->data);
	}
}
