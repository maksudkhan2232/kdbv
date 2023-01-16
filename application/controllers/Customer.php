<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {
    public function __construct()
    {
        parent::__construct();	
        $this->load->model('administrator/Crud_Model');	
		$this->load->library('pagination');
    }

	public function index()
	{
		$StateF=array('country_id'=>101);
		$this->data['StateDetails']=$this->Crud_Model->GetStateDetails($StateF);
		$this->data['CountryDetails']=$this->Crud_Model->getDatafromtablewhere('billing_country',array('status'=>1),'ASC');
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
            $email = trim($this->input->post('email'));
            $password = trim($this->input->post('password')); 
            $customer_info = $this->Crud_Model->CheckAuth(stripslashes($email),md5($password));

            if($customer_info['logged_in'] == TRUE){                
                $this->session->set_userdata('customer_info', $customer_info);
                if(count($this->cart->contents()) > 0) {	
                	//echo  count($this->cart->contents());exit;
		            redirect($this->data['base_url'] . 'order/checkout');
		        }else{
		        	redirect($this->data['base_url'] . 'customer/');
		        }
                exit;
            }
            else{
                //$this->session->set_flashdata('message',$customer_info['msg']);
				$this->session->set_flashdata('errors','Invalid Username or Password');				
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

        //echo "<pre>"; print_r($rdata); exit;
      	
      	if (!empty($rdata)) {
            $email=$rdata['email'];
            $CheckAlreadyExist = $this->Crud_Model->CheckAlreadyCustomer($email);
            if(count($CheckAlreadyExist)!='0'){
                $this->session->set_flashdata('message','Your Email Id Already Registered.');
                redirect($this->data['base_url'] . 'customer');
            }else{
            	if($rdata['email']!='' AND $rdata['name']!='' AND $rdata['password']!='' AND $rdata['mobileno']!=''){
	                $password=$rdata['password'];
	                $rdata['password']=md5($rdata['password']);
		            $rdata['status']='1';            
		            $rdata['isdelete']='0';
		            $rdata['created_datetime']=date('Y-m-d H:i:s');
		            $rdata['createdip']=$_SERVER['REMOTE_ADDR'];

		            

	            	$AddCustomerId = $this->Crud_Model->InsertData('billing_customer',$rdata);


   					$rdata['customer_id']=$AddCustomerId;
   					$rdata['mobileno']=$rdata['mobileno'];
   					$rdata['address']=$rdata['address'];
   					$rdata['country']=$rdata['country'];
   					$rdata['state']=$rdata['state'];
   					$rdata['city']=$rdata['city'];
   					$rdata['pincode']=$rdata['pincode'];
   					$rdata['email']=$rdata['email'];
   					$rdata['customer_id']=$AddCustomerId;            
		            $rdata['isdelete']='0';
		            $rdata['created_datetime']=date('Y-m-d H:i:s');
		            $rdata['modified_datetime']=date('Y-m-d H:i:s');
		            $rdata['createdip']=$_SERVER['REMOTE_ADDR'];


		            $add_data['customer_id']=$AddCustomerId;
   					$add_data['mobileno']=$rdata['mobileno'];
   					$add_data['address']=$rdata['address'];
   					$add_data['country']=$rdata['country'];
   					$add_data['state']=$rdata['state'];
   					$add_data['city']=$rdata['city'];
   					$add_data['pincode']=$rdata['pincode'];
   					$add_data['email']=$rdata['email'];
   					$add_data['customer_id']=$AddCustomerId;            
		            $add_data['isdelete']='0';
		            $add_data['created_datetime']=date('Y-m-d H:i:s');
		            $add_data['modified_datetime']=date('Y-m-d H:i:s');
		            $add_data['createdip']=$_SERVER['REMOTE_ADDR'];
	            	$AddBillId = $this->Crud_Model->InsertData('billing_address',$add_data);

	            	//echo $AddCustomerId; exit;

	            	// Email Send

	            	$subject = "Welcome to KD Bhindi Jewellers Junagadh";
	            	$message = '<table cellspacing="0" cellpadding="0" border="0" style="background:#f2f2f2;width:100%;border-top:10px solid #f2f2f2">
					   <tbody>
					      <tr>
					         <td valign="top" align="center">					            
					            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#fff;max-width:600px">
					                  <tr>
					                     <td style="padding-top:18px;padding-bottom:18px;padding-left:15px" valign="top" align="center">
					                        <img src="'.base_url().'assest/frontend/media/images/logo.svg" width="200" height="auto"> 
					                        <div style="color:#666666">Zanzarda Road, opp. Saibaba Temple, Junagadh, Gujarat 362001 India<br />Phone: +91 9825085001</div>
					                     </td>
					                  </tr>
					            </table>
					            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:600px;border:1px solid #e2e2e2;background:#fff;border-bottom:1px solid #ef4e46">					              
					                  <tr>
					                     <td style="padding-top:0;padding-right:14px;padding-bottom:14px;padding-left:14px">
					                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
					                              <tr>
					                                 <td valign="top" style="font:normal 16px arial;line-height:19px;color:#51505d;text-align:left;padding-top:40px;padding-bottom:24px">
					                                    Hi '.ucwords($rdata['name']).',
					                                 </td>
					                                 <td valign="top" style="font:normal 16px arial;line-height:19px;color:#51505d;text-align:right;padding-top:30px;padding-bottom:24px">
					                                    '.date('d M Y').'
					                                 </td>
					                              </tr>
					                              <tr>
					                                 <td valign="top" colspan="3" style="font:normal 16px arial;line-height:19px;color:#51505d;text-align:left;word-wrap:nornal">
					                                    <table cellpadding="10" cellspacing="0" align="center" width="100%" style="font-family:Calibri;"  frame="box" rules="groups">
					                                       <tr>
					                                          <td colspan="3" style="font-size:20px;font-weight:bold;color:#990000;background-color:#ffe9be">
					                                             Welcome
					                                             <p style="font-size:14px;line-height:18px;font-weight:normal;color:#000000;">Hey '.ucwords($rdata['name']).' !   Welcome to our store. Thank you for creating a account. We are more than happy to have you on board. Please make yourself at home and enjoy shopping with us. The Customer Experience Team at KD Bhindi Jewellers. </p>
					                                          </td>
					                                       </tr>
					                                       <tr>
					                                          <td colspan="3">
					                                             <table border="0" cellpadding="10" cellspacing="0" align="center" width="100%" style="font-size:18px;"  frame="void" rules="none">
					                                                <tr>
					                                                   <td><b>Name : </b></td>
					                                                   <td style="width:5px">:</td>
					                                                   <td>'.ucwords($rdata['name']).'</td>
					                                                </tr>
					                                                <tr>
					                                                   <td><b>Address : </b></td>
					                                                   <td style="width:5px">:</td>
					                                                   <td>'.nl2br($rdata['address']).'<br>'.$rdata['city'].'   '.$rdata['pincode'].'</td>
					                                                </tr>
					                                                <tr>
					                                                   <td><b>Mobile No</b></td>
					                                                   <td style="width:5px">:</td>
					                                                   <td>'.$rdata['mobileno'].'</td>
					                                                </tr>
					                                                <tr>
					                                                   <td><b>Email Id </b></td>
					                                                   <td style="width:5px">:</td>
					                                                   <td colspan="5">'.$rdata['email'].'</td>
					                                                </tr>
					                                                <tr>
					                                                   <td><b>Username </b></td>
					                                                   <td style="width:5px">:</td>
					                                                   <td colspan="5">'.$rdata['email'].'</td>
					                                                </tr>
					                                                <tr>
					                                                   <td><b>Password </b></td>
					                                                   <td style="width:5px">:</td>
					                                                   <td colspan="5">'.$password.'</td>
					                                                </tr>
					                                             </table>
					                                          </td>
					                                       </tr>
					                                    </table>
					                                 </td>
					                              </tr>					                         
					                        </table>
					                     </td>
					                  </tr>
					                  <tr>
					                     <td valign="top" style="padding-top:10px;padding-right:14px;padding-bottom:36px;padding-left:14px;text-align:center;">
					                        <table cellspacing="0" cellpadding="0" width="50%" border="0" style="margin-top:20px;" align="center">
					                              <tr>
					                                 <td style="font:normal 15px arial;color:#fff;line-height:18px;background:#00bcd5;border-radius:3px;border:1px solid #00bcd5;text-align:center;padding:12px;">
					                                    <a href="'.base_url().'customer/" title="Connect"  style="outline:none;text-decoration:none;color:#fff;" target="_blank">Login Now</a> 
					                                 </td>
					                              </tr>
					                        </table>
					                     </td>
					                  </tr>					               
					            </table>
					         </td>
					      </tr>
					   </tbody>
					</table>';
					//echo $message ; exit;
	            	$email=$rdata['email'];
	            	send_mail($email,$message,$subject,"");	            	
	            	$this->session->set_flashdata('message',"Your Registration has been Successfully Completed."); 

	            	// Session Set
	            	$rdata["id"] = $AddCustomerId;	                
	                $rdata['verifystatus'] ='done';
	                $rdata['logged_in'] = TRUE;
	                
	                $this->session->set_userdata('customer_info', $rdata);
	            	if(count($this->cart->contents()) > 0) {	            		
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
        	$this->data['CustomerDetails']=$this->Crud_Model->getDatafromtablewheresingle('billing_customer',array('id'=>$this->data['customer_info']['id']));
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
        	$this->data['CountryDetails']=$this->Crud_Model->getDatafromtablewhere('billing_country',array('status'=>1),'ASC');
        	$StateF=array('country_id'=>$this->data['CustomerDetails']['country']);
        	$this->data['StateDetails']=$this->Crud_Model->GetStateDetails($StateF);
        	//$this->data['StateDetails']=$this->Crud_Model->getDatafromtablewhere('billing_state',array('status'=>1),'ASC');
        	//echo "<pre>";print_r($this->data['CustomerDetails']);exit;
            $this->data['title'] = "Order Details";
            $this->load->view('customer_profile',$this->data);
        }
       
	}
	
	
	public function password()
	{
		if(count($this->input->post()) > 0 )
		{
			$this->form_validation->set_rules('npassword', 'Password', 'required');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[npassword]');
			if($this->form_validation->run() == FALSE) {
	
			$this->data['CustomerDetails']=$this->Crud_Model->getDatafromtablewheresingle('billing_customer',array('id'=>$this->data['customer_info']['id']));
			$this->data['title'] = "Order Details";
			$this->load->view('customer_profile_password',$this->data);
	
			}else{
			
						
				if($this->input->post('cpassword')==$this->input->post('npassword')){
					$fixed_pw = md5($this->input->post('npassword'));
					$data1['password']=$fixed_pw;
					//$data1['org_password']=$this->input->post('npassword');
					$id = $this->data['customer_info']['id'];
					$fieldName = 'id';
					$table = "billing_customer";
					$this->Crud_Model->Updatedata($id,$fieldName,$table,$data1);					
					$this->session->set_flashdata('success', 'Password Update Successfully!');
					redirect('customer/password');
					exit;
				}						
			}
		}else{
        	$this->data['CustomerDetails']=$this->Crud_Model->getDatafromtablewheresingle('billing_customer',array('id'=>$this->data['customer_info']['id']));         	
        	//echo "<pre>";print_r($this->data['CustomerDetails']);exit;
            $this->data['title'] = "Order Details";
            $this->load->view('customer_profile_password',$this->data);
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
		
		$config["base_url"] = base_url()."customer/review";
		$config['total_rows'] = $this->Crud_Model->get_count("testimonial");
		$config['per_page'] = 6;
		$config['uri_segment'] = 3;
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
		$config['num_links'] = 2;
		$this->pagination->initialize($config);
		$start = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		if($start)
		{
			$start = ($start - 1) * $config['per_page'];
		}
        $this->data["links"] = $this->pagination->create_links();
        $this->data['reviews'] = $this->Crud_Model->get_limit_data_where($config["per_page"],$start,"testimonial",array("status"=>1),"homepage","DESC");

		
		$this->data['title'] = "Customer Reviews";
		$this->load->view('testimonials',$this->data);
	}
	public function newslettersubscribe()
	{
		$subscribeemail   = trim($this->input->post('subscribeemail')); // Subscribe Email
		$returnarray = array();     
		if(isset($subscribeemail) AND $subscribeemail!=''){ 
			$SubscribeDetails=$this->Crud_Model->getDatafromtablewheresingle('subscription',array('email'=>$subscribeemail));   
			if(!empty($SubscribeDetails)){
				$returnarray['msg'] = 'already';
	            $returnarray['message'] = 'Newsletter subscription already join.';
			}else{
				$returnarray['msg'] = 'success';
	            $returnarray['message'] = 'Join our newsletter successfully.';
	            $subscribeinfo=array();
	        	$subscribeinfo['email']=$subscribeemail;
	            $subscribeinfo['created_at']=date('Y-m-d H:i:s');
	            $subscribeid=$this->Crud_Model->InsertData('subscription',$subscribeinfo);        		
			}
            
	    }else{
	    	$returnarray['msg'] = 'error';
            $returnarray['message'] = 'Something Wrong.';
	    }
		echo json_encode($returnarray);exit;       
	}
	public function reviewupdate()
	{
		
		$productreview   = $this->input->post('review'); // review
		$productid   = $this->input->post('productid'); // productrating
		$productrating   = $this->input->post('productrating'); // productrating
		
		$returnarray = array();     
		if($this->data['customer_info']['id']!=''){
			if(isset($productreview) AND $productreview!=''){               

	            $reviewinfo=array();
	        	$reviewinfo['name']=$this->data['customer_info']['name'];
	        	$reviewinfo['mobileno']=$this->data['customer_info']['mobileno'];
	        	$reviewinfo['email']=$this->data['customer_info']['email'];
	        	$reviewinfo['customerid']=$this->data['customer_info']['id'];
	        	$reviewinfo['product_id']=$productid;
	        	$reviewinfo['product_rating']=$productrating;
	        	$reviewinfo['product_review']=$productreview;
	        	$reviewinfo['status']=0;
	        	$reviewinfo['isdelete']=0;
	            $reviewinfo['created_datetime']=date('Y-m-d H:i:s');
	            $reviewinfo['createdip']=$_SERVER['REMOTE_ADDR'];
	            $subscribeid=$this->Crud_Model->InsertData('product_rating',$reviewinfo);  

	            $returnarray['msg'] = 'success';
	            $returnarray['message'] = 'Your Review Submit Successfully.';      	
		    }else{
		    	$returnarray['msg'] = 'error';
	        	$returnarray['message'] = 'Please Login';
		    }
		}else{
	    	$returnarray['msg'] = 'error';
        	$returnarray['message'] = 'Please Login';
	    }
		echo json_encode($returnarray);exit;       
	}
	function orderview($id){		
        if($id!=''){
			$dataf=array('OrderID'=>$id);
        	$GetOrderDetails=$this->Crud_Model->GetOrderSingleDetails($dataf);
        	if(!empty($GetOrderDetails)){
        		$dataf=array('order_id'=>$id);
        		$GetOrderProductDetails=$this->Crud_Model->GetOrderProductDetails($dataf);
        		$this->data['OrderDetails'] = $GetOrderDetails;
        		$this->data['OrderProductDetails'] = $GetOrderProductDetails;
        		$this->data['message'] = $this->session->flashdata('message');
		        $this->data['title'] = "Cart";
		        $this->load->view('order_view',$this->data);		
        	}else{
        		redirect($this->data['base_url'] . 'customer/');	
        	}	        
        }else{        	
        	redirect($this->data['base_url'] . 'customer/');
        }
    }
    function getcountrywisestate(){
        
        $countryid = $this->input->post('countryid');
        $returnarray = array();        
        if($countryid!=''){  
        	$StateF=array('country_id'=>$countryid);
        	$StateDetails=$this->Crud_Model->GetStateDetails($StateF);  
			if (!empty($StateDetails)) {
            	$shtml='';
                foreach ($StateDetails as $skey => $svalue) {
                	$shtml .='<option value="'.$svalue['id'].'">'.ucwords($svalue['name']).'</option>';
                }   
                $returnarray['msg'] = 'success';
                $returnarray['data'] = $shtml;          
            }else{
                $returnarray['msg'] = 'error';
            }          
        }else{
            $returnarray['msg'] = 'error';
        } 
        echo json_encode($returnarray);exit;      
    }

    public function reset()
	{

		if($this->input->post()){  

           $email = trim($this->input->post('email'));
           $CheckAlreadyExist = $this->Crud_Model->CheckAlreadyCustomer($email);

		  	//echo "<pre>"; print_r($CheckAlreadyExist); exit;
            if(count($CheckAlreadyExist)=='0')
            {
                $this->session->set_flashdata('errors','Invalid Email ID.');
                redirect($this->data['base_url'] . 'customer/reset');
            }
            else
            {
				//echo $CheckAlreadyExist['id']; exit;
				$pass = rand(1,9).random_int(100000, 999999);
				// Email Send
					$id = $CheckAlreadyExist['id'];
					$udata['password']= md5($pass);
					$this->Crud_Model->Updatedata($id,'id','billing_customer',$udata);
					$subject = " KD Bhindi Jewellers - Reset Password";
	            	$message = '<table cellspacing="0" cellpadding="0" border="0" style="background:#f2f2f2;width:100%;border-top:10px solid #f2f2f2">
					   <tbody>
					      <tr>
					         <td valign="top" align="center">					            
					            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#fff;max-width:600px">
					                  <tr>
					                     <td style="padding-top:18px;padding-bottom:18px;padding-left:15px" valign="top" align="center">
					                        <img src="'.base_url().'assest/frontend/media/images/logo.svg" width="200" height="auto"> 
					                        <div style="color:#666666">Zanzarda Road, opp. Saibaba Temple, Junagadh, Gujarat 362001 India<br />Phone: +91 9825085001</div>
					                     </td>
					                  </tr>
					            </table>
					            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:600px;border:1px solid #e2e2e2;background:#fff;border-bottom:1px solid #ef4e46">					              
					                  <tr>
					                     <td style="padding-top:0;padding-right:14px;padding-bottom:14px;padding-left:14px">
										<br><center><h3 style="font-family:Verdana, Arial, Helvetica, sans-serif">Password Reset</h3></center>
					                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
					                              <tr>
					                                 <td valign="top" style="font:normal 16px arial;line-height:19px;color:#51505d;text-align:left;padding-top:40px;padding-bottom:24px">
					                                    Hi '.ucwords($CheckAlreadyExist['name']).',
					                                 </td>
					                                 <td valign="top" style="font:normal 16px arial;line-height:19px;color:#51505d;text-align:right;padding-top:30px;padding-bottom:24px">
					                                    '.date('d M Y').'
					                                 </td>
					                              </tr>
					                              <tr>
					                                 <td valign="top" colspan="2" style="font:normal 16px arial;line-height:19px;color:#51505d;text-align:left;word-wrap:nornal">
					                                    <table cellpadding="10" cellspacing="0" align="center" width="100%" style="font-family:Calibri;"  frame="box" rules="groups">
					                                       <tr>
					                                          <td colspan="2">
					                                             <table border="0" cellpadding="10" cellspacing="0" align="center" width="100%" style="font-size:18px;"  frame="void" rules="none">
					                                                <tr>
					                                                   <td><b>Name : </b></td>
					                                                   <td style="width:5px">:</td>
					                                                   <td>'.ucwords($CheckAlreadyExist['name']).'</td>
					                                                </tr>
					                                                <tr>
					                                                   <td><b>Email Id : </b></td>
					                                                   <td style="width:5px">:</td>
					                                                    <td>'.$email.'</td>
					                                                </tr>
					                                                <tr>
					                                                   <td><b>New Password</b></td>
					                                                   <td style="width:5px">:</td>
					                                                   <td>'.$pass.'</td>
					                                                </tr>					                                                
					                                             </table>
					                                          </td>
					                                       </tr>
					                                    </table>
					                                 </td>
					                              </tr>					                         
					                        </table>
					                     </td>
					                  </tr>
					                  <tr>
					                     <td valign="top" style="padding-top:10px;padding-right:14px;padding-bottom:36px;padding-left:14px;text-align:center;">
					                        <table cellspacing="0" cellpadding="0" width="50%" border="0" style="margin-top:20px;" align="center">
					                              <tr>
					                                 <td style="font:normal 15px arial;color:#fff;line-height:18px;background:#00bcd5;border-radius:3px;border:1px solid #00bcd5;text-align:center;padding:12px;">
					                                    <a href="'.base_url().'customer/" title="Connect"  style="outline:none;text-decoration:none;color:#fff" target="_blank">Login Now</a> 
					                                 </td>
					                              </tr>
					                        </table>
					                     </td>
					                  </tr>					               
					            </table>
					         </td>
					      </tr>
					   </tbody>
					</table>';
					
				//	echo $message ; exit;
					send_mail($email,$message,$subject,"");	 
	            	$this->session->set_flashdata('success',"Check your Email. Password Reset successfully."); 
		            redirect($this->data['base_url'] . 'customer/reset'); exit;
            }
           
        }elseif($this->session->userdata('customer_info')!=""){
            redirect($this->data['base_url'] . 'customer/');
            exit;
        }
        else{
            $this->data['title'] = "Reset Password ";
            $this->load->view('reset',$this->data);
        }
    }
	
	
	public function check_duplicate()
	{
		$row_id = $this->input->post('row_id');
		$table_name = trim($this->input->post('table_name'));
		$field_name = trim($this->input->post('field_name'));
		$field_value = trim($this->input->post('field_value'));
		$this->db->select("id");
		$this->db->from($table_name);
		$this->db->where($field_name,$field_value);
		if($row_id != 0 && $row_id != '')
		{
			$this->db->where('id !=',$row_id);
		}
		$query=$this->db->get();
		$query->row_array();
		if($query->num_rows() > 0)
		{
			echo json_encode(array('error'=>1,'msg'=>'Email Id Already Registred. Please Try another Email.')); exit;
		}else{
			echo json_encode(array('error'=>0,'msg'=>'')); exit;

		}
	}

	function upaddress()
    {
        $address_id=$this->input->post('address_id');
        $updata['address']=$this->input->post('saddress');
        $updata['country']=$this->input->post('scountry');
        $updata['state']=$this->input->post('sstate');
        $updata['city']=$this->input->post('scity');
        $updata['pincode']=$this->input->post('spincode');
        $updata['mobileno']=$this->input->post('smobileno');
        $updata['alternate_mobileno']=$this->input->post('alternatemobileno');
        $updata['modified_datetime']=date("Y-m-d H:i:s");
        $this->db->where('id',$address_id)->update('billing_address',$updata);
        $this->session->set_flashdata('success', 'Address Updated Successfully!');
        redirect($this->data['base_url'].'customer/profile');
        
    }
    
}