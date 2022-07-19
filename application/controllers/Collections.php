<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collections extends MY_Controller {
    public function __construct()
    {
        parent::__construct();		
    }

	public function index()
	{
		$this->data['title'] = "Collections";
		$this->load->view('collections',$this->data);
	}
}
