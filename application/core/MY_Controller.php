<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
 {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('common_function_helper');  
		$this->load->library('image_lib'); //load library
		$this->load->helper('file');
		$this->load->library("cart");
		$this->data['base_url'] 		= $this->config->item('base_url');
		$this->data['base_assets'] 		= $this->config->item('base_assets');
		$this->data['base_uploads'] 		= $this->config->item('base_uploads');


		
		$DailyRateChangerDetails = DailyRateChangerDetails();
		$this->data['DailyRateChangerDetails'] = $DailyRateChangerDetails['name'];
		$this->data['WebsiteInformation'] =WebsiteInformation();
		$this->data['CollectionDetails'] =CollectionDetails();
		$this->data['CategoryDetails'] =CategoryDetails();
		$this->data['GenderDetails'] =GenderDetails();
		$this->data['TestimonialDetails'] =TestimonialDetails();
		$this->data['PriceRangeDetails'] =PriceRangeDetails();
		
	}
	public function is_admin_logged_in()
	{
	   if($this->session->userdata('KDBhindiAdminSession'))
	    {
	    	$this->load->model('administrator/User','',TRUE);
	    	$user=$this->session->userdata('KDBhindiAdminSession');
	    	$result = $this->User->login($user->id,'',true);
		    return true;
	    }
	 	else
	    {
	         redirect('administrator/home');
	         exit;
	    }
	}
	function do_upload_img($folder,$image,$size){	
		if(!is_dir('uploads/'.$folder.'/')){
			@mkdir('uploads/'.$folder.'/', 0777);
		}
		// if(!is_dir('assets/uploads/'.$folder.'/'.$folderId)){
		// 	//@mkdir('assets/uploads/'.$folder.'/'.$folderId, 0777);
		// } 
		if(!is_dir('uploads/'.$folder.'/thumbnails')){
			@mkdir('uploads/'.$folder.'/thumbnails', 0777);
		}
		$file_name=date('Y-m-d-H-i-s').str_replace(' ','',$_FILES[$image]['name']);
		$config = array(
			//'allowed_types' => 'gif|GIF|JPG|jpg|JPEG|jpeg|PNG|png|TIFF|tiff|PSD|psd',
			'allowed_types' => '*',
			'upload_path' => 'uploads/'.$folder.'/',
			'file_name' => str_replace(' ','',$file_name),
			'max_size'=>5380334
		);
		//$file_name=date('Y-m-d-H-i-s').str_replace(' ','',$_FILES[$image]['name']);
		$this->upload->initialize($config);
		$this->upload->do_upload($image); //do upload
		$image_data = $this->upload->data(); //get icon data
		if($size){
			$config1 = array(	  
			'source_image' => $_FILES[$image]['tmp_name'], //get original image
			'new_image' => 'uploads/'.$folder.'/thumbnails'.'/'.$file_name, 
			'maintain_ratio' => false,
			'width' =>  $size['width'],
			'height' => $size['height']
			//'master_dim' => 'width'
			);               
			$this->image_lib->initialize($config1);
			$resize_img = $this->image_lib->resize(); //do whatever specified in config
			unset($config1);
		}
		$image_name=$image_data['file_name'];
		return $image_name;                
	}
	function do_multiple_upload_images($folder,$folderId,$imagename,$tmp_name,$size,$file){	
		if(!is_dir('assets/uploads/'.$folder.'/')){
			@mkdir('assets/uploads/'.$folder.'/', 0777);
		}
		if(!is_dir('assets/uploads/'.$folder.'/'.$folderId)){
			@mkdir('assets/uploads/'.$folder.'/'.$folderId, 0777);
		} 
		if(!is_dir('assets/uploads/'.$folder.'/thumbnails')){
			@mkdir('assets/uploads/'.$folder.'/thumbnails', 0777);
		} 
		$config1 = array(
			'source_image' => $tmp_name, //get original image
			'allowed_types' => 'gif|GIF|JPG|jpg|JPEG|jpeg|PNG|png|TIFF|tiff|PSD|psd',
			'allowed_types' => '*',
			'upload_path' => 'assets/uploads/'.$folder.'/'.$folderId,
			'file_name' => str_replace(' ','',$imagename),
			'max_size'=>5380334
		);
		// $config2 = array(	  
		// 	'source_image' => $tmp_name, //get original image
		// 	'new_image' => 'assets/uploads/'.$folder.'/'.$folderId.'/', 
		// 	'
		// 	//'master_dim' => 'width'
		// 	);
		$file_name=str_replace(' ','',$imagename);
		$this->upload->initialize($config1);
		$this->upload->do_upload($file); //do upload
		$image_data = $this->upload->data(); //get icon data
		if($size){
			$config2 = array(	  
			'source_image' => $tmp_name, //get original image
			'new_image' => 'assets/uploads/'.$folder.'/thumbnails'.'/'.$file_name, 
			'maintain_ratio' => false,
			'width' =>  $size['width'],
			'height' => $size['height']
			//'master_dim' => 'width'
			);               
			$this->image_lib->initialize($config2);
			$resize_img = $this->image_lib->resize(); //do whatever specified in config
			unset($config2);
		}
		$image_name=$image_data['file_name'];
		return $image_name;                
	}
}
?>
