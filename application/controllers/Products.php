<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    public function __construct()
    {
        parent::__construct();		
    }

	public function index()
	{
		$data['title'] = "Products";
		$this->load->view('products',$data);
	}
    
    public function details()
	{
		$data['title'] = "Product Details";
		$this->load->view('product_detail',$data);
	}
}
