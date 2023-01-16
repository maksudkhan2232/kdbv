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

			$this->form_validation->set_rules('cover_image', '', 'callback_file_check_offercover');
			$this->form_validation->set_rules('name', 'Title', 'required');
			
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["name"] =$this->input->post('name');
				$data['cover_image']='';
				$data['image']='';
				$data["button_value"]="Add";
				$this->load->view('administrator/gallery/add_offerzone',$data);
			}else{		
				$data["name"] =trim($this->input->post('name'));				
				$table='offerzone';
				$ins_id = $this->Crud_Model->InsertData($table,$data);
				
				if(isset($_FILES['cover_image']['name']) && $_FILES['cover_image']['name']!="")
				{
					$config['upload_path']   = 'uploads/offer/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['encrypt_name'] = TRUE;
					$config['max_width']  = '966';
					$config['max_height']  = '1457';
					$this->load->library('upload', $config);
					if($this->upload->do_upload('cover_image')){
	
						$uploadData = $this->upload->data();
						$uploadedFile = $uploadData['file_name'];                   
						$data['image'] = $uploadedFile;
					//	$editdata=$this->Crud_Model->getById($ins_id,'id','offerzone');
					//	unlink('uploads/offer/'.$editdata['image']);
						$this->Crud_Model->Updatedata($ins_id,'id','offerzone',$data);
					}	
				   
				}
				
				
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
			$editdata=$this->Crud_Model->getById($id,'id','offerzone');
			$this->form_validation->set_rules('name', 'Title', 'required');
			/*if (empty($_FILES['cover_image']['name']))
			{
			    $this->form_validation->set_rules('cover_image', 'Cover Image', 'required');
			}*/
			if ($this->form_validation->run() == FALSE) {					
				$data["id"] = $id;
				$data["name"] =$this->input->post('name');
				$data['image']=$editdata['image'];
				$data['document']=$editdata['document'];
				$data['page_title']='Offer Zone';
				$data['active_menu'] = 'offerzone';
				$data['sub_active_menu'] = 'offerzone';
				$data["button_value"]="Update";
				$this->load->view('administrator/gallery/add_offerzone',$data);
			}else{		 
				$data["name"] =trim($this->input->post('name'));				
				$ins_id = $this->Crud_Model->Updatedata($id,'id','offerzone',$data);
				
				
				if(!empty($_FILES['cover_image']['name']))
				{
					if(isset($_FILES['cover_image']['name']) && $_FILES['cover_image']['name']!="")
					{
						//echo 'uploads/offer/'.$editdata['image'] ; exit;
						$config['upload_path']   = 'uploads/offer/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['encrypt_name'] = TRUE;
						$config['max_width']  = '900';
						$config['max_height']  = '500';
						$this->load->library('upload', $config);
						if($this->upload->do_upload('cover_image')){
							unlink('uploads/offer/'.$editdata['image']);
							$uploadData = $this->upload->data();
							$uploadedFile = $uploadData['file_name'];                   
							$updata['image'] = $uploadedFile;	
							$this->Crud_Model->Updatedata($id,'id','offerzone',$updata);
						}	
					   
					}
				}				
								
				
				if(!empty($_FILES['image']['name']))
				{
				    if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="")
					{
                      
						unlink('uploads/offer/'.$editdata['document']);
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
	
	public function cover()
	{ 	
		$timg=$this->Crud_Model->getDatafromtablewhere('offer_cover',array('id'=>1),'ASC')[0];	
		$data['page_title']='Offer Zone';		
		$data['photo'] = $timg['image'];
		$data['status'] = $timg['status'];
		$this->load->view('administrator/gallery/offer_cover',$data);
	}
	
	public function coverupdate()
	{
		$this->form_validation->set_rules('image', '', 'callback_file_check_trending');
		if ($this->form_validation->run() == FALSE) {
			$timg=$this->Crud_Model->getDatafromtablewhere('offer_cover',array('id'=>1),'ASC')[0];	
			$data['page_title']='Offer Cover';		
			$data['photo'] = $timg['image'];
			$data['status'] = $timg['status'];
			$this->load->view('administrator/gallery/offer_cover',$data);		
		}else{		
			
			if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="")
			{
				$config['upload_path']   = 'uploads/offer/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = TRUE;
                $config['max_width']  = '1920';
        		$config['max_height']  = '800';
                $this->load->library('upload', $config);
                if($this->upload->do_upload('image')){

                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];                   
                    $data['image'] = $uploadedFile;
                    $editdata=$this->Crud_Model->getById(1,'id','offer_cover');
					unlink('uploads/offer/'.$editdata['image']);
					$this->Crud_Model->Updatedata(1,'id','offer_cover',$data);
                }	
               
            }	
			$this->session->set_flashdata('success', 'Offer Cover Image Update Successfully.');
			redirect('administrator/offerzone/cover');
			exit;
		}
	}
	public function file_check_trending($str){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr))
            {
            	 list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
            	 if ($width != 1920 || $height != 800 )
            	 {
            	 	$this->form_validation->set_message('file_check_trending', 'Invalid Width / Height.');
                	return false;
            	 }else
            	 { 
                	return true;
                }
            }else{
                $this->form_validation->set_message('file_check_trending', 'Please select only Image file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check_trending', 'Please Upoad Image.');
            return false;
        }
    }
	public function file_check_offercover($str){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['cover_image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['cover_image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr))
            {
            	 list($width, $height) = getimagesize($_FILES['cover_image']['tmp_name']);
            	 if ($width != 900 || $height != 500 )
            	 {
            	 	$this->form_validation->set_message('file_check_offercover', 'Error : Invalid Width / Height.');
                	return false;
            	 }else
            	 { 
                	return true;
                }
            }else{
                $this->form_validation->set_message('file_check_offercover', 'Please select only Image file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check_offercover', 'Please Upoad Cover Image.');
            return false;
        }
    }
	

}
?>