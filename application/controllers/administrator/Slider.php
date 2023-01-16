<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends MY_Controller  {
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/Crud_Model');
		$this->is_admin_logged_in();
	}
	public function index()
	{ 		
		$data = array();
		$data['page_title']='slider';
		$data['viewdata']=$this->Crud_Model->getDatafromtable('slider');
		$data['button_value'] = 'Add Slider';
		$data['name']='';
		$data['id']='';
		$this->load->view('administrator/slider',$data);
	}
	public function add()
	{	
		$this->load->helper('file');
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('linkurl', 'Link', 'required');
            $this->form_validation->set_rules('image', '', 'callback_file_check');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["name"] =$this->input->post('name');
				//$data["linkurl"] =$this->input->post('linkurl');
				$data["button_value"]="Add";
				$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
				$this->load->view('administrator/slider',$data);
			}else{		
				$data["title"] =$this->input->post('name');
				$data["linkurl"] =$this->input->post('linkurl');
				$data["subtitle"] =$this->input->post('linkurl');
				$data["description"] =$this->input->post('linkurl');
				$data["linktext"] =$this->input->post('linkurl');
				$cnt = $this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
				$data["displayorder"] =count($cnt)+1;
				$data["isdelete"] =0;
				$data["createdip"] =0;
				$data["status"] =1;
				$data["created_datetime"] =date("Y-m-d H:i:s");

				$config['upload_path']   = 'uploads/slider/';
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['encrypt_name'] = TRUE;
               // $config['max_size']      = 1024;
                $config['max_width']  = '1920';
        		$config['max_height']  = '844';
                $this->load->library('upload', $config);
                if($this->upload->do_upload('image')){
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];                   
                    $data['image'] = $uploadedFile;
                }			
				$this->Crud_Model->InsertData('slider',$data);
				$this->session->set_flashdata('success', 'Slider Inserted Successfully.');
				redirect('administrator/slider');
				exit;
			}
		
		}
		else
		{ 
			$data["id"] = "";
			$data['name']='';
			$data['linkurl']='';
			$data["button_value"]="Add";
			$data['page_title']='Slider';
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
			$this->load->view('administrator/slider',$data);
		}	
	}

	public function file_check($str){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr))
            {
            	 list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
            	 if ($width != 1920 || $height != 844 )
            	 {
            	 	$this->form_validation->set_message('file_check', 'Invaliad Width / Height.');
                	return false;
            	 }else
            	 { 
                	return true;
                }
            }else{
                $this->form_validation->set_message('file_check', 'Please select only jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }


	public function editview($id){
		$editdata=$this->Crud_Model->getById($id,'id','slider');
		$data["id"] = $id;
		$data["button_value"]="Update";
		$data['name']=$editdata['title'];
		$data['linkurl']=$editdata['linkurl'];
		$data['image']=$editdata['image'];
		$data['page_title']='Slider';
		$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
		$this->load->view('administrator/slider',$data);
	}
	public function edit()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
	//	$this->form_validation->set_rules('linkurl', 'Link', 'required');
		$this->form_validation->set_rules('image', 'Image', 'callback_file_check_edit');
		if ($this->form_validation->run() == FALSE) {
			$data["id"] = $this->input->post('id');
			$data["name"] =$this->input->post('name');
			$data["linkurl"] =$this->input->post('linkurl');
			$data["button_value"]="Update";
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
			$this->load->view('administrator/slider',$data);
			
		}else{		
			$data["title"] =$this->input->post('name');
			$data["linkurl"] =$this->input->post('linkurl');
			$data["subtitle"] =$this->input->post('linkurl');
			$data["description"] =$this->input->post('linkurl');
			$data["linktext"] =$this->input->post('linkurl');

			if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="")
			{

				$config['upload_path']   = 'uploads/slider/';
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['encrypt_name'] = TRUE;
               // $config['max_size']      = 1024;
                $config['max_width']  = '1920';
        		$config['max_height']  = '844';
                $this->load->library('upload', $config);
                if($this->upload->do_upload('image')){
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];                   
                    $data['image'] = $uploadedFile;
                }
                $editdata=$this->Crud_Model->getById($id,'id','slider');
				unlink('uploads/slider/'.$editdata['image']);
				unlink('uploads/slider/thumbnails/'.$editdata['image']);	
            }		



			$id=$this->input->post('id');
			$fieldName='id';
			$table='slider';
			$this->Crud_Model->Updatedata($id,$fieldName,$table,$data);
			$this->session->set_flashdata('success', 'Slider Update Successfully.');
			redirect('administrator/slider');
			exit;
		}
	}

	public function file_check_edit($str){
		
	        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
	        $mime = get_mime_by_extension($_FILES['image']['name']);
	        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
	            if(in_array($mime, $allowed_mime_type_arr))
	            {
	            	 list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
	            	 if ($width != 1920 || $height != 844 )
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


	public function delete($id)
	{
		if($id !='')
		{
			$editdata=$this->Crud_Model->getById($id,'id','slider');
			unlink('uploads/slider/'.$editdata['image']);
			unlink('uploads/slider/thumbnails/'.$editdata['image']);
			$this->Crud_Model->DeletData($id,'id','slider');
			$this->session->set_flashdata('success', 'Slider Deleted Successfully.');
			redirect('administrator/slider'); exit;
		}
	}
}
?>