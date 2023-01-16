<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->is_admin_logged_in();
		$this->load->model('administrator/Crud_Model');
	}
	
	public function index()
	{
		
	    if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('opassword', 'Old Password', 'trim|required');
			$this->form_validation->set_rules('npassword', 'Password', 'required');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[npassword]');
			if($this->form_validation->run() == FALSE) {
			
			
			}else{
				$fieldName = 'id';
				$table = "admin";
				$user=$this->session->userdata('KDBhindiAdminSession');
				$editdata=$this->Crud_Model->getById($user->id,$fieldName,$table);
				$db_password=$editdata['password'];
				if ((md5($this->input->post('opassword')) == $db_password) && ($this->input->post('npassword') != '') && ($this->input->post('cpassword')!='')) 
					{ 
			
						if($this->input->post('cpassword')==$this->input->post('npassword')){
							$fixed_pw = md5($this->input->post('npassword'));
							$data1['password']=$fixed_pw;
							$data1['org_password']=$this->input->post('npassword');
							$id = $user->id;
							$fieldName = 'id';
							$table = "admin";
							$this->Crud_Model->Updatedata($id,$fieldName,$table,$data1);
							
							$this->session->set_flashdata('success', 'Password Update Successfully!');
							redirect('administrator/change_password');
				            exit;
						}
					}
					else{
						$this->session->set_flashdata('errors', 'Wrong Old Password!');	
						redirect('administrator/change_password');
				        exit;		
					}	
			}
		}
		$data["button_value"]="Change Password";
		$data['page_title']='Change Password';
		$this->load->view('administrator/change_password',$data);
	}
}
