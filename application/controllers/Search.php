<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('administrator/Crud_Model');
    }
    function index(){
		$TopSearchText=$this->input->post('TopSearchText');
		if($TopSearchText!=''){
			redirect($this->data['base_url'].'/shopby/search/'.$TopSearchText);
		}else{
			redirect($this->data['base_url']);
		}		
	}
	function OnProductPage(){
		$type =$this->input->post('type');
		$typevalue =$this->input->post('typevalue');
		$MinPrice =$this->input->post('MinPrice');
		$MaxPrice =$this->input->post('MaxPrice');
		$sortby =$this->input->post('sortby');
		$gender =$this->input->post('gender');
		$collection =$this->input->post('collection');
		$filedvalue =$this->input->post('filedvalue');
		$GetProduct=array();
		if(isset($PriceMin) and $PriceMin!=''){
			$GetProduct['pricemin']=$PriceMin;
			$GetProduct['pricemax']=$PriceMax;	
		}
		if(isset($sortby) and $sortby!=''){
			if($sortby=='trending'){
				$GetProduct['highlight']="TRENDING COLLECTIONS";	
			}
			if($sortby=='newarrival'){
				$GetProduct['highlight']="NEW ARRIVAL";	
			}
			if($sortby=='popularity'){
				$GetProduct['OrderBy']="popularity";
				$GetProduct['order']="DESC";	
			}
		}
		if(isset($gender) and !empty($gender) and $gender!=''){
			$GetProduct['genders']=$gender;
		}
		if(isset($collection) and !empty($collection) and $collection!=''){
			$GetProduct['collection']=$collection;
		}
		

		if(isset($type) && $type!='' && $type=='collections'){
			if(isset($typevalue) && $typevalue!=''){
				if(isset($collection) and empty($collection)){
					$GetProduct['collectiontype']=$filedvalue;
				}			
			}
		}else if(isset($type) && $type!='' && $type=='category'){
			if(isset($typevalue) && $typevalue!=''){
				$GetProduct['categoryid']=$filedvalue;
			}
		}else if(isset($type) && $type!='' && $type=='gender'){
			if(isset($typevalue) && $typevalue!=''){
				if(isset($gender) and empty($gender)){
					$GetProduct['gender']=$filedvalue;
				}			
			}
		}else if(isset($type) && $type!='' && $type=='trending'){
			if(isset($typevalue) && $typevalue!=''){
				if(isset($sortby) and empty($sortby)){
					$GetProduct['highlight']=$filedvalue;
				}			
			}
		}else if(isset($type) && $type!='' && $type=='newarrival'){
			if(isset($typevalue) && $typevalue!=''){
				if(isset($sortby) and empty($sortby)){
					$GetProduct['highlight']=$filedvalue;
				}			
			}
		}else if(isset($type) && $type!='' && $type=='search'){
			$GetProduct['productcode']=$typevalue;
			$GetProduct['name']=$typevalue;
			$GetProduct['description']=$typevalue;
			$GetProduct['gender']=$typevalue;
			$GetProduct['highlight']=$typevalue;
		}
		$PDetails=$this->Crud_Model->GetSearchProductOnPageDetails($GetProduct);
		$returnarray=array();
		if(!empty($PDetails)){
			$phtml='';
			foreach ($PDetails as $pkey => $pvalue) {          	
          		$phtml .='<div class="col-sm-6 col-xl-3 " onClick="popularityset('.$pvalue['id'].');"  data-id="'.$pvalue['id'].'">';
                    $phtml .='<div class="sin-product style-two ">';
                    	$phtml .='<div class="pro-img">';
                        	$phtml .='<img src="'.base_url().'uploads/product/thumbnails/'.$pvalue['image_name'].'" alt="'. $pvalue['productcode'].'">';
                       	$phtml .='</div>';
                        if (strpos($pvalue['highlight'], 'NEW ARRIVAL') !== false) {
	                    	$phtml .='<span class="new-tag">NEW </span>';
                      	}
                      	if (strpos($pvalue['highlight'], 'TRENDING COLLECTIONS') !== false) {
	                    	$phtml .='<span class="new-tag">Trending </span>';
                      	}
                      	$phtml .='<div class="mid-wrapper">';
                        	$phtml .='<h5 class="pro-title">';
                          		$phtml .='<a href="'.base_url().'products/view/'.$pvalue['slug'].'">'.$pvalue['productcode'].'</a>';
                          	$phtml .='</h5>';
                          	$phtml .='<p>';
                          		$phtml .=ucwords($pvalue['collectionshortname']);
                          		$phtml .=' / ';
                          		$phtml .='<span>'.ucwords($pvalue['categoryname']).'</span>';
                          	$phtml .='</p>';
                        $phtml .='</div>';
                       	$phtml .='<div class="icon-wrapper">';
                          	$phtml .='<div class="pro-icon">';
                            	$phtml .='<ul>';
                                	$phtml .='<li>';
                                		$phtml .='<a  href="javascript:void(0);" onClick="FavoriteProducts('.$pvalue['id'].');" >';
                                			$phtml .='<i class="flaticon-valentines-heart"></i>';
                                		$phtml .='</a>';
                                	$phtml .='</li>';
                                	$phtml .='<li>';
                                		$phtml .='<a href="javascript:void(0);" class="triggers" data-id="'.$pvalue['id'].'" id="productquickview" onClick="productquickview('.$pvalue['id'].');"><i class="flaticon-eye"></i></a>';
                                	$phtml .='</li>';
                             	$phtml .='</ul>';
                          	$phtml .='</div>';
                          	$phtml .='<div class="add-to-cart">';
                             	$phtml .='<a href="javascript:void(0);"  onclick="return addtocart('.$pvalue['id'].');">add to cart</a>';
                          	$phtml .='</div>';
                       $phtml .='</div>';
                    $phtml .='</div>';
                $phtml .='</div>';
          	
          	}
          	$returnarray['phtml']=$phtml;
          	$returnarray['msg']='success';
        }else{
        	$returnarray['phtml']='';
          	$returnarray['msg']='error';
        }
		echo json_encode($returnarray);exit;		
	}
}
