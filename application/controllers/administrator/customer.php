<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->is_admin_logged_in();
		$this->load->model('administrator/Crud_Model');
	}
	
	public function index()
	{
		$data['page_title']='Customer';
		$data['active_menu'] = 'customer';
		$data['sub_active_menu'] = '';
		$data['viewdata']=$this->Crud_Model->GetCustomerDetails('');
		$this->load->view('administrator/view_customer',$data);
	}
	public function view_customer_ajax_data()
	{
		$requestData= $_REQUEST;
		
		$tot_rec=$this->db->select("id")->from('billing_customer')->where('status',1)->get()->result_array();
		$totalData = count($tot_rec);
       	$totalFiltered = $totalData; 	
		$this->db->select("c.*,co.name as countryname,s.name as statename");
        $this->db->from('billing_customer as c');                
        if(!empty($requestData['search']['value'])) {
        	$this->db->group_start();
            $this->db->or_like('c.name',$requestData['search']['value']);
            $this->db->or_like('c.mobileno',$requestData['search']['value']);
            $this->db->or_like('c.address',$requestData['search']['value']);
            $this->db->or_like('c.email',$requestData['search']['value']);
            $this->db->group_end();
        }
        $this->db->join('billing_country as co', 'co.id = c.country','LEFT');
        $this->db->join('billing_state as s', 's.id = c.state','LEFT');
        $this->db->where('c.status',1);
		$this->db->order_by('c.id','DESC');
        $this->db->limit($requestData['length'], $requestData['start']);
        $query1 = $this->db->get();
        $row=$query1->result_array();	
        //echo $this->db->last_query();			
		$k=$requestData['start'] + 1;
        $data = array();
        foreach ($row as $key => $val) 
        { 
			$mylink = base_url()."administrator/order/view/".md5($val['OrderID']); 
            $nestedData = array();
            $nestedData[] = $k;
            $nestedData[] = $val['name'];
            $nestedData[] = $val['mobileno'];
            $nestedData[] = $val['email'];
            $nestedData[] = $val['city'].' - '.$val['pincode'];
            $nestedData[] = $val['name'];
			if($val['status'] == 1){ 
                $nestedData[] = '<button type="button" class="btn btn-sm btn-toggle changestatus active" data-table="billing_customer" data-field="status" data-id-name="id" data-id="'.$val['id'].'" data-toggle="button" aria-pressed="1" autocomplete="off"><div class="handle"></div></button>';
            } else { 
                $nestedData[] ='<button type="button" class="btn btn-sm btn-toggle changestatus" data-table="billing_customer" data-field="status" data-id-name="id" data-id="'.$val['id'].'" data-toggle="button" aria-pressed="0" autocomplete="off"><div class="handle"></div></button>';
            }
            $nestedData[] = date('d M Y',strtotime($val['created_datetime']));
            //$nestedData[] = '<a  href="'.$mylink.'" target="_blank" class="btn btn-outline-primary" >View</a>';            
            $data[] = $nestedData;
            $k++  ; 			
        }
        $json_data = array(
            "draw"            =>intval($requestData['draw']),  
            "recordsTotal"    => intval( $totalData ),  
            "recordsFiltered" => intval( $totalFiltered ), 
            "data"            => $data   
            );
        echo json_encode($json_data);  // send data as json format 
	} 

	public function add()
	{	
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["name"] =$this->input->post('name');
				$data["city"] =$this->input->post('city');
				$data["weblink"] =$this->input->post('weblink');
				$data['image']='';
				$data['category']= array();
				$data["button_value"]="Add";
				$this->load->view('administrator/add_advertisement',$data);
				
			}else{		
				$data["name"] =$this->input->post('name');
				$data["city"] =$this->input->post('city');
				$data["weblink"] =$this->input->post('weblink');
				$cat_arr =$this->input->post('add_category');
				$data["category"] = implode(",",$cat_arr);
				if(!empty($_FILES['file']['name'])){
					// Get Image Dimension
				    $fileinfo = @getimagesize($_FILES["file"]["tmp_name"]);
				    $width = $fileinfo[0];
				    $height = $fileinfo[1];
				    // Get image file extension
    				$file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    				if (! in_array($file_extension, $this->config->item('allowed_image_extension'))) {
    					$this->session->set_flashdata('errors', 'Upload valiid images. Only PNG and JPEG are allowed.'); 
				    }// Validate image file dimension
				    else if ($width != "800" || $height != "800") {
    					$this->session->set_flashdata('errors', 'Image dimension should be within 800 X 800'); 
				    }
				    else
				    {
						$upload_dir = 'uploads/advertisement/';
						//$upload_dir_thumb = 'uploads/advertisement/thumb/';
						$file_name=$_FILES["file"]["name"];
						$file_tmp=$_FILES["file"]["tmp_name"];
						$ext=pathinfo($file_name,PATHINFO_EXTENSION);
						$file_name =pathinfo($file_name,PATHINFO_FILENAME);
						$file_name = slugify($file_name);
						$new_name = rand(11111,99999).".".$ext;
						$isupload = compress($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir.$new_name, 30);
						//square_crop($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir_thumb.$new_name, 400);
						if($isupload)
						{
							$data['image'] = $new_name;
						}
					}
				}
				$this->Crud_Model->InsertData('advertisement',$data);
				$this->session->set_flashdata('success', 'Advertisement Inserted Successfully.');
				redirect('administrator/advertisement');
				exit;
			}
		}else{ 
			$data["id"] = "";
			$data['name']='';
			$data['city']='';
			$data["weblink"] ='';
			$data['image']='';
			$data['category']= array();
			$data['ads_category'] = $this->Crud_Model->getDatafromtablewhere('ads_category',array('status'=>1));
			$data["button_value"]="Add";
			$data['page_title']='Advertisement';
			$this->load->view('administrator/add_advertisement',$data);
		}	
	}
	public function editview($id)
	{
		$editdata=$this->Crud_Model->getById($id,'id','advertisement');
		$data["id"] = $id;
		$data["button_value"]="Update";
		$data['name']=$editdata['name'];
		$data['city']=$editdata['city'];
		$data["weblink"] =$editdata['weblink'];
		$data['image']=$editdata['image'];
		$data['category']=explode(",",$editdata['category']);
		$data['ads_category'] = $this->Crud_Model->getDatafromtablewhere('ads_category',array('status'=>1));
		$data['page_title']='Advertisement';
		$data['active_menu'] = 'advertisement';
		$data['sub_active_menu'] = '';
		$this->load->view('administrator/add_advertisement',$data);
	}
	public function edit(){
	
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data["id"] = $this->input->post('id');
			$data["name"] =$this->input->post('name');
			$data["city"] =$this->input->post('city');
			$data["weblink"] =$this->input->post('weblink');
			$data['category']= array();
			$data['ads_category'] = $this->Crud_Model->getDatafromtablewhere('ads_category',array('status'=>1));
			$data['image']='';
			$data["button_value"]="Update";
			$this->load->view('administrator/add_advertisement',$data);
			
		}else{		
			$data["name"] =$this->input->post('name');
			$data["city"] =$this->input->post('city');
			$data["weblink"] =$this->input->post('weblink');
			$cat_arr =$this->input->post('add_category');
			$data["category"] = implode(",",$cat_arr);
			if(!empty($_FILES['file']['name'])){
				$editdata=$this->Crud_Model->getById($this->input->post('id'),'id','advertisement');
				$name = $editdata['image'];
			    $fileinfo = @getimagesize($_FILES["file"]["tmp_name"]);
			    $width = $fileinfo[0];
			    $height = $fileinfo[1];
				$file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
				if (!in_array($file_extension, $this->config->item('allowed_image_extension'))) {
					$this->session->set_flashdata('errors', 'Upload valiid images. Only PNG and JPEG are allowed.'); 
			    }// Validate image file dimension
			    else if ($width != "800" || $height != "800") {
					$this->session->set_flashdata('errors', 'Image dimension should be within 800 X 800'); 
			    }
			    else
			    {
			    	if($name != '')
					{
						@unlink("uploads/advertisement/".$name);
					}
					$upload_dir = 'uploads/advertisement/';
					//$upload_dir_thumb = 'uploads/advertisement/thumb/';
					$file_name=$_FILES["file"]["name"];
					$file_tmp=$_FILES["file"]["tmp_name"];
					$ext=pathinfo($file_name,PATHINFO_EXTENSION);
					$file_name =pathinfo($file_name,PATHINFO_FILENAME);
					$file_name = slugify($file_name);
					$new_name = rand(11111,99999)."_".$file_name.".".$ext;
					$isupload = compress($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir.$new_name, 30);
					//square_crop($file_tmp=$_FILES["file"]["tmp_name"],$upload_dir_thumb.$new_name, 400);
					if($isupload)
					{
						$data['image'] = $new_name;
					}
				}
			}
			
			$id=$this->input->post('id');
			$this->Crud_Model->Updatedata($id,'id','advertisement',$data);
			$this->session->set_flashdata('success', 'Advertisement Update Successfully.');
			redirect('administrator/advertisement');
			exit;
		}
	}
	public function delete($id)
	{
		if($id !='')
		{
			$editdata=$this->Crud_Model->getById($id,'id','billing_customer');
			$this->Crud_Model->DeletData($id,'id','billing_customer');
			redirect('administrator/customer'); exit;
		}
	}

}
?>