<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/Crud_Model');
	}
	public function get_state_ajax()
	{
		$c_id = $this->input->post('c_id');
		$state = get_state($c_id);
		$html ='<option value="">Select State</option>';
		foreach ($state as $key => $c) { 
            $html.='<option value="'.$c["id"].'">'.$c['name'].'</option>';
        } 
        echo json_encode(array("state"=>$html)); exit;
	}
	public function get_city_ajax()
	{
		$c_id = $this->input->post('c_id');
		$state = get_city($c_id);
		$html ='<option value="">Select City</option>';
		foreach ($state as $key => $c) { 
            $html.='<option value="'.$c["id"].'">'.$c['name'].'</option>';
        } 
        echo json_encode(array("city"=>$html)); exit;
	}
	public function search_by_user_series()
	{
		$terms = $_REQUEST['term'];
		$query = "SELECT * FROM user WHERE approve=1 && disp_series LIKE '%".$terms."%' ORDER BY id DESC LIMIT 10";
		$res= $this->db->query($query)->result_array();
		$output = array();
		foreach ($res as $ks => $vs) 
      	{ 
        	$temp_array = array();
        	$temp_array['user_id'] = $vs['id'];
   			$temp_array['value'] = $vs['disp_series'];
   			$temp_array['label'] = $vs['disp_series'];
   			$output[] = $temp_array;
        }
		echo json_encode($output);
		exit;
	}
	public function search_by_city()
	{
		$terms = $_REQUEST['term'];
		$query = "SELECT * FROM own_cities WHERE status=1 && name LIKE '%".$terms."%' ORDER BY name ASC LIMIT 10";
		$res= $this->db->query($query)->result_array();
		$output = array();
		foreach ($res as $ks => $vs) 
      	{ 
        	$temp_array = array();
        	$temp_array['user_id'] = $vs['id'];
   			$temp_array['value'] = $vs['name'];
   			$temp_array['label'] = $vs['name'];
   			$output[] = $temp_array;
        }
		echo json_encode($output);
		exit;
	}
	public function get_education()
	{
		$searchTerm = $_GET['term']; 
		$skillData = array();
		$res= $this->db->query("SELECT * FROM education WHERE name LIKE '%".$searchTerm."%' AND status = 1 ORDER BY name ASC")->result_array(); 
		    foreach ($res as $key => $row) {
		        $data['id'] = $row['id']; 
		        $data['value'] = $row['name']; 
		        array_push($skillData, $row['name']); 
		    } 
		echo json_encode($skillData); 
        exit;
	}
	
	
	
}