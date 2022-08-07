<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('administrator/Crud_Model');
    }
    function index(){
		$TopSearchText=$this->input->post('TopSearchText');
		if($TopSearchText!=''){
			redirect($this->data['base_url'].'/shopby/search/'.$TopSearchText);
		}else{
			redirect($this->data['base_url']);
		}
		
		
		
	}
}
