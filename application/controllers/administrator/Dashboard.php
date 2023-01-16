<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller  {
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/Crud_Model');
		$this->is_admin_logged_in();
	}
	public function index()
	{ 	
		if(count($this->input->post()) > 0 )
		{
			$data["name"] =$this->input->post('name');
			$data["status"] ='1';
			$data["isdelete"] ='0';
			$data['modified_datetime']=date('Y-m-d H:i:s');
			$data['createdip']=$_SERVER['REMOTE_ADDR'];
			$id='1';
			$fieldName='id';
			$table='dailyratechanger';
			$this->Crud_Model->Updatedata($id,$fieldName,$table,$data);
			$this->session->set_flashdata('success', 'Daily Rate Update Successfully.');
			redirect('administrator/dashboard');
			exit;
		}
		$data = array();
		
		$data['DailyRateChangerDetails']=$this->Crud_Model->getDatafromtablewheresingle('dailyratechanger',array('id'=>1));
		
		$category=$this->Crud_Model->getDatafromtablewhere('category',array('status'=>1));
		$sub_product = array();
		foreach ($category as $k => $v)
		{
			$arr['id'] = $v['id'];
			$arr['category'] = $v['name'];
			$sub_ctaegory= $this->db->select('id,name')->from('sub_category')->where("find_in_set(".$v['id'].", category_id)")->order_by("name", "asc")->get()->result_array();
			$sc = array();
			foreach ($sub_ctaegory as $sk => $sv)
			{
				$sv['product'] = $this->Crud_Model->getCount('product',array('categoryid'=>$sv['id'],'collectiontype'=>$v['id']));
				$sc[] = $sv;
			}
			$arr['sub_category'] = $sc;
			$sub_product[] = $arr;
		}
		$orderfe=array('OrderDate'=>date('Y-m-d'));
		$OrderData=$this->Crud_Model->GetOrderDetails($orderfe);
		$data['OrderData'] = $OrderData;
		$data['sub_product'] = $sub_product;
		//echo "<pre>"; print_r($sub_product); exit;		
		$this->load->view('administrator/dashboard',$data);
	}
}
?>