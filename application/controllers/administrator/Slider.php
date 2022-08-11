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
			$this->form_validation->set_rules('title', 'title', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["title"] =$this->input->post('title');
				$data["button_value"]="Add";
				$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
				$this->load->view('administrator/slider',$data);
				
			}else{		
				$data["title"] =$this->input->post('title');
				$data["status"] =1;
				$data["isdelete"] =0;
				$data['created_datetime']=date('Y-m-d H:i:s');
				$data['createdip']=$_SERVER['REMOTE_ADDR'];
				// Image Upload
					$folder='slider';
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
					        
				            $_FILES['file']['name']       = $_FILES['image_name']['name'];
				            $_FILES['file']['type']       = $_FILES['image_name']['type'];
				            $_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'];
				            $_FILES['file']['error']      = $_FILES['image_name']['error'];
				            $_FILES['file']['size']       = $_FILES['image_name']['size'];
			                // Uploaded file data
			                $ext=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
			                $image_name = rand(11111,99999).".".$ext;
							$isupload = compress($file_tmp=$_FILES["file"]["tmp_name"],'uploads/slider/'.$image_name, 30);
							$upload_dir_thumb = 'uploads/slider/thumbnails/';
							compress($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir_thumb.$image_name, 1920);
			                $data['image'] = $image_name;
			            }
					}
				// End Image Upload

				$table='slider';
				$this->Crud_Model->InsertData($table,$data);
				
				$this->session->set_flashdata('success', 'Slider Inserted Successfully.');
				redirect('administrator/slider');
				exit;
			}
		}else{ 
			$data["id"] = "";
			$data['title']='';
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
		$data['title']=$editdata['title'];
		$data['image']=$editdata['image'];
		$data['page_title']='Slider';
		$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');
		$this->load->view('administrator/slider',$data);
	}
	public function edit()
	{
		$this->form_validation->set_rules('title', 'title', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data["id"] = $this->input->post('id');
			$data["title"] =$this->input->post('title');
			$data["button_value"]="Update";
			$this->load->view('administrator/slider',$data);
			
		}else{		
			$data["title"] =$this->input->post('title');
			$id=$this->input->post('id');
			$data["status"] =1;
			$data["isdelete"] =0;
			$data['modified_datetime']=date('Y-m-d H:i:s');
			$data['createdip']=$_SERVER['REMOTE_ADDR'];
			// Image Upload
				$folder='slider';
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
				        
			            $_FILES['file']['name']       = $_FILES['image_name']['name'];
			            $_FILES['file']['type']       = $_FILES['image_name']['type'];
			            $_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'];
			            $_FILES['file']['error']      = $_FILES['image_name']['error'];
			            $_FILES['file']['size']       = $_FILES['image_name']['size'];
		                // Uploaded file data
		                $ext=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
		                $image_name = rand(11111,99999).".".$ext;
						$isupload = compress($file_tmp=$_FILES["file"]["tmp_name"],'uploads/slider/'.$image_name, 30);
						$upload_dir_thumb = 'uploads/slider/thumbnails/';
						compress($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir_thumb.$image_name, 1920);
		                $data['image'] = $image_name;
		            }
				}
			// End Image Upload
					
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