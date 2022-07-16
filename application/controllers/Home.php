<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    public function __construct()
    {
        parent::__construct();	
        $this->load->model('administrator/Crud_Model');
    }

	public function index()
	{
		
		$this->data['SliderDetails']=$this->Crud_Model->getDatafromtablewhere('slider',array('status'=>1),'DESC');

		$this->data['title'] = "Home";
		// echo "<pre>";
		// print_r($this->data['SliderDetails']);
		// // echo $this->data['DailyRateChangerDetails'];
		// exit;
		$this->load->view('home',$this->data);
	}
}
