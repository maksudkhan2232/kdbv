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
		$data['page_title']='Dashboard';
		$data['total_gold_jewellery'] = 500; //	$this->Crud_Model->getCount('product',array('status'=>1,'type'=>'Gold'));
		$data['total_silver_jewellery'] = 400; //	$this->Crud_Model->getCount('product',array('status'=>1,'type'=>'silver'));
		$data['total_diamonds_jewellery'] = 350; //	$this->Crud_Model->getCount('product',array('status'=>1,'type'=>'silver'));
		$data['total_platinum_jewellery'] = 150; //	$this->Crud_Model->getCount('product',array('status'=>1,'type'=>'silver'));
		
		$data['gold_Bracelet'] = 100;	//$this->Crud_Model->getCount('product',array('status'=>0));
		$data['gold_Rings'] = 200;	//$this->Crud_Model->getCount('product',array('status'=>0));
		$data['gold_Earrings'] = 300;	//$this->Crud_Model->getCount('product',array('status'=>0));
		$data['gold_Pendants'] = 400;	//$this->Crud_Model->getCount('product',array('status'=>0));
		$data['gold_NosePin'] = 500;	//$this->Crud_Model->getCount('product',array('status'=>0));

		$data['DailyRateChangerDetails']=$this->Crud_Model->getDatafromtablewheresingle('dailyratechanger',array('id'=>1));
		

		//echo "<pre>"; print_r($data); exit;		
		$this->load->view('administrator/dashboard',$data);
	}
}
?>