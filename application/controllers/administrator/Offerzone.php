<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Offerzone extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->is_admin_logged_in();
		$this->load->model('administrator/Crud_Model');
	}
	
	
	public function index()
	{
		$data['page_title']='Offer Zone';
		$data['active_menu'] = 'offerzone';
		$data['sub_active_menu'] = 'offzerzone';
		$data['viewdata']=$this->Crud_Model->getDatafromtable('offerzone');
		$this->load->view('administrator/gallery/offerzone',$data);
	}
	public function add_offerzone()
	{	
		if(count($this->input->post()) > 0 )
		{

			$this->form_validation->set_rules('name', 'Title', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["name"] =$this->input->post('name');
				$data['image']='';
				$data["button_value"]="Add";
				$this->load->view('administrator/gallery/add_offerzone',$data);
			}else{		
				$data["name"] =trim($this->input->post('name'));
				$data['image'] = $this->input->post('cover_image');
				$table='offerzone';
				$ins_id = $this->Crud_Model->InsertData($table,$data);
				if(!empty($_FILES['image']['name']))
				{
				    if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="")
					{
                        $fileInfo = pathinfo($_FILES["image"]["name"]);
                        $img_name = time().rand().'.'.$fileInfo['extension'];
                        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/offer/" . $img_name);
                        $uploadImgData['document'] = $img_name;
			            $ins_id = $this->Crud_Model->Updatedata($ins_id,'id','offerzone',$uploadImgData);                     
		            }		                
				}
							//print_r($_POST); echo "FFF" ;exit;
				$this->session->set_flashdata('success', 'Offer Added Successfully.');
				redirect('administrator/offerzone','refresh');
				
				exit;
			}
		}else{ 
			$data["id"] = "";
			$data['name']='';
			$data['image']='';
			$data["button_value"]="Add";
			$data['page_title']='Offer Zone';
			$this->load->view('administrator/gallery/add_offerzone',$data);
		}	
	}
	public function edit_offerzone($id)
	{
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Title', 'required');
			if (empty($_FILES['cover_image']['name']))
			{
			    $this->form_validation->set_rules('cover_image', 'Cover Image', 'required');
			}
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["name"] =$this->input->post('name');
				$data['image']=$this->input->post('cover_image');
				$data["button_value"]="Update";
				$this->load->view('administrator/gallery/add_offerzone',$data);
			}else{		 
				$data["name"] =trim($this->input->post('name'));
				$data['image'] = $this->input->post('cover_image');
				if($this->input->post('bannnerno') != '' && $this->input->post('old_image') != '')
				{
					unlink('uploads/offer/'.$this->input->post('old_image'));
				}
				$ins_id = $this->Crud_Model->Updatedata($id,'id','offerzone',$data);
				if(!empty($_FILES['image']['name']))
				{
				    if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="")
					{
                        $fileInfo = pathinfo($_FILES["image"]["name"]);
                        $img_name = time().rand().'.'.$fileInfo['extension'];
                        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/offer/" . $img_name);
                        $uploadImgData['document'] = $img_name;
			            $ins_id = $this->Crud_Model->Updatedata($id,'id','offerzone',$uploadImgData);                     
		            }		                
				}
				$this->session->set_flashdata('success', 'Offer Updated Successfully.');
				redirect('administrator/offerzone');
				exit;
			}
		}
		else
		{
			$editdata=$this->Crud_Model->getById($id,'id','offerzone');
			$data["id"] = $id;
			$data["button_value"]="Update";
			$data['name']=$editdata['name'];
			$data['image']=$editdata['image'];
			$data['document']=$editdata['document'];
			$data['page_title']='Offer Zone';
			$data['active_menu'] = 'offerzone';
			$data['sub_active_menu'] = 'offerzone';
			$this->load->view('administrator/gallery/add_offerzone',$data);
		}
	}
	public function delete_sub_photo($row_id)
	{
		$editdata=$this->Crud_Model->getById($row_id,'id','offerzone');
		unlink('uploads/offer/'.$editdata['document']);
		$uploadImgData['document'] = "";
		$ins_id = $this->Crud_Model->Updatedata($row_id,'id','offerzone',$uploadImgData);
	}
	public function delete_offerzone($row_id)
	{
		$sub_event = $this->Crud_Model->getDatafromtablewhere('offerzone',array('id'=>$row_id));
		foreach ($sub_event as $key => $value) {
			unlink('uploads/offer/'.$value['document']);
		}
		$editdata=$this->Crud_Model->getById($row_id,'id','offerzone');
		unlink('uploads/offer/'.$editdata['image']);
		$delete = $this->Crud_Model->DeletData($row_id,'id','offerzone');
		return redirect('administrator/offerzone');
	}


}
?>