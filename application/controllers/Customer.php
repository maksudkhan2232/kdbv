<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    public function __construct()
    {
        parent::__construct();		
    }

	public function index()
	{
		$data['title'] = "Customer Reviews";
		$this->load->view('registration',$data);
	}
    public function review()
	{
		$data['title'] = "Customer Reviews";
		$this->load->view('testimonials',$data);
	}
    
}
