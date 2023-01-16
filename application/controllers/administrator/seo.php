<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Seo extends MY_Controller  {
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/Crud_Model');
		$this->is_admin_logged_in();
	}
	public function index()
	{ 		
		$data = array();
		$data['page_title']='seo';
		$data['viewdata']=$this->Crud_Model->getDatafromtable('seo');
		$data['button_value'] = 'Add Seo';
		$data['name']='';
		$data['id']='';		
		$key_values = array_column($data['viewdata'], 'page'); 
		array_multisort($key_values, SORT_ASC, $data['viewdata']);		
		$this->load->view('administrator/seo',$data);
	}
	public function add()
	{	
		$this->load->helper('file');
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('page', 'Select Page Name', 'required');
			$this->form_validation->set_rules('seotitle', 'Seo Title', 'required');
			$this->form_validation->set_rules('seodescription', 'Seo Description', 'required');
			$this->form_validation->set_rules('seokeywords', 'Seo Keywords', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["page"] =$this->input->post('page');
				$data["seotitle"] =$this->input->post('seotitle');
				$data["seodescription"] =$this->input->post('seodescription');
				$data["seokeywords"] =$this->input->post('seokeywords');
				$data["button_value"]="Add";
				$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('seo',array('status'=>1),'DESC');
				$this->load->view('administrator/seo',$data);
			}else{		
				$data["page"] =$this->input->post('page');
				$data["seotitle"] =$this->input->post('seotitle');
				$data["seodescription"] =$this->input->post('seodescription');
				$data["seokeywords"] =$this->input->post('seokeywords');
				$data["status"] =1;
				$data["isdelete"] =0;
				$data["created_datetime"] =date("Y-m-d H:i:s");
				$chk = $this->Crud_Model->getById($data['page'],'page','seo');
				if(empty($chk))
				{
					$this->Crud_Model->InsertData('seo',$data);
				}else{
					$this->Crud_Model->Updatedata($chk['id'],'id','seo',$data);
				}
				$this->session->set_flashdata('success', 'Seo Details Inserted Successfully.');
				redirect('administrator/seo');
				exit;
			}
		}
		else
		{ 
			$data["id"] = "";
			$data['name']='';
			$data['linkurl']='';
			$data["button_value"]="Add";
			$data['page_title']='Seo';
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('seo',array('status'=>1),'DESC');
			$this->load->view('administrator/seo',$data);
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
		$editdata=$this->Crud_Model->getById($id,'id','seo');
		$data["id"] = $id;
		$data["button_value"]="Update";
		$data["page"] =$editdata['page'];
		$data["seotitle"] =$editdata['seotitle'];
		$data["seodescription"] =$editdata['seodescription'];
		$data["seokeywords"] =$editdata['seokeywords'];
		$data['page_title']='Seo';
		$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('seo',array('status'=>1),'DESC');
		$this->load->view('administrator/seo',$data);
	}
	public function edit()
	{
		$this->form_validation->set_rules('page', 'Select Page Name', 'required');
		$this->form_validation->set_rules('seotitle', 'Seo Title', 'required');
		$this->form_validation->set_rules('seodescription', 'Seo Description', 'required');
		$this->form_validation->set_rules('seokeywords', 'Seo Keywords', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data["id"] = $this->input->post('id');
			$data["page"] =$this->input->post('page');
			$data["seotitle"] =$this->input->post('seotitle');
			$data["seodescription"] =$this->input->post('seodescription');
			$data["seokeywords"] =$this->input->post('seokeywords');
			$data["button_value"]="Update";
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
			$this->load->view('administrator/slider',$data);
		}else{		
			$data["page"] =$this->input->post('page');
			$data["seotitle"] =$this->input->post('seotitle');
			$data["seodescription"] =$this->input->post('seodescription');
			$data["seokeywords"] =$this->input->post('seokeywords');
			$id=$this->input->post('id');
			$fieldName='id';
			$table='seo';
			$chk = $this->Crud_Model->getById($data['page'],'page','seo');
			if(empty($chk))
			{
				$this->Crud_Model->InsertData('seo',$data);
			}else{
				$this->Crud_Model->Updatedata($chk['id'],'id','seo',$data);
			}
			$this->session->set_flashdata('success', 'Seo Details Update Successfully.');
			redirect('administrator/seo');
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
			$editdata=$this->Crud_Model->getById($id,'id','seo');
			$this->Crud_Model->DeletData($id,'id','seo');
			$this->session->set_flashdata('success', 'Seo Details Deleted Successfully.');
			redirect('administrator/seo'); exit;
		}
	}
}
?>