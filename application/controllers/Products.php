<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class products extends MY_Controller {
    public function __construct()
    {
        parent::__construct();	
        $this->load->model('administrator/Crud_Model');
    }

	public function index($type)
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
				//             	$ProductDetailsHtml='</script><script src="'.base_url().'assest/frontend/dependencies/jquery/jquery.min.js"></script>
				// <script src="'.base_url().'assest/frontend/dependencies/popper.js/popper.min.js"></script>
				// <script src="'.base_url().'assest/frontend/dependencies/bootstrap/js/bootstrap.min.js"></script>
				// <script src="'.base_url().'assest/frontend/dependencies/slick-carousel/js/slick.js"></script>
				// <script src="'.base_url().'assest/frontend/js/app-demo.js"></script>';

    			//         	$ProductDetailsHtml .="$('.slider-for').slick({ slidesToShow: 1,slidesToScroll: 1,arrows: false,fade: true, asNavFor: '.slider-nav', swipe: false, });";
				// $ProductDetailsHtml .=" $('.slider-nav').slick({ slidesToShow: 4, slidesToScroll: 1, asNavFor: '.slider-for', focusOnSelect: true, swipe: false, infinite: false, arrows: true, });";
				// $ProductDetailsHtml .='</script>';
      			//$ReturnDetails['sliderjs']=$ProductDetailsHtml;
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
				$ReturnDetails['productdetails']=$ProductDetailsHtml;
			
			}else{
				$ProductDetailsHtml .='';	
			}
		}else{
        	 $ProductDetailsHtml .='';
        }
        echo json_encode($ReturnDetails);exit;
	}
	public function view($type)
	{
		$pslug = $this->uri->segment(3);
		$pid = $this->uri->segment(4);
		$productwise=array('slug'=>$pslug);
		$ProductDetails = $this->Crud_Model->GetProductSingleDetails($productwise);
		// echo "<pre>".$pslug;
		// print_r($ProductDetails);
		// exit;
		$CollectionName=$ProductDetails['collectionname'];
		$ProductImageDetail=$this->Crud_Model->getDatafromtablewhere('product_image',array('product_id'=>$ProductDetails['id']),'ASC');
		$ProductExtraDetail=$this->Crud_Model->getDatafromtablewhere('product_extra',array('product_id'=>$ProductDetails['id']),'ASC');

		$this->data['ProductDetails'] = $ProductDetails;
		$this->data['ProductExtraDetail'] = $ProductExtraDetail;
		$this->data['ProductImageDetail'] = $ProductImageDetail;
		$this->data['CollectionName'] = $CollectionName;
		
		// Related Product // Collection and category
		$CollectionAndCategory=array('collectiontype'=>$ProductDetails['collectiontype'],'categoryid'=>$ProductDetails['categoryid'],'CustomWhere'=>'p.id!='.$ProductDetails['id']);
		$CollectionAndCategoryWise=$this->Crud_Model->GetProductDetails($CollectionAndCategory);
		$this->data['RelatedProduct'] = $CollectionAndCategoryWise;
		if(empty($CollectionAndCategoryWise)){
			// Related category
			$CategoryGet=array('categoryid'=>$ProductDetails['categoryid'],'CustomWhere'=>'p.id!='.$ProductDetails['id']);
			$CategoryWise=$this->Crud_Model->GetProductDetails($CategoryGet);
			$this->data['RelatedProduct'] = $CategoryWise;
		}

		$this->load->view('product_detail',$this->data);
	}
	function SetFavoriteProducts()
    {
        $returnarray = array();        
        $productid   = $this->input->post('productid'); //productid  

        if($this->data['customer_info']['id']!=''){
        	$orderinfo =array();
			$orderinfo['customer_id']=$this->data['customer_info']['id'];
			$orderinfo['products_id']=$productid;
			$orderinfo['status']='1';
			$orderinfo['isdelete']='0';
			$orderinfo['created_datetime']=date('Y-m-d H:i:s');
			$orderinfo['modified_datetime']='0000-00-00 00:00:00';
			$favoriteproductsid=$this->Crud_Model->InsertData('customer_favorite_products',$orderinfo);
			$returnarray['msg'] = 'success';
        	$returnarray['message'] = '';
		}else{
			$returnarray['msg'] = 'error';
        	$returnarray['message'] = 'Please Login';        	
        }
        echo json_encode($returnarray);exit;        
    }
    function RemoveFavoriteProducts()
	{
		$returnarray = array();        
		$favoriteid   = $this->input->post('favoriteid'); //productid  
		if($favoriteid !='')
		{
			$this->Crud_Model->DeletData($favoriteid,'id','customer_favorite_products');
			$returnarray['msg'] = 'success';
        	$returnarray['message'] = '';
		}else{
			$returnarray['msg'] = 'error';
        	$returnarray['message'] = 'Please Login';
		}
		echo json_encode($returnarray);exit;        
	}
	function SetPopularityProducts()
    {
        $returnarray = array();        
        $productid   = $this->input->post('productid'); //productid  

        if($productid!='' and $productid!='0'){
        	$ProductDetail=$this->Crud_Model->getDatafromtablewheresingle('product',array('status'=>1,'id'=>$productid));
        	if(!empty($ProductDetail)){
        		$popularity=$ProductDetail['popularity'];
        		$pinfo =array();
				$pinfo['popularity']=($popularity+1);
				$pinfo['id']=$productid;
				$this->Crud_Model->Updatedata($productid,'id','product',$pinfo);
				$returnarray['msg'] = 'success';
	        	$returnarray['message'] = '';
        	}
        	
		}else{
			$returnarray['msg'] = 'error';
        	$returnarray['message'] = 'Please Login';        	
        }
        echo json_encode($returnarray);exit;        
    }
	public function ProductSearch() {
        $json = array();
        $Search = $this->input->post('query');
       	$data = $this->Crud_Model->GetProductForSearch($Search);
        // foreach ($geCountries as $key => $element) {
        //     $json[] = array(
        //         'country_id' => $element['country_id'], 
        //         'country_name' => $element['country_name'],
        //     );
        // }
        // $this->output->set_header('Content-Type: application/json');
        echo json_encode($data);
    }
}


