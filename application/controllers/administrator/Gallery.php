<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->is_admin_logged_in();
		$this->load->model('administrator/Crud_Model');
	}
	
	
	public function photo()
	{
		$data['page_title']='Photo Gallery';
		$data['active_menu'] = 'gallery';
		$data['sub_active_menu'] = 'photo';
		$data['viewdata']=$this->Crud_Model->getDatafromtable('photo_gallery');
		$this->load->view('administrator/gallery/photo',$data);
	}
	public function add_photo()
	{	
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Title', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["name"] =$this->input->post('name');
				$data['image']='';
				$data["button_value"]="Add";
				$this->load->view('administrator/gallery/add_photo',$data);
			}else{		
				$data["name"] =trim($this->input->post('name'));
				$data['image'] = $this->input->post('cover_image');
				$table='photo_gallery';
				$ins_id = $this->Crud_Model->InsertData($table,$data);
				if(!empty($_FILES['image_name']['name'][0]))
				{
					$image = array();
					$ImageCount = count($_FILES['image_name']['name']);
					if($ImageCount > 0)
					{
				        for($i = 0; $i < $ImageCount; $i++){
				            $_FILES['file']['name']       = $_FILES['image_name']['name'][$i];
				            $_FILES['file']['type']       = $_FILES['image_name']['type'][$i];
				            $_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'][$i];
				            $_FILES['file']['error']      = $_FILES['image_name']['error'][$i];
				            $_FILES['file']['size']       = $_FILES['image_name']['size'][$i];
			                // Uploaded file data
			                $ext=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
			                $image_name = rand(11111,99999).".".$ext;
							$isupload = compress($file_tmp=$_FILES["file"]["tmp_name"],'uploads/photo/'.$image_name, 30);
							$upload_dir_thumb = 'uploads/photo/thumb/';
							square_crop($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir_thumb.$image_name, 400);
			                $uploadImgData['event_id'] = $ins_id;
			                $uploadImgData['image_name'] = $image_name;
			                $this->Crud_Model->InsertData('photo_gallery_detail',$uploadImgData);
				        }
				    }
				}
				$this->session->set_flashdata('success', 'Gallery Inserted Successfully.');
				redirect('administrator/gallery/photo','refresh');
				
				exit;
			}
		}else{ 
			$data["id"] = "";
			$data['name']='';
			$data['image']='';
			$data["button_value"]="Add";
			$data['page_title']='Photo Gallery';
			$this->load->view('administrator/gallery/add_photo_gallery',$data);
		}	
	}
	public function edit_photo($id)
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
				$data['event_detail'] = $this->Crud_Model->getDatafromtablewhere('photo_gallery_detail',array('event_id'=>$id));
				$data["button_value"]="Update";
				$this->load->view('administrator/gallery/add_event',$data);
			}else{		 
				$data["name"] =trim($this->input->post('name'));
				$data['image'] = $this->input->post('cover_image');
				if($this->input->post('bannnerno') != '' && $this->input->post('old_image') != '')
				{
					unlink('uploads/photo/'.$this->input->post('old_image'));
				}
				$ins_id = $this->Crud_Model->Updatedata($id,'id','photo_gallery',$data);
				if(!empty($_FILES['image_name']['name'][0]))
				{
					$image = array();
					$ImageCount = count($_FILES['image_name']['name']);
					if($ImageCount > 0)
					{
				        for($i = 0; $i < $ImageCount; $i++){
				            $_FILES['file']['name']       = $_FILES['image_name']['name'][$i];
				            $_FILES['file']['type']       = $_FILES['image_name']['type'][$i];
				            $_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'][$i];
				            $_FILES['file']['error']      = $_FILES['image_name']['error'][$i];
				            $_FILES['file']['size']       = $_FILES['image_name']['size'][$i];
			                // Uploaded file data
			                $ext=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
			                $image_name = rand(11111,99999).".".$ext;
			                //echo $image_name; exit;
							$isupload = compress($file_tmp=$_FILES["file"]["tmp_name"],'uploads/photo/'.$image_name, 30);
							$upload_dir_thumb = 'uploads/photo/thumb/';
							square_crop($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir_thumb.$image_name, 400);
			                $uploadImgData['event_id'] = $id;
			                $uploadImgData['image_name'] = $image_name;
			                $this->Crud_Model->InsertData('photo_gallery_detail',$uploadImgData);
				        }
				    }
				}
				$this->session->set_flashdata('success', 'Gallery Updated Successfully.');
				redirect('administrator/gallery/photo');
				exit;
			}
		}
		else
		{
			$editdata=$this->Crud_Model->getById($id,'id','photo_gallery');
			$data["id"] = $id;
			$data["button_value"]="Update";
			$data['name']=$editdata['name'];
			$data['image']=$editdata['image'];
			$data['event_detail'] = $this->Crud_Model->getDatafromtablewhere('photo_gallery_detail',array('event_id'=>$id));
			$data['page_title']='Photo Gallery';
			$data['active_menu'] = 'gallery';
			$data['sub_active_menu'] = 'event';
			$this->load->view('administrator/gallery/add_photo_gallery.php',$data);
		}
	}
	public function delete_sub_photo($row_id)
	{
		$editdata=$this->Crud_Model->getById($row_id,'id','photo_gallery_detail');
		unlink('uploads/photo/'.$editdata['image_name']);
		unlink('uploads/photo/thumb/'.$editdata['image_name']);
		$delete = $this->Crud_Model->DeletData($row_id,'id','photo_gallery_detail');
	}
	public function delete_photo($row_id)
	{
		$sub_event = $this->Crud_Model->getDatafromtablewhere('photo_gallery_detail',array('event_id'=>$row_id));
		foreach ($sub_event as $key => $value) {
			unlink('uploads/photo/'.$value['image_name']);
			unlink('uploads/photo/thumb/'.$value['image_name']);
			$delete = $this->Crud_Model->DeletData($value['id'],'id','photo_gallery_detail');
		}
		$editdata=$this->Crud_Model->getById($row_id,'id','photo_gallery');
		unlink('uploads/photo/'.$editdata['image']);
		$delete = $this->Crud_Model->DeletData($row_id,'id','photo_gallery');
		return redirect('administrator/gallery/photo');
	}


}
?>