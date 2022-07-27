<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {
    public function __construct()
    {
        parent::__construct();	
        $this->load->model('administrator/Crud_Model');	
    }

	public function index()
	{
		$this->data['StateDetails']=$this->Crud_Model->getDatafromtablewhere('billing_state',array('status'=>1),'ASC');
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['title'] = "Cart";
        $this->load->view('registration',$this->data);
	}
	public function login()
	{
		$returnarray = array();        
        $data   = $this->input->post('data'); // Registration Data
        $sdata  = $this->input->post('sdata'); // Shiping Data

        $differentshipaddress = ($this->input->post('differentshipaddress')) ? $this->input->post('differentshipaddress'):"No"; 
        if ($this->cart->contents()) {
            $email=$data['email'];
            $CheckAlreadyExist = $this->Crud_Model->CheckAlreadyCustomer($email);
            if(count($CheckAlreadyExist)!='0'){
                $this->session->set_flashdata('message','Your Email Id Already Registered.');
                redirect($this->data['base_url'] . 'order/checkout');
            }else{
                
                echo 'registered';
                print_r($data);
                exit;
            }           
        }else{
            redirect($this->data['base_url'] . 'order/');
        }
        $this->data['StateDetails']=$this->Crud_Model->getDatafromtablewhere('billing_state',array('status'=>1),'ASC');
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['title'] = "Cart";
        $this->load->view('order_checkout',$this->data);
		$data['title'] = "Customer Reviews";
		$this->load->view('registration',$data);
	}
	public function registration()
	{
		$returnarray = array();        
        $rdata   = $this->input->post('data'); // Registration Data
      	
      	if (!empty($rdata)) {
            $email=$rdata['email'];
            $CheckAlreadyExist = $this->Crud_Model->CheckAlreadyCustomer($email);
            if(count($CheckAlreadyExist)!='0'){
                $this->session->set_flashdata('message','Your Email Id Already Registered.');
                redirect($this->data['base_url'] . 'customer');
            }else{
            	if($rdata['email']!='' AND $rdata['name']!='' AND $rdata['password']!='' AND $rdata['mobileno']!=''){
	                $rdata['password']=md5($rdata['password']);
		            $rdata['status']='1';            
		            $rdata['isdelete']='0';
		            $rdata['created_datetime']=date('Y-m-d H:i:s');
		            $rdata['createdip']=$_SERVER['REMOTE_ADDR'];
	            	$AddCustomerId = $this->Crud_Model->InsertData('billing_customer',$rdata);
	            	$this->session->set_flashdata('message',"Your Registration Successfully Complete."); 

	            	// Session Set
	            	$rdata["id"] = $AddCustomerId;	                
	                $rdata['verifystatus'] ='done';
	                $rdata['logged_in'] = TRUE;
	                $this->session->set_userdata('customer_info', $rdata);
	            	
	            	if(count($this->cart->contents() > 0)) {	            		
			            redirect($this->data['base_url'] . 'order/checkout');
			        }else{
			        	redirect($this->data['base_url'] . 'customer');
			        }
			    }else{
			    	$this->session->set_flashdata('message',"Please Fillup Proper Details."); 
			    	redirect($this->data['base_url'] . 'customer');
			    }
            }           
        }else{
            redirect($this->data['base_url'] . 'customer/');
        }
        $this->data['StateDetails']=$this->Crud_Model->getDatafromtablewhere('billing_state',array('status'=>1),'ASC');
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['title'] = "Cart";
        $this->load->view('order_checkout',$this->data);
		$data['title'] = "Customer Reviews";
		$this->load->view('registration',$data);
	}
    public function review()
	{
		$data['title'] = "Customer Reviews";
		$this->load->view('testimonials',$data);
	}
    
}
