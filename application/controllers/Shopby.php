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
					$this->data['ProductDetails']=$this->Crud_Model->GetProductDetails($collectionwise);
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
