<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_status extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_admin_logged_in();
		$this->load->model('administrator/Crud_Model');
	}
	public function chageStatus(){
		$data[$_REQUEST['id_name']] = $_REQUEST['id'];
		$data[$_REQUEST['field_name']] =  $_REQUEST['status'];
		$dataId = $_REQUEST['id'];
    	$fieldName = $_REQUEST['id_name'];
    	$table = $_REQUEST['table'];
	//	echo "<pre>"; print_r($data) ; exit;
		if($table=='gallery')
		{
			$fieldName1='gallery_id';
			$table1='gallery_image';
			$data1['status']=$_REQUEST['status'];
			$this->Crud_Model->Updatedata($dataId,$fieldName1,$table1,$data1);
		}
		$rec_id=$this->Crud_Model->Updatedata($dataId,$fieldName,$table,$data);

		$data['status'] = "success";
		$data['data']	= 1;
		echo json_encode($data);
		exit;
		if($this->input->is_ajax_request()){
			$data['status'] = "status";
			$data['data']	= $rec_id;
			echo json_encode($data);
			exit;
		}
	}

}
