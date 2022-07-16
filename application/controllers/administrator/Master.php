<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller  {
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/Crud_Model');
		$this->is_admin_logged_in();
	}
	public function category()
	{ 		
		$data = array();
		$data['page_title']='category';
		$data['viewdata']=$this->Crud_Model->getDatafromtable('category');
		$data['button_value'] = 'Add Category';
		$data['name']='';
		$data['id']='';
		$this->load->view('administrator/category',$data);
	}
	public function add_category()
	{	
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = "";
				$data["name"] =$this->input->post('name');
				$data["button_value"]="Add";
				$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('category',array(1=>1),'DESC');
				$this->load->view('administrator/category',$data);				
			}else{		
				$data["name"] =$this->input->post('name');
				$table='category';
				$this->Crud_Model->InsertData($table,$data);
				$this->session->set_flashdata('success', 'Category Inserted Successfully.');
				redirect('administrator/master/category');
				exit;
			}
		}else{ 
			$data["id"] = "";
			$data['name']='';
			$data["button_value"]="Add";
			$data['page_title']='Category';
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('category',array(1=>1),'DESC');
			$this->load->view('administrator/category',$data);
		}	
	}
	public function edit_category($id)
	{
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data["id"] = $this->input->post('id');
				$data["name"] =$this->input->post('name');
				$data["button_value"]="Update";
				$this->load->view('administrator/category',$data);
				
			}else{		
				$data["name"] =$this->input->post('name');
				$id=$this->input->post('id');
				$fieldName='id';
				$table='category';
				$this->Crud_Model->Updatedata($id,$fieldName,$table,$data);
				$this->session->set_flashdata('success', 'Category Update Successfully.');
				redirect('administrator/master/category');
				exit;
			}
		}else{
			$editdata=$this->Crud_Model->getById($id,'id','category');
			$data["id"] = $id;
			$data["button_value"]="Update";
			$data['name']=$editdata['name'];
			$data['page_title']='Category';
			$data['viewdata']=$this->Crud_Model->getDatafromtablewhere('category',array(1=>1),'DESC');
			$this->load->view('administrator/category',$data);
		}
	}
	
	public function check_duplicate()
	{
		$row_id = $this->input->post('row_id');
		$table_name = $this->input->post('table_name');
		$field_name = $this->input->post('field_name');
		$field_value = $this->input->post('field_value');
		$this->db->select("*");
		$this->db->from($table_name);
		$this->db->where($field_name,$field_value);
		if($row_id != 0 && $row_id != '')
		{
			$this->db->where('id !=',$row_id);
		}
		$query=$this->db->get();
		$query->row_array();
		if($query->num_rows() > 0)
		{
			echo json_encode(array('error'=>1,'msg'=>'Category Name Already Exists..')); exit;
		}else{
			echo json_encode(array('error'=>0,'msg'=>'Category Insert Successfully..')); exit;

		}
	}
	
	
	public function sub_category()
	{ 		
		$data = array();
		$data['page_title']='Category';
		$data['categories']=$this->Crud_Model->getDatafromtablewhere('category',array('status'=>1),'ASC');
		$data['viewdata']=$this->Crud_Model->getDatafromtable('sub_category');
		$data['button_value'] = 'Add Category';
		$data['name']='';
		$data['id']='';
		$this->load->view('administrator/sub_category',$data);
	}
	public function GetCollectionWiseCategory()
	{ 		
		$collectionid = $this->input->post('collectionid');
		
		$SubcategoryDetailsHtml='';
		if($collectionid!=''){
            $SubcategoryDetails=$this->Crud_Model->getDatafromtablewhere('sub_category',array('status'=>1,'category_id'=>$collectionid),'ASC');            
            if(!empty($SubcategoryDetails)){
             	foreach ($SubcategoryDetails as $sckey => $scvalue) {
                    $SubcategoryDetailsHtml .='<option value="'.$scvalue['id'].'">'.ucwords($scvalue['name']).'</option>'; 
                } 
            }else{
            	$SubcategoryDetailsHtml .='<option value="">Select Category</option>';	
            }
        }else{
        	 $SubcategoryDetailsHtml .='<option value="">Select Category</option>';
        }
        echo json_encode($SubcategoryDetailsHtml);exit;
	}
}
?>