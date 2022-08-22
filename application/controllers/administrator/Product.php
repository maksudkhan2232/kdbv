<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller  {
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/Crud_Model');
		$this->is_admin_logged_in();
	}
	public function index()
	{ 		
		$data = array();
		$data['page_title']='Product';
		$data['viewdata']=$this->Crud_Model->GetProductDetails('product');
		// echo "<pre>";
		// print_r($data['viewdata']);
		// exit;
		$data['button_value'] = 'Add Product';
		$data['name']='';
		$data['city']='';
		$data['contact_no']='';
		$data['id']='';
		$this->load->view('administrator/products',$data);
	}
	public function add()
	{ 		
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('collectiontype', 'Collection Type', 'required');
			$this->form_validation->set_rules('categoryid', 'Category Name', 'required');
			$this->form_validation->set_rules('productcode', 'Product Code', 'required');
			//$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["collectiontype"] =$this->input->post('collectiontype');
				$data["categoryid"] =$this->input->post('categoryid');
				//$data["name"] =$this->input->post('name');
				$data["productcode"] =$this->input->post('productcode');
				$data["description"] =$this->input->post('description');
				$data["button_value"]="Add Product";			
				$data['colletion']=$this->Crud_Model->getDatafromtablewhere('category',array('status'=>1),'ASC');
				$data['gender']=$this->Crud_Model->getDatafromtablewhere('gender',array('status'=>1),'ASC');
				$data['highlights']=$this->Crud_Model->getDatafromtablewhere('product_highlights',array('status'=>1),'ASC');
				$this->load->view('administrator/products/add',$data);				
			}else{	

				$collectiontype = $this->input->post('collectiontype');
				$categoryid = $this->input->post('categoryid');
				$productcode = $this->input->post('productcode');

				$CollectionDetails = $this->Crud_Model->getDatafromtablewheresingle('category',array('status'=>1,'id'=>$collectiontype),'ASC');
				$CategoryDetails = $this->Crud_Model->getDatafromtablewheresingle('sub_category',array('status'=>1,'id'=>$categoryid),'ASC');
				$CollectionName =url_title($CollectionDetails['name'], 'dash', true);
				$CategoryName =url_title($CategoryDetails['name'], 'dash', true); ;
				$ProductName = $CollectionName.'_'.$CategoryName.'_'.url_title($productcode, 'dash', true);
				$ProductFullName = $CollectionDetails['name'].' '.$CategoryDetails['name'].' '.$productcode;
				//echo $ProductName;exit;

				$data["collectiontype"] =$collectiontype;
				$data["categoryid"] =$categoryid;
				$data["slug"] =$ProductFullName;
				$data["name"] =$ProductName;
				$data["productcode"] =$productcode;
				$data["price"] =$this->input->post('price');
				$data["displayorder"] =$this->input->post('displayorder');
				$data["description"] =$this->input->post('description');
				$data["status"] =1;
				$data["isdelete"] =0;
				$data['created_datetime']=date('Y-m-d H:i:s');
				$data['createdip']=$_SERVER['REMOTE_ADDR'];
				if($this->input->post('gender')){
					$data["gender"] =implode(",",$this->input->post('gender'));
				}
				if($this->input->post('highlights')){
					$data["highlight"] =implode(",",$this->input->post('highlights'));
				}
				$ProductId = $this->Crud_Model->InsertData('product',$data);

				// Image Upload
					$folder='product';
					if(!is_dir('uploads/'.$folder.'/')){
						@mkdir('uploads/'.$folder.'/', 0777);
					}
					if(!is_dir('uploads/'.$folder.'/thumbnails')){
						@mkdir('uploads/'.$folder.'/thumbnails', 0777);
					}
					if(!empty($_FILES['image_name']['name'][0]))
					{
						$image = array();
						$ImageCount = count($_FILES['image_name']['name']);
						if($ImageCount > 0)
						{
					        for($i = 0; $i < $ImageCount; $i++){
					            $_FILES['file']['name']       = $_FILES['image_name']['name'][$i];
					            $_FILES['file']['type']       = $_FILES['image_name']['type'][$i];
					            $_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'][$i];
					            $_FILES['file']['error']      = $_FILES['image_name']['error'][$i];
					            $_FILES['file']['size']       = $_FILES['image_name']['size'][$i];
				                // Uploaded file data
				                $ext=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
				                $image_name = rand(11111,99999).".".$ext;
								$isupload = compress($file_tmp=$_FILES["file"]["tmp_name"],'uploads/product/'.$image_name, 30);
								$upload_dir_thumb = 'uploads/product/thumbnails/';
								square_crop($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir_thumb.$image_name, 550);
				                $uploadImgData['product_id'] = $ProductId;
				                $uploadImgData['image_name'] = $image_name;
				                $this->Crud_Model->InsertData('product_image',$uploadImgData);
					        }
					    }
					}
				// End Image Upload

				// Extra Field Add 
					$extrafield =$this->input->post('extrafield');
					$extrafieldvalues =$this->input->post('extrafieldvalue');

					if(count($extrafield) > 0){
						 for($i = 0; $i < count($extrafield); $i++){
						 	$extrafieldname=$extrafield[$i];
						 	$extrafieldvalue=$extrafieldvalues[$i];
						 	if($extrafieldname!='' and $extrafieldvalue!=''){
						 		$ExtraFieldAdd['product_id'] = $ProductId;
				                $ExtraFieldAdd['ename'] = $extrafieldname;
				                $ExtraFieldAdd['evalue'] = $extrafieldvalue;
				                $ExtraFieldAdd['displayorder'] = 0;
				                $ExtraFieldAdd["status"] =1;
								$ExtraFieldAdd["isdelete"] =0;
								$ExtraFieldAdd['created_datetime']=date('Y-m-d H:i:s');
								$ExtraFieldAdd['createdip']=$_SERVER['REMOTE_ADDR'];
								$this->Crud_Model->InsertData('product_extra',$ExtraFieldAdd);
						 	}
						 }
					}
				// End Extra Field Add 
				$this->session->set_flashdata('success', 'Product Inserted Successfully.');
				redirect('administrator/product');
				exit;
			}
		}
		$data = array();
		$data['page_title']='Add Product';
		//$data['viewdata']=$this->Crud_Model->getDatafromtable('');
		$data['button_value'] = 'Add Product';
		$data['colletion']=$this->Crud_Model->getDatafromtablewhere('category',array('status'=>1),'ASC');
		$data['gender']=$this->Crud_Model->getDatafromtablewhere('gender',array('status'=>1),'ASC');
		$data['highlights']=$this->Crud_Model->getDatafromtablewhere('product_highlights',array('status'=>1),'ASC');
		$data['name']='';
		$data['city']='';
		$data['contact_no']='';
		$data['id']='';
		$this->load->view('administrator/product_details',$data);
	}
	public function editview($id){
		$editdata=$this->Crud_Model->getById($id,'id','product');
			
		$data = array();
		$data["id"] = $id;
		$data['page_title']='Update Product';
		//$data['viewdata']=$this->Crud_Model->getDatafromtable('');
		$data['button_value'] = 'Update Product';
		$data['colletion']=$this->Crud_Model->getDatafromtablewhere('category',array('status'=>1),'ASC');
		$data['gender']=$this->Crud_Model->getDatafromtablewhere('gender',array('status'=>1),'ASC');
		$data['highlights']=$this->Crud_Model->getDatafromtablewhere('product_highlights',array('status'=>1),'ASC');
		$data['category']=$this->Crud_Model->getDatafromtablewhere('sub_category',array('status'=>1,'category_id'=>$editdata['collectiontype']),'ASC');
		$data['image']=$this->Crud_Model->getDatafromtablewhere('product_image',array('product_id'=>$id),'ASC');
		$data['extrafileds']=$this->Crud_Model->getDatafromtablewhere('product_extra',array('product_id'=>$id),'ASC');
		
		$data['collectiontype']=$editdata['collectiontype'];
		$data['categoryid']=$editdata['categoryid'];
		$data['selectedgender']=explode(',',$editdata['gender']);
		$data['selectedhighlight']=explode(',',$editdata['highlight']);
		//print_r($data['selectedgender']);exit;
		$data['productcode']=$editdata['productcode'];
		$data['price']=$editdata['price'];
		$data['description']=$editdata['description'];
		$this->load->view('administrator/product_details',$data);
	}
	public function edit()
	{
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('collectiontype', 'Collection Type', 'required');
			$this->form_validation->set_rules('categoryid', 'Category Name', 'required');
			$this->form_validation->set_rules('productcode', 'Product Code', 'required');
			if ($this->form_validation->run() == FALSE) {

				redirect('administrator/product/edit/'.$this->input->post('id'));
				
			}else{		

				$collectiontype = $this->input->post('collectiontype');
				$categoryid = $this->input->post('categoryid');
				$productcode = $this->input->post('productcode');

				$CollectionDetails = $this->Crud_Model->getDatafromtablewheresingle('category',array('status'=>1,'id'=>$collectiontype),'ASC');
				$CategoryDetails = $this->Crud_Model->getDatafromtablewheresingle('sub_category',array('status'=>1,'id'=>$categoryid),'ASC');
				$CollectionName =url_title($CollectionDetails['name'], 'dash', true);
				$CategoryName =url_title($CategoryDetails['name'], 'dash', true); ;
				$ProductName = $CollectionName.'_'.$CategoryName.'_'.$productcode;
				$ProductFullName = $CollectionDetails['name'].' '.$CategoryDetails['name'].' '.$productcode;
				$data["collectiontype"] =$collectiontype;
				$data["categoryid"] =$categoryid;
				$data["slug"] =$ProductFullName;
				$data["name"] =$ProductName;
				$data["productcode"] =$productcode;
				$data["price"] =$this->input->post('price');
				$data["displayorder"] =$this->input->post('displayorder');
				$data["description"] =$this->input->post('description');
				$data["status"] =1;
				$data["isdelete"] =0;
				$data['created_datetime']=date('Y-m-d H:i:s');
				$data['createdip']=$_SERVER['REMOTE_ADDR'];
				if($this->input->post('gender')){
					$data["gender"] =implode(",",$this->input->post('gender'));
				}
				if($this->input->post('highlights')){
					$data["highlight"] =implode(",",$this->input->post('highlights'));
				}
				$ProductId=$this->input->post('id');
				$this->Crud_Model->Updatedata($ProductId,'id','product',$data);
				

				// Image Upload
					$folder='product';
					if(!is_dir('uploads/'.$folder.'/')){
						@mkdir('uploads/'.$folder.'/', 0777);
					}
					if(!is_dir('uploads/'.$folder.'/thumbnails')){
						@mkdir('uploads/'.$folder.'/thumbnails', 0777);
					}
					if(!empty($_FILES['image_name']['name'][0]))
					{
						$image = array();
						$ImageCount = count($_FILES['image_name']['name']);
						if($ImageCount > 0)
						{
					        for($i = 0; $i < $ImageCount; $i++){
					            $_FILES['file']['name']       = $_FILES['image_name']['name'][$i];
					            $_FILES['file']['type']       = $_FILES['image_name']['type'][$i];
					            $_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'][$i];
					            $_FILES['file']['error']      = $_FILES['image_name']['error'][$i];
					            $_FILES['file']['size']       = $_FILES['image_name']['size'][$i];
				                // Uploaded file data
				                $ext=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
				                $image_name = rand(11111,99999).".".$ext;
								$isupload = compress($file_tmp=$_FILES["file"]["tmp_name"],'uploads/product/'.$image_name, 30);
								$upload_dir_thumb = 'uploads/product/thumbnails/';
								square_crop($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir_thumb.$image_name, 550);
				                $uploadImgData['product_id'] = $ProductId;
				                $uploadImgData['image_name'] = $image_name;
				                $this->Crud_Model->InsertData('product_image',$uploadImgData);
					        }
					    }
					}
				// End Image Upload

				// Extra Field Add 
					$extrafield =$this->input->post('extrafield');
					$extrafieldvalues =$this->input->post('extrafieldvalue');

					if(count($extrafield) > 0){
						 for($i = 0; $i < count($extrafield); $i++){
						 	$extrafieldname=$extrafield[$i];
						 	$extrafieldvalue=$extrafieldvalues[$i];
						 	if($extrafieldname!='' and $extrafieldvalue!=''){
						 		$ExtraFieldAdd['product_id'] = $ProductId;
				                $ExtraFieldAdd['ename'] = $extrafieldname;
				                $ExtraFieldAdd['evalue'] = $extrafieldvalue;
				                $ExtraFieldAdd['displayorder'] = 0;
				                $ExtraFieldAdd["status"] =1;
								$ExtraFieldAdd["isdelete"] =0;
								$ExtraFieldAdd['created_datetime']=date('Y-m-d H:i:s');
								$ExtraFieldAdd['createdip']=$_SERVER['REMOTE_ADDR'];
								$this->Crud_Model->InsertData('product_extra',$ExtraFieldAdd);
						 	}
						 }
					}
				// End Extra Field Add 
				
				$this->session->set_flashdata('success', 'Product Update Successfully.');
				redirect('administrator/product');
				exit;
			}
		}else{
			redirect('administrator/product');
		}
	}
	public function delete_product($id)
	{
		if($id !='')
		{
			$this->Crud_Model->DeletData($id,'id','product');
			redirect('administrator/product'); exit;
		}
	}
	public function delete_product_photo($row_id)
	{
		$editdata=$this->Crud_Model->getById($row_id,'id','product_image');
			unlink('uploads/product/'.$editdata['image_name']);
			unlink('uploads/product/thumbnails/'.$editdata['image_name']);
		  $delete = $this->Crud_Model->DeletData($row_id,'id','product_image');
		
	//	$udata['image_name'] = 'default.jpg';	
	//	$this->Crud_Model->Updatedata($row_id,'id','product_image',$udata);
		
	}
	public function delete_product_filed($row_id)
	{
		$delete = $this->Crud_Model->DeletData($row_id,'id','product_extra');
	}
}