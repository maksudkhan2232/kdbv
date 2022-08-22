<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Error_404 extends MY_Controller {
	function __construct()
	{
		parent::__construct();				
	}
	public function index()
	{
		$this->data['active_menu'] = "home";
		$this->data['title'] = "404";
		$this->output->set_status_header('404');
		$this->load->view('404',$this->data);
	}
}