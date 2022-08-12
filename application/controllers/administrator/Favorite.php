<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class favorite extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->is_admin_logged_in();
		$this->load->model('administrator/Crud_Model');
	}
	
	public function index()
	{
		$data['page_title']='order';
		$data['active_menu'] = 'order';
		$data['sub_active_menu'] = '';
		$data['viewdata']=$this->Crud_Model->FavoriteProductDetails('');
		// echo "<pre>";
		// print_r($data['viewdata']);
		// exit;
		$this->load->view('administrator/view_favorite_product',$data);
	}
}
?>