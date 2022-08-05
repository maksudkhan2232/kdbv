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
        
        if($this->data['customer_info']['id']==''){
            $this->data['title'] = "Registration";
            $this->load->view('registration',$this->data);
        }else{
        	$this->data['CustomerDetails']=$this->Crud_Model->getDatafromtablewheresingle('billing_customer',array('id'=>$this->data['customer_info']['id']));
        	$getorder=array('CustomerID'=>$this->data['customer_info']['id']);
        	$this->data['GetOrderDetails']=$this->Crud_Model->GetOrderDetails($getorder);
        	//echo "<pre>";print_r($this->data['GetOrderDetails']);exit;
            $this->data['title'] = "Order Details";
            $this->load->view('customer_order',$this->data);
        }
       
	}
	public function login()
	{
		if($this->input->post()){  
            $email = $this->input->post('email');
            $password = $this->input->post('password'); 
            $customer_info = $this->Crud_Model->CheckAuth(stripslashes($email),md5($password));
            if($customer_info['logged_in'] == TRUE){                
                $this->session->set_userdata('customer_info', $customer_info);
                if(count($this->cart->contents() > 0)) {	
                	//echo  count($this->cart->contents());exit;
		            redirect($this->data['base_url'] . 'order/checkout');
		        }else{
		        	redirect($this->data['base_url'] . 'customer');
		        }
                exit;
            }
            else{
                $this->session->set_flashdata('message',$customer_info['msg']);
                redirect($this->data['base_url'] . 'customer/');
                exit;
            }
        }elseif($this->session->userdata('customer_info')!=""){
            redirect($this->data['base_url'] . 'customer/');
            exit;
        }
        else{
            redirect($this->data['base_url'] . 'customer/');
        }
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
	public function favoriteproducts()
	{
		
		$this->data['message'] = $this->session->flashdata('message');
        if($this->data['customer_info']['id']==''){
            $this->data['title'] = "Registration";
            $this->load->view('registration',$this->data);
        }else{
        	$fpd=array('customer_id'=>$this->data['customer_info']['id']);
        	$this->data['FavoriteProductDetails']=$this->Crud_Model->GetFavoriteProductDetails($fpd);
        	$this->data['title'] = "Favorite Product List";
            $this->load->view('customer_favorite_products',$this->data);
        }
       
	}
	public function profile()
	{
		$rdata   = $this->input->post('data'); // Registration Data
		
		if(isset($rdata) AND $rdata['name']!='' AND $rdata['mobileno']!=''){               
           
            $rdata['modified_datetime']=date('Y-m-d H:i:s');
            $rdata['createdip']=$_SERVER['REMOTE_ADDR'];
            $UpdateCustomerId = $this->Crud_Model->Updatedata($this->data['customer_info']['id'],'id','billing_customer',$rdata);
        	$this->session->set_flashdata('message',"Your Profile Successfully Update."); 
        	redirect($this->data['base_url'] . 'customer/profile/');
	    }
		$this->data['message'] = $this->session->flashdata('message');
        if($this->data['customer_info']['id']==''){
            $this->data['title'] = "Registration";
            $this->load->view('registration',$this->data);
        }else{
        	$this->data['CustomerDetails']=$this->Crud_Model->getDatafromtablewheresingle('billing_customer',array('id'=>$this->data['customer_info']['id']));
        	 $this->data['StateDetails']=$this->Crud_Model->getDatafromtablewhere('billing_state',array('status'=>1),'ASC');
        	//echo "<pre>";print_r($this->data['CustomerDetails']);exit;
            $this->data['title'] = "Order Details";
            $this->load->view('customer_profile',$this->data);
        }
       
	}
	public function logout()
    {
   		$this->session->unset_userdata('customer_info');
   		session_destroy();
   		redirect($this->data['base_url'] . 'customer/');
    }
    public function review()
	{
		$data['title'] = "Customer Reviews";
		$this->load->view('testimonials',$data);
	}
	
    
}
