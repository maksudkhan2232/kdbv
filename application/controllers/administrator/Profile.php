<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->is_admin_logged_in();
		$this->load->model('administrator/Crud_Model');
	}
	
	public function index()
	{
		$fieldName = 'id';
		$table = "admin";
		$user=$this->session->userdata('KDBhindiAdminSession');
	    $editdata=$this->Crud_Model->getById($user->id,$fieldName,$table);
		$data["button_value"]="Update";
		$data["name"]=$editdata['name'];
		$data['email']=$editdata['email'];
		$data['image']=$editdata['image'];
		$data['page_title']='Profile';
		$this->load->view('administrator/profile',$data);
	}
	public function edit(){
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		}else{		 
			$data['name'] =$this->input->post('name');
			$data['email'] =$this->input->post('email');
			$user=$this->session->userdata('KDBhindiAdminSession');
			
			if(!empty($_FILES['file']['name'])){
				$fieldName = 'id';
				$table = "admin";
				$editdata=$this->Crud_Model->getById($user->id,$fieldName,$table);
				$name = $editdata['image'];
				@unlink("uploads/administrator/".$name);
				@unlink("uploads/administrator/thumb/".$name);
				
				$upload_dir = 'uploads/administrator/';
				$upload_dir_thumb = 'uploads/administrator/thumb/';
				$file_name=$_FILES["file"]["name"];
				$file_tmp=$_FILES["file"]["tmp_name"];
				$ext=pathinfo($file_name,PATHINFO_EXTENSION);
				$file_name =pathinfo($file_name,PATHINFO_FILENAME);
				$file_name = slugify($file_name);
				$new_name = rand(11111,99999)."_".$file_name.".".$ext;
				$isupload = compress($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir.$new_name, 30);
				square_crop($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir_thumb.$new_name, 400);
				if($isupload)
				{
					$data['image'] = $new_name;
				}
			}
			$id = $user->id;
			$fieldName = 'id';
		    $table = "admin";
			$this->Crud_Model->Updatedata($id,$fieldName,$table,$data);
			$this->session->set_flashdata('success', 'Profile Update Successfully.');
			redirect('administrator/profile');
			exit;
		}
	 
	}
}
