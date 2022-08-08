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
		echo "<pre>";
		print_r($PDetails);exit;
		
	}
}
