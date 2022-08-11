<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Master extends MY_Controller  {
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/Crud_Model');
		$this->is_admin_logged_in();
	}
	public function category()
	{ 		
		$data = array();
		$data['page_title']='category';
		$data['viewdata']=$this->Crud_Model->getDatafromtable('category');
		$data['button_value'] = 'Add Category';
		$data['name']='';
		$data['id']='';
		$this->load->view('administrator/category',$data);
	}
	public function add_category()
	{	
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('image', '', 'callback_file_check');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["name"] =$this->input->post('name');
				$data["button_value"]="Add";
				$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('category',array(1=>1),'DESC');
				$this->load->view('administrator/category',$data);				
			}else{		
				$data["name"] =trim($this->input->post('name'));
				$data["shortname"] =trim($this->input->post('name'));
				$cnt = $this->Crud_Model->getDatafromtablewhere('category',array('id!='=>0),'DESC');
				$data["displayorder"] =count($cnt)+1;
				$data["isdelete"] =0;
				$data["createdip"] =0;
				$data["status"] =1;
				$data["slug"] =create_slug($data["name"]);
				$data["created_datetime"] =date("Y-m-d H:i:s");
				$data["modified_datetime"] =date("Y-m-d H:i:s");
				$config['upload_path']   = 'uploads/collections/';
                $config['allowed_types'] = 'png';
                $config['encrypt_name'] = TRUE;
               // $config['max_size']      = 1024;
                $config['max_width']  = '500';
        		$config['max_height']  = '500';
                $this->load->library('upload', $config);
                if($this->upload->do_upload('image')){
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];                   
                    $data['image'] = $uploadedFile;
                }			
				$this->Crud_Model->InsertData('category',$data);
				$this->session->set_flashdata('success', 'Category Inserted Successfully.');
				redirect('administrator/master/category');
				exit;
			}
		}else{ 
			$data["id"] = "";
			$data['name']='';
			$data["button_value"]="Add";
			$data['page_title']='Category';
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('category',array(1=>1),'DESC');
			$this->load->view('administrator/category',$data);
		}	
	}
	public function file_check($str){
        $allowed_mime_type_arr = array('image/png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr))
            {
            	 list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
            	 if ($width != 500 || $height != 500 )
            	 {
            	 	$this->form_validation->set_message('file_check', 'Invaliad Width / Height.');
                	return false;
            	 }else
            	 { 
                	return true;
                }
            }else{
                $this->form_validation->set_message('file_check', 'Please select only png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
	public function edit_category($id)
	{
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('image', 'Image', 'callback_file_check_edit');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = $this->input->post('id');
				$data["name"] =$this->input->post('name');
				$data["button_value"]="Update";
				$this->load->view('administrator/category',$data);
			}else{		
				$data["name"] =$this->input->post('name');
				if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="")
				{
					$config['upload_path']   = 'uploads/collections/';
	                $config['allowed_types'] = 'png';
	                $config['encrypt_name'] = TRUE;
	               // $config['max_size']      = 1024;
	                $config['max_width']  = '500';
	        		$config['max_height']  = '500';
	                $this->load->library('upload', $config);
	                if($this->upload->do_upload('image')){
	                    $uploadData = $this->upload->data();
	                    $uploadedFile = $uploadData['file_name'];                   
	                    $data['image'] = $uploadedFile;
	                }	
	                $editdata=$this->Crud_Model->getById($id,'id','category');
					unlink('uploads/collections/'.$editdata['image']);
					unlink('uploads/collections/thumbnails/'.$editdata['image']);
	            }	
				$id=$this->input->post('id');
				$this->Crud_Model->Updatedata($id,'id','category',$data);
				$this->session->set_flashdata('success', 'Category Update Successfully.');
				redirect('administrator/master/category');
				exit;
			}
		}else{
			$editdata=$this->Crud_Model->getById($id,'id','category');
			$data["id"] = $id;
			$data["button_value"]="Update";
			$data['name']=$editdata['name'];
			$data['image']=$editdata['image'];
			$data['page_title']='Category';
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('category',array(1=>1),'DESC');
			$this->load->view('administrator/category',$data);
		}
	}
	public function file_check_edit($str){
	        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
	        $mime = get_mime_by_extension($_FILES['image']['name']);
	        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
	            if(in_array($mime, $allowed_mime_type_arr))
	            {
	            	 list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
	            	 if ($width != 500 || $height != 500 )
	            	 {
	            	 	$this->form_validation->set_message('file_check_edit', 'Invaliad Width / Height.');
	                	return false;
	            	 }else
	            	 { 
	                	return true;
	                }
	            }else{
	                $this->form_validation->set_message('file_check_edit', 'Please select only jpg/png file.');
	                return false;
	            }
	        }else{
	            return true;
	        }
    }
	public function check_duplicate()
	{
		$row_id = $this->input->post('row_id');
		$table_name = $this->input->post('table_name');
		$field_name = $this->input->post('field_name');
		$field_value = $this->input->post('field_value');
		$this->db->select("*");
		$this->db->from($table_name);
		$this->db->where($field_name,$field_value);
		if($row_id != 0 && $row_id != '')
		{
			$this->db->where('id !=',$row_id);
		}
		$query=$this->db->get();
		$query->row_array();
		if($query->num_rows() > 0)
		{
			echo json_encode(array('error'=>1,'msg'=>'Category Name Already Exists..')); exit;
		}else{
			echo json_encode(array('error'=>0,'msg'=>'Category Insert Successfully..')); exit;
		}
	}
	public function sub_category()
	{ 		
		$data = array();
		$data['page_title']='Category';
		$data['categories']=$this->Crud_Model->getDatafromtablewhere('category',array('status'=>1),'ASC');
		$data['viewdata']=$this->Crud_Model->getDatafromtable('sub_category');
		$data['button_value'] = 'Add Category';
		$data['name']='';
		$data['id']='';
		$this->load->view('administrator/sub_category',$data);
	}

	public function add_subcategory()
	{	
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('brand_id[]', 'Collection', 'required');
			$this->form_validation->set_rules('image', '', 'callback_file_check_category');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data['page_title']='Category';
				$data['categories']=$this->Crud_Model->getDatafromtablewhere('category',array('status'=>1),'ASC');
				$data['viewdata']=$this->Crud_Model->getDatafromtable('sub_category');
				$data['collection']=$this->input->post('brand_id');
				$data['button_value'] = 'Add Category';
				$data["name"] =trim($this->input->post('name'));
				$this->load->view('administrator/sub_category',$data);				
			}else{		
				$data["name"] =trim($this->input->post('name'));
				$cnt = $this->Crud_Model->getDatafromtablewhere('sub_category',array('id!='=>0),'DESC');
				$data["category_id"] =implode(",",$this->input->post('brand_id'));
				$data["status"] =1;
				$data["slug"] =create_slug($data["name"]);
				$config['upload_path']   = 'uploads/category/';
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['encrypt_name'] = TRUE;
               // $config['max_size']      = 1024;
                $config['max_width']  = '400';
        		$config['max_height']  = '300';
                $this->load->library('upload', $config);
                if($this->upload->do_upload('image')){
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];                   
                    $data['image'] = $uploadedFile;
                }			
				$this->Crud_Model->InsertData('sub_category',$data);
				$this->session->set_flashdata('success', 'Category Inserted Successfully.');
				redirect('administrator/master/sub_category');
				exit;
			}
		}else{ 
			$data["id"] = "";
			$data['name']='';
			$data["button_value"]="Add";
			$data['page_title']='Category';
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('category',array(1=>1),'DESC');
			$this->load->view('administrator/category',$data);
		}	
	}

	public function edit_subcategory($id)
	{
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('brand_id[]', 'Collection', 'required');
			$this->form_validation->set_rules('image', 'Image', 'callback_file_check_edit_subcategory');
			if ($this->form_validation->run() == FALSE) {
				$data['categories']=$this->Crud_Model->getDatafromtablewhere('category',array('status'=>1),'ASC');
				$data["id"] = $this->input->post('id');
				$data["name"] =$this->input->post('name');
				$data["button_value"]="Update";
				$this->load->view('administrator/sub_category',$data);
			}else{		
				$id=$this->input->post('id');
				$data["name"] =$this->input->post('name');
				$data["category_id"] =implode(",",$this->input->post('brand_id'));
				if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="")
				{
					$config['upload_path']   = 'uploads/category/';
	                $config['allowed_types'] = 'gif|jpg|png|pdf';
	                $config['encrypt_name'] = TRUE;
	               // $config['max_size']      = 1024;
	                $config['max_width']  = '400';
	        		$config['max_height']  = '300';
	                $this->load->library('upload', $config);
	                if($this->upload->do_upload('image')){

	                    $uploadData = $this->upload->data();
	                    $uploadedFile = $uploadData['file_name'];                   
	                    $data['image'] = $uploadedFile;
	                    $editdata=$this->Crud_Model->getById($id,'id','sub_category');
						unlink('uploads/category/'.$editdata['image']);
						unlink('uploads/category/thumbnails/'.$editdata['image']);
	                }	
	               
	            }	
	            $this->Crud_Model->Updatedata($id,'id','sub_category',$data);
	           
				
				
				$this->session->set_flashdata('success', 'Category Update Successfully.');
				redirect('administrator/master/sub_category');
				exit;
			}
		}else{
			$editdata=$this->Crud_Model->getById($id,'id','sub_category');
			$data['categories']=$this->Crud_Model->getDatafromtablewhere('category',array('status'=>1),'ASC');
			$data["id"] = $id;
			$data["button_value"]="Update";
			$data['name']=$editdata['name'];
			$data['image']=$editdata['image'];
			$data['collection']=explode(",",$editdata['category_id']);
			$data['page_title']='Category';
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('sub_category',array(1=>1),'DESC');
			$this->load->view('administrator/sub_category',$data);
		}
	}

	public function file_check_edit_subcategory($str){
	        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
	        $mime = get_mime_by_extension($_FILES['image']['name']);
	        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
	            if(in_array($mime, $allowed_mime_type_arr))
	            {
	            	 list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
	            	 if ($width != 400 || $height != 300 )
	            	 {
	            	 	$this->form_validation->set_message('file_check_edit_subcategory', 'Invaliad Width / Height.');
	                	return false;
	            	 }else
	            	 { 
	                	return true;
	                }
	            }else{
	                $this->form_validation->set_message('file_check_edit_subcategory', 'Please select only jpg/png file.');
	                return false;
	            }
	        }else{
	            return true;
	        }
    }

	public function file_check_category($str){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr))
            {
            	 list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
            	 if ($width != 400 || $height != 300 )
            	 {
            	 	$this->form_validation->set_message('file_check_category', 'Invaliad Width / Height.');
                	return false;
            	 }else
            	 { 
                	return true;
                }
            }else{
                $this->form_validation->set_message('file_check_category', 'Please select only png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check_category', 'Please choose a file to upload.');
            return false;
        }
    }

	public function GetCollectionWiseCategory()
	{ 		
		$collectionid = $this->input->post('collectionid');
		$SubcategoryDetailsHtml='';
		if($collectionid!=''){
            $SubcategoryDetails=$this->Crud_Model->getDatafromtablelike('sub_category',array('status'=>1,'category_id'=>$collectionid),'ASC');            
            if(!empty($SubcategoryDetails)){
             	foreach ($SubcategoryDetails as $sckey => $scvalue) {
                    $SubcategoryDetailsHtml .='<option value="'.$scvalue['id'].'">'.ucwords($scvalue['name']).'</option>'; 
                } 
            }else{
            	$SubcategoryDetailsHtml .='<option value="">Select Category</option>';	
            }
        }else{
        	 $SubcategoryDetailsHtml .='<option value="">Select Category</option>';
        }
        echo json_encode($SubcategoryDetailsHtml);exit;
	}

	//GENDER START
	public function gender()
	{ 		
		$data = array();
		$data['page_title']='Gender';
		$data['viewdata']=$this->Crud_Model->getDatafromtable('gender');
		$data['button_value'] = 'Gender';
		$data['name']='';
		$this->load->view('administrator/gender',$data);
	}
	public function edit_gender($id)
	{
		if(count($this->input->post()) > 0 )
		{
			//print_r($_FILES); exit;
			$this->form_validation->set_rules('image', '', 'callback_file_check_gender');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = $this->input->post('id');
				$editdata=$this->Crud_Model->getById($id,'id','gender');
				$data["button_value"]="Update";
				$data['image']=$editdata['image'];
				$data['page_title']='Gender';
				$data['viewdata']=$this->Crud_Model->getDatafromtable('gender');

				$this->load->view('administrator/gender',$data);
			}else{		
				$id=$this->input->post('id');
				if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="")
				{
					$config['upload_path']   = 'uploads/gender/';
	                $config['allowed_types'] = 'gif|jpg|png';
	                $config['encrypt_name'] = TRUE;
	               // $config['max_size']      = 1024;
	                $config['max_width']  = '4545';
	        		$config['max_height']  = '369';
	                $this->load->library('upload', $config);
	                if($this->upload->do_upload('image')){

	                    $uploadData = $this->upload->data();
	                    $uploadedFile = $uploadData['file_name'];                   
	                    $data['image'] = $uploadedFile;
	                    $editdata=$this->Crud_Model->getById($id,'id','gender');
						unlink('uploads/gender/'.$editdata['image']);
						$this->Crud_Model->Updatedata($id,'id','gender',$data);
	                }	
	               
	            }	
				$this->session->set_flashdata('success', 'Gender Update Successfully.');
				redirect('administrator/master/gender');
				exit;
			}
		}else{
			$editdata=$this->Crud_Model->getById($id,'id','gender');
			$data["id"] = $id;
			$data["button_value"]="Update";
			$data['image']=$editdata['image'];
			$data['page_title']='Gender';
			$data['viewdata']=$this->Crud_Model->getDatafromtable('gender');
			$this->load->view('administrator/gender',$data);
		}
	}
	public function file_check_gender($str){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr))
            {
            	 list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
            	 if ($width != 545 || $height != 369 )
            	 {
            	 	$this->form_validation->set_message('file_check_gender', 'Invaliad Width / Height.');
                	return false;
            	 }else
            	 { 
                	return true;
                }
            }else{
                $this->form_validation->set_message('file_check_gender', 'Please select only Image file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check_gender', 'Please choose a file to upload.');
            return false;
        }
    }
    //END OF GENDER
    // PRICE START
    public function price()
	{ 		
		$data = array();
		$data['page_title']='price';
		$data['viewdata']=$this->Crud_Model->getDatafromtable('product_pricerange');
		$data['button_value'] = 'Add Price';
		$data['name']='';
		$data['pricemax']='';
		$data['pricemin']='';
		$data['id']='';
		$this->load->view('administrator/price',$data);
	}

	public function add_price()
	{	
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('pricemin', 'Min Price', 'required|numeric');
			$this->form_validation->set_rules('pricemax', 'Max Price', 'required|numeric');		
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["name"] =$this->input->post('name');
				$data["pricemin"] =$this->input->post('pricemin');
				$data["pricemax"] =$this->input->post('pricemax');
				$data["button_value"]="Add";
				$data['viewdata']=$this->Crud_Model->getDatafromtable('product_pricerange');
				$this->load->view('administrator/price',$data);				
			}else{		
				$data["name"] =trim($this->input->post('name'));
				$data["pricemin"] =$this->input->post('pricemin');
				$data["pricemax"] =$this->input->post('pricemax');
				$cnt = $this->Crud_Model->getDatafromtablewhere('product_pricerange',array('id!='=>0),'DESC');
				$data["displayorder"] =count($cnt)+1;
				$data["isdelete"] =0;
				$data["showonweb"] =0;
				$data["createdip"] =0;
				$data["status"] =1;
				$data["slug"] =create_slug($data["name"]);
				$data["created_datetime"] =date("Y-m-d H:i:s");
				$data["modified_datetime"] =date("Y-m-d H:i:s");			
				$this->Crud_Model->InsertData('product_pricerange',$data);
				$this->session->set_flashdata('success', 'Price Inserted Successfully.');
				redirect('administrator/master/price');
				exit;
			}
		}else{ 
			$data['page_title']='price';
			$data['viewdata']=$this->Crud_Model->getDatafromtable('product_pricerange');
			$data['button_value'] = 'Add Price';
			$data['name']='';
			$data['pricemax']='';
			$data['pricemin']='';
			$data['id']='';
			$this->load->view('administrator/price',$data);
		}	
	}


	public function edit_price($id)
	{
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('pricemin', 'Min Price', 'required|numeric');
			$this->form_validation->set_rules('pricemax', 'Max Price', 'required|numeric');		
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = $this->input->post('id');
				$data["name"] =$this->input->post('name');
				$data["pricemin"] =$this->input->post('pricemin');
				$data["pricemax"] =$this->input->post('pricemax');
				$data["button_value"]="Update";
				$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('product_pricerange',array(1=>1),'DESC');
				$this->load->view('administrator/price',$data);
			}else{		
				$data["name"] =$this->input->post('name');
				$data["pricemin"] =$this->input->post('pricemin');
				$data["pricemax"] =$this->input->post('pricemax');
				$id=$this->input->post('id');
				$this->Crud_Model->Updatedata($id,'id','product_pricerange',$data);
				$this->session->set_flashdata('success', 'Price Update Successfully.');
				redirect('administrator/master/price');
				exit;
			}
		}else{
			$editdata=$this->Crud_Model->getById($id,'id','product_pricerange');
			$data["id"] = $id;
			$data["button_value"]="Update";
			$data['name']=$editdata['name'];
			$data['pricemax']=$editdata['pricemax'];
			$data['pricemin']=$editdata['pricemin'];
			$data['page_title']='Category';
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('product_pricerange',array(1=>1),'DESC');
			$this->load->view('administrator/price',$data);
		}
	}

	public function trending()
	{ 	
		$timg=$this->Crud_Model->getDatafromtablewhere('trending',array('id'=>1),'ASC')[0];	
		$data['page_title']='Trending Product';		
		$data['photo'] = $timg['image'];
		$this->load->view('administrator/trending',$data);
	}
	public function uptrending()
	{
		$this->form_validation->set_rules('image', '', 'callback_file_check_trending');
		if ($this->form_validation->run() == FALSE) {
			$timg=$this->Crud_Model->getDatafromtablewhere('trending',array('id'=>1),'ASC')[0];	
			$data['page_title']='Trending Product';		
			$data['photo'] = $timg['image'];
			$this->load->view('administrator/trending',$data);		
		}else{		
			
			if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="")
			{
				$config['upload_path']   = 'uploads/trending/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = TRUE;
                $config['max_width']  = '966';
        		$config['max_height']  = '1457';
                $this->load->library('upload', $config);
                if($this->upload->do_upload('image')){

                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];                   
                    $data['image'] = $uploadedFile;
                    $editdata=$this->Crud_Model->getById(1,'id','trending');
					unlink('uploads/trending/'.$editdata['image']);
					$this->Crud_Model->Updatedata(1,'id','trending',$data);
                }	
               
            }	
			$this->session->set_flashdata('success', 'Trending Image Update Successfully.');
			redirect('administrator/master/trending');
			exit;
		}
	}

	public function file_check_trending($str){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr))
            {
            	 list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
            	 if ($width != 966 || $height != 1457 )
            	 {
            	 	$this->form_validation->set_message('file_check_trending', 'Invaliad Width / Height.');
                	return false;
            	 }else
            	 { 
                	return true;
                }
            }else{
                $this->form_validation->set_message('file_check_trending', 'Please select only Image file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check_trending', 'Please choose a file to upload.');
            return false;
        }
    }
    //TRENDING END

    public function welcomenote()
	{ 	
		$timg=$this->Crud_Model->getDatafromtablewhere('welcomenote',array('id'=>1),'ASC')[0];	
		$data['page_title']='Welcome Note';		
		$data['photo'] = $timg['image'];
		$data['title'] = $timg['title'];
		$data['status'] = $timg['status'];
		$data['description'] = $timg['description'];
		$this->load->view('administrator/welcomenote',$data);
	}
	public function upwelcomenote()
	{
		$this->form_validation->set_rules('image', '', 'callback_file_check_welcomenote');
		if ($this->form_validation->run() == FALSE) {
			$timg=$this->Crud_Model->getDatafromtablewhere('welcomenote',array('id'=>1),'ASC')[0];	
			$data['page_title']='Trending Product';		
			$data['photo'] = $timg['image'];
			$data['title'] = $timg['title'];
			$data['description'] = $timg['description'];
			$data['status'] = $timg['status'];
			$this->load->view('administrator/welcomenote',$data);		
		}else{		
			
			if($this->input->post('title'))
			{
				$this->Crud_Model->Updatedata(1,'id','welcomenote',array('title'=>trim($this->input->post('title'))));
			}
			if($this->input->post('description'))
			{
				$this->Crud_Model->Updatedata(1,'id','welcomenote',array('description'=>trim($this->input->post('description'))));
			}
			if($this->input->post('displaycheck'))
			{
				$status=1;
			}else{
				$status=0;
			}
			$this->Crud_Model->Updatedata(1,'id','welcomenote',array('status'=>$status));

			if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="")
			{
				$config['upload_path']   = 'uploads/welcomenote/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = TRUE;
                $config['max_width']  = '1030';
        		$config['max_height']  = '560';
                $this->load->library('upload', $config);
                if($this->upload->do_upload('image')){
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];                   
                    $data['image'] = $uploadedFile;
                    $editdata=$this->Crud_Model->getById(1,'id','welcomenote');
					unlink('uploads/welcomenote/'.$editdata['image']);
					$this->Crud_Model->Updatedata(1,'id','welcomenote',$data);
                }	
            }	
			$this->session->set_flashdata('success', 'Welcome Note Update Successfully.');
			redirect('administrator/master/welcomenote');
			exit;
		}
	}
	public function file_check_welcomenote($str){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr))
            {
            	 list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
            	 if ($width != 1030 || $height != 560 )
            	 {
            	 	$this->form_validation->set_message('file_check_welcomenote', 'Invaliad Width / Height.');
                	return false;
            	 }else
            	 { 
                	return true;
                }
            }else{
                $this->form_validation->set_message('file_check_welcomenote', 'Please select only Image file.');
                return false;
            }
        }/*else{
            $this->form_validation->set_message('file_check_welcomenote', 'Please choose a file to upload.');
            return false;
        }*/
    }

}
?>