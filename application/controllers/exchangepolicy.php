<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class exchangepolicy extends MY_Controller {
    public function __construct()
    {
        parent::__construct();		
    }

	public function index()
	{
		$this->data['title'] = "About Us";
		$this->load->view('about_us',$this->data);
	}
}
