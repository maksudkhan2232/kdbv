<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->is_admin_logged_in();
		$this->load->model('administrator/Crud_Model');
	}
	
	public function index()
	{
		$data['page_title']='Testimonial';
		$data['active_menu'] = 'testimonial';
		$data['sub_active_menu'] = '';
		$data['viewdata']=$this->Crud_Model->getDatafromtable('testimonial');
		$this->load->view('administrator/view_testimonial',$data);
	}
	public function add()
	{	
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('desc', 'Description', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["name"] =$this->input->post('name');
				$data["city"] =$this->input->post('city');
				$data["desc"] =$this->input->post('desc');
				$data['image']='';
				$data["button_value"]="Add";
				$this->load->view('administrator/add_testimonial',$data);
				
			}else{		
				$data["name"] =$this->input->post('name');
				$data["city"] =$this->input->post('city');
				$data["desc"] =$this->input->post('desc');
				if($this->input->post('home_page'))
				{
					$homepage = 1;
				}else{
					$homepage = 0;
				}
				$data['homepage']= $homepage;
				$data['image'] = $this->input->post('cover_image');
				$this->Crud_Model->InsertData('testimonial',$data);
				$this->session->set_flashdata('success', 'Testimonial Inserted Successfully.');
				redirect('administrator/testimonial');
				exit;
			}
		}else{ 
			$data["id"] = "";
			$data['name']='';
			$data['city']='';
			$data['image']='';
			$data['desc']='';
			$data['homepage']=0;
			$data["button_value"]="Add";
			$data['page_title']='Testimonial';
			$this->load->view('administrator/add_testimonial',$data);
		}	
	}
	public function editview($id)
	{
		$editdata=$this->Crud_Model->getById($id,'id','testimonial');
		$data["id"] = $id;
		$data["button_value"]="Update";
		$data['name']=$editdata['name'];
		$data['city']=$editdata['city'];
		$data['desc']=$editdata['desc'];
		$data['homepage']=$editdata['homepage'];
		$data['image']=$editdata['image'];
		$data['page_title']='Testmonial';
		$data['active_menu'] = 'testimonial';
		$data['sub_active_menu'] = '';
		$this->load->view('administrator/add_testimonial',$data);
	}
	public function edit(){
	
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('desc', 'Description', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data["id"] = $this->input->post('id');
			$data["name"] =$this->input->post('name');
			$data["city"] =$this->input->post('city');
			$data['desc']= $this->input->post('desc');
			$data['image']='';
			$data["button_value"]="Update";
			$this->load->view('administrator/add_testimonial',$data);
			
		}else{		
			$data["name"] =$this->input->post('name');
			$data["city"] =$this->input->post('city');
			$data['desc']= $this->input->post('desc');
			if($this->input->post('home_page'))
			{
				$homepage = 1;
			}else{
				$homepage = 0;
			}
			$data['homepage']= $homepage;
			$data['image'] = $this->input->post('cover_image');
			if($this->input->post('bannnerno') != '' && $this->input->post('old_image') != '')
			{
				unlink('uploads/testimonial/'.$this->input->post('old_image'));
			}
			$id=$this->input->post('id');
			$this->Crud_Model->Updatedata($id,'id','testimonial',$data);
			$this->session->set_flashdata('success', 'Testimonial Update Successfully.');
			redirect('administrator/testimonial');
			exit;
		}
	}
	public function delete($id)
	{
		if($id !='')
		{
			$editdata=$this->Crud_Model->getById($id,'id','testimonial');
			if($editdata['image'] != '')
			{
				unlink('uploads/testimonial/'.$editdata['image']);
			}
			$this->Crud_Model->DeletData($id,'id','testimonial');
			redirect('administrator/testimonial'); exit;
		}
	}
}
