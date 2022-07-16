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
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["name"] =$this->input->post('name');
				$data["button_value"]="Add";
				$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
				$this->load->view('administrator/slider',$data);
				
			}else{		
				$data["name"] =$this->input->post('name');
				$table='slider';
				$this->Crud_Model->InsertData($table,$data);
				$this->session->set_flashdata('success', 'Slider Inserted Successfully.');
				redirect('administrator/slider');
				exit;
			}
		}else{ 
			$data["id"] = "";
			$data['name']='';
			$data["button_value"]="Add";
			$data['page_title']='Slider';
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
			$this->load->view('administrator/slider',$data);
		}	
	}
	public function editview($id){
		$fieldName = 'id';
		$table = "slider";
		$editdata=$this->Crud_Model->getById($id,$fieldName,$table);
		$data["id"] = $id;
		$data["button_value"]="Update";
		$data['name']=$editdata['name'];
		$data['page_title']='Slider';
		$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
		$this->load->view('administrator/slider',$data);
	}
	public function edit()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data["id"] = $this->input->post('id');
			$data["name"] =$this->input->post('name');
			$data["button_value"]="Update";
			$this->load->view('administrator/slider',$data);
			
		}else{		
			$data["name"] =$this->input->post('name');
			$id=$this->input->post('id');
			$fieldName='id';
			$table='slider';
			$this->Crud_Model->Updatedata($id,$fieldName,$table,$data);
			$this->session->set_flashdata('success', 'Slider Update Successfully.');
			redirect('administrator/slider');
			exit;
		}
	}
	public function delete($id)
	{
		if($id !='')
		{
			$this->Crud_Model->DeletData($id,'id','slider');
			redirect('administrator/slider'); exit;
		}
	}
}
?>