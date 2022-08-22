<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('administrator/User','',TRUE);
		$this->load->model('administrator/Crud_Model');
	}
	public function index()
	{
		if($this->session->userdata('KDBhindiAdminSession'))
	    {
			redirect('administrator/dashboard', 'refresh');
			exit;
		}else{
			$this->load->view('administrator/home');
		}
	}
	public function check()
	{
		$this->form_validation->set_rules('admin_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('admin_password', 'Password', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('administrator/home');
		}
		else
		{
			$username = $this->input->post('admin_email');
			$password = $this->input->post('admin_password');
			$result = $this->User->login($username, $password);
			if($result)
			{
				redirect('administrator/dashboard', 'refresh');
				exit;
			}
			else
			{
				$this->session->set_flashdata('errors', 'Invalid username or password');
				$this->load->view('administrator/home');
			}
		}
	}
	public function logout()
    {
   		$this->session->unset_userdata('KDBhindiAdminSession');
   		session_destroy();
   		redirect('administrator/home', 'refresh');
    }
	public function forgot_password(){
		$this->load->view('administrator/forgot_password');
	}	
	public function reset_link(){
		$this->form_validation->set_rules('identity', 'Email', 'required|trim');
		if($this->form_validation->run() == FALSE) {
				$this->load->view('administrator/forgot_password');
		}else{
			$email = trim($this->input->post('identity'));
			$user = $this->User->checkUser($email);	
			//echo "<pre>";  print_r($user)		; exit;
			if(count($user)>0){	
				$psw = rand(100000,999999);
				$data['password'] = md5($psw);
				$data['org_password'] = $psw;
				$id = $user[0]['id'];
				$username = $user[0]['email'];
				$fieldName = 'id';
				$table = "admin";
				$this->Crud_Model->Updatedata($id,$fieldName,$table,$data);
				$message = '<body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 18px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><table class="body-wrap" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 18px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 18px; margin: 0;"><td style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 18px; vertical-align: top; margin: 0;" valign="top"></td><td class="container" width="600" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 18px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top"><div class="content" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 18px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;"><table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 18px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="alert alert-warning" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" align="center" bgcolor="#2f353f" valign="top"><img src="'.base_url("assest/administrator/images/logo.png").'" width="150" height="auto"></td></tr><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top"> </td></tr><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 24px;line-height:28px;vertical-align: top; margin: 0; padding: 10px 20px;" valign="top"><p>KD Bhindi Jewellers - Admin Panel</p><hr><p style="font-family:Verdana;">Username : <b>'.$username.'</b></p><p style="font-family:Verdana;">New Password : <b>'.$psw.'</b></p><br><p style="line-height:38px;">Please click on below link <br><a target="_blank" href="'.base_url().'administrator/">Login Now</a></p></td></tr><tr><td><table width="100%" cellpadding="5" cellspacing="2" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"></table><br></td></tr><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top"></td></tr><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Thank you. </td></tr></table></td></tr></table></div></td><td style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td></tr></table></body>';									
				//echo $message ; exit;
				  if(send_mail('YOUREMAIL',$message,'KD Bhindi Reset Admin Password')){
						   $this->session->set_flashdata("success","Email sent successfully. Check Your Mail...");
				  }
				  else{
						 //show_error($this->email->print_debugger());
						 $this->session->set_flashdata("errors","Email sent error"); 
				  }
				  redirect("administrator/home/forgot_password");
			}else{
				$this->session->set_flashdata("errors","Error :Email does not Exist...!");
				redirect("administrator/home/forgot_password");
			}		
		}
	}
	public function reset_password(){ 
		$token = $this->input->get('key');
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('token',$token);
		$query = $this->db->get();
		if($query->num_rows()==1){
			$data['token'] = $token;
			$data['action']		=	base_url('administrator/home/update_password/'.$token);
			$this->load->view('administrator/reset_password',$data);
		}else{
			$this->session->set_flashdata('errors', 'Error :Try Again...Your key is invalid or expired.');				
			redirect("administrator/home");
		}
	} 	
	public function update_password($token){ 
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
			if($this->form_validation->run() == FALSE) {
				$this->db->select('*');
				$this->db->from('admin');
				$this->db->where('token',$token);
				$query = $this->db->get();
				if($query->num_rows()==1){
					$data['token'] = $token;
					$data['action']		=	base_url('administrator/home/update_password/'.$token);
					$this->load->view('administrator/reset_password',$data);
				}else{
					$this->session->set_flashdata('errors', 'Error :Try Again...Your key is invalid or expired.');				
					redirect("administrator/home");
				}
			}else{
				$password= $this->input->post('password');
			    $cpassword=$this->input->post('cpassword');
				$this->db->select('*');
				$this->db->from('admin');
				$this->db->where('token',$token);
				$query = $this->db->get();
				$rec_id = $query->result_array();
				if($query->num_rows()==1){ 
					$data = array('password' => md5($password),'token' => '');
					$this->db->where('id',$rec_id[0]['id']);
					$this->db->update('admin', $data);
					$this->session->set_flashdata('success', 'Your Password updated successfully');				
					redirect("administrator/home");
				}else{
					$this->session->set_flashdata('errors', 'Error :Try Again...Your key is invalid or expired.');					
					redirect("administrator/home/reset_password?key=".$token);
				}
			}
	} 
}
?>