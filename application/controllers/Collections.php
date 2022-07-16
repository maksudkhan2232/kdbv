<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collections extends CI_Controller {
    public function __construct()
    {
        parent::__construct();		
    }

	public function index()
	{
		$data['title'] = "Collections";
		$this->load->view('collections',$data);
	}
}
