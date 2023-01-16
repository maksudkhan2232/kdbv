<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class About extends MY_Controller {
    public function __construct()
    {
        parent::__construct();	
		$this->load->model('administrator/Crud_Model');		
    }
	public function index()
	{
		$this->data['title'] = "About Us";
		$this->load->view('about_us',$this->data);
	}
}
?>