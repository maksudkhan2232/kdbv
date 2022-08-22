<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offers extends MY_Controller {
    public function __construct()
    {
        parent::__construct();	
		$this->load->model('administrator/Crud_Model');	
		$this->load->library('pagination');	
    }

	public function index()
	{
		$config["base_url"] = base_url()."offers";
		$config['total_rows'] = $this->Crud_Model->get_count("offerzone");
		$config['per_page'] = 3;
		$config['uri_segment'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="styled-pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li><a href='javascript:;' class='active'>";
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$start = ($this->uri->segment(1)) ? $this->uri->segment(2) : 0;
		if($start)
		{
			$start = ($start - 1) * $config['per_page'];
		}
        $this->data["links"] = $this->pagination->create_links();
		$this->data['offers'] = $this->Crud_Model->get_limit_data_where($config["per_page"], $start,"offerzone",array("status"=>1),"id","DESC");
		//	echo "<pre>" ; print_r($data); exit;	
		$this->data['title'] = "Offers |  KD Bhindi Jewellers";
		$this->load->view('offers',$this->data);
	}
}
