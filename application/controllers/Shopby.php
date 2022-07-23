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
						      		$ProductDetailsHtml .='<input type="text" value="1" name="qtybutton" class="cart-plus-minus">';
						    	$ProductDetailsHtml .='</div>';
						    	$ProductDetailsHtml .='<a href="javascript:void(0);" class="add-to-cart" style="width:45%;margin-right:10px;" onclick="return addtocart('.$ProductDetail['id'].');">';
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
			echo "Category";
			echo "<br>";
			echo "Type=".$type;
			echo "<br>";
			echo "Type Value=".$typevalue;
			exit;

		}else if(isset($type) && $type!='' && $type=='gender'){
			echo "Gender";
			echo "<br>";
			echo "Type=".$type;
			echo "<br>";
			echo "Type Value=".$typevalue;
			exit;
			
		}else if(isset($type) && $type!='' && $type=='price'){
			echo "Price";
			echo "<br>";
			echo "Type=".$type;
			echo "<br>";
			echo "Type Value=".$typevalue;
			exit;			
		}else{
			 redirect($this->data['base_url']);
		}

		$this->data['title'] = "Shop By";
		$this->data['type'] = $type;
		$this->data['SubType'] = $SubType;
		$this->load->view('shopby',$this->data);
	}
	// public function index()
	// {
	// 	$data['title'] = "Products";
	// 	$this->load->view('products',$data);
	// }
    
 //    public function details()
	// {
	// 	$data['title'] = "Product Details";
	// 	$this->load->view('product_detail',$data);
	// }
}
