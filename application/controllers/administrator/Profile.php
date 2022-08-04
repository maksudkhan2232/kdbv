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
		$user=$this->session->userdata('KDBhindiAdminSession');
	    $editdata=$this->Crud_Model->getById($user->id,'id','admin');
		$data["button_value"]="Update";
		$data["name"]=$editdata['name'];
		$data['email']=$editdata['email'];
		$data['image']=$editdata['image'];
		$data['page_title']='Profile';
		$data['firm'] = $editdata;
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
	
	public function password()
	{
		if(count($this->input->post()) > 0 )
		{
			$username = trim($this->input->post('username'));
			$oldpassword = trim($this->input->post('oldpassword'));
			$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');		
			$user=$this->session->userdata('KDBhindiAdminSession');
			if ($this->form_validation->run() == FALSE) {
				
				$user=$this->session->userdata('KDBhindiAdminSession');
			    $editdata=$this->Crud_Model->getById($user->id,'id','admin');
				$data["button_value"]="Update";
				$data["name"]=$editdata['name'];
				$data['email']=$editdata['email'];
				$data['image']=$editdata['image'];
				$data['page_title']='Profile';
				$data['firm'] = $editdata;
				$this->load->view('administrator/profile',$data);
			}
			else
			{
				$checkuser = $this->Crud_Model->getById($user->id,'id','admin');
				if($checkuser['password'] == md5($oldpassword))
				{
					$data['password'] = md5(trim($this->input->post('password')));
					$data['org_password'] = trim($this->input->post('password'));
					$this->Crud_Model->Updatedata($user->id,'id','admin',$data);
					$this->session->set_flashdata('success', 'Profile Updated Successfully.');
					redirect('administrator/profile');
					exit;
				}
				else
				{
					$this->session->set_flashdata("errors","Error : Old Password was wrong, Please Try Again !");
					redirect('administrator/profile');
					exit;
				}
				exit;				
			}
		}
		else
		{
			$user=$this->session->userdata('KDBhindiAdminSession');
		    $editdata=$this->Crud_Model->getById($user->id,'id','admin');
			$data["button_value"]="Update";
			$data["name"]=$editdata['name'];
			$data['email']=$editdata['email'];
			$data['image']=$editdata['image'];
			$data['page_title']='Profile';
			$data['firm'] = $editdata;
			$this->load->view('administrator/profile',$data);
		}
	}
	public function contact()
	{
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('firm_name', 'Firm name', 'trim|required');
			$this->form_validation->set_rules('slogan', 'slogan', 'required');
			$this->form_validation->set_rules('address', 'address', 'required');
			$this->form_validation->set_rules('cemail', 'Contact email', 'required');		
			$this->form_validation->set_rules('contactno', 'Contact no', 'required|numeric');		
			$user=$this->session->userdata('KDBhindiAdminSession');
			if ($this->form_validation->run() == FALSE) {
				$user=$this->session->userdata('KDBhindiAdminSession');
			    $editdata=$this->Crud_Model->getById($user->id,'id','admin');
				$data["button_value"]="Update";
				$data["name"]=$editdata['name'];
				$data['email']=$editdata['email'];
				$data['image']=$editdata['image'];
				$data['page_title']='Profile';
				$data['firm'] = $editdata;
				$this->load->view('administrator/profile',$data);
			}
			else
			{
				$data['firm_name']=$this->input->post('firm_name');
				$data['slogan']=$this->input->post('slogan');
				$data['address']=$this->input->post('address');
				$data['cemail']=$this->input->post('cemail');
				$data['contactno']=$this->input->post('contactno');				
				$this->Crud_Model->Updatedata($user->id,'id','admin',$data);
				//echo $this->db->last_query(); exit;
				$this->session->set_flashdata('success', 'Conatct Updated Successfully.');
				redirect('administrator/profile');
				exit;						
			}
		}
		else
		{
			$user=$this->session->userdata('KDBhindiAdminSession');
		    $editdata=$this->Crud_Model->getById($user->id,'id','admin');
			$data["button_value"]="Update";
			$data["name"]=$editdata['name'];
			$data['email']=$editdata['email'];
			$data['image']=$editdata['image'];
			$data['page_title']='Profile';
			$data['firm'] = $editdata;
			$this->load->view('administrator/profile',$data);
		}
	}
	public function social()
	{
		if(count($this->input->post()) > 0 )
		{
			if($this->input->post('facebook'))
			{
				$data['facebook']=$this->input->post('facebook');
			}
			if($this->input->post('twitter'))
			{
				$data['twitter']=$this->input->post('twitter');
			}
			if($this->input->post('instagram'))
			{
				$data['instagram']=$this->input->post('instagram');
			}
			if($this->input->post('linkedin'))
			{
				$data['linkedin']=$this->input->post('linkedin');
			}
			if($this->input->post('website'))
			{
				$data['website']=$this->input->post('website');
			}
			if($this->input->post('youtube'))
			{
				$data['youtube']=$this->input->post('youtube');
			}
			if($this->input->post('pinterest'))
			{
				$data['pinterest']=$this->input->post('pinterest');
			}
			$user=$this->session->userdata('KDBhindiAdminSession');
			$this->Crud_Model->Updatedata($user->id,'id','admin',$data);
			//echo $this->db->last_query(); exit;

			$this->session->set_flashdata('success', 'Social Links Updated Successfully.');
			redirect('administrator/profile');
			exit;						
			
		}
		else
		{
			$user=$this->session->userdata('KDBhindiAdminSession');
		    $editdata=$this->Crud_Model->getById($user->id,'id','admin');
			$data["button_value"]="Update";
			$data["name"]=$editdata['name'];
			$data['email']=$editdata['email'];
			$data['image']=$editdata['image'];
			$data['page_title']='Profile';
			$data['firm'] = $editdata;
			$this->load->view('administrator/profile',$data);
		}
	}					

}