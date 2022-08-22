<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax_banner extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->is_admin_logged_in();
		$this->load->model('administrator/Crud_Model');
	}
	public function savebanner()
	{
		define('SHPBANIMG',"uploads/");
		$bannnerno = $this->input->post('bannnerno');
		$max_width = 820;
		$valid_formats = array("jpg", "png", "jpeg");
		$name = $_FILES['prodImage'.$bannnerno]['name'];
		$size = $_FILES['prodImage'.$bannnerno]['size'];
		if(strlen($name)) {
			list($txt, $ext) = explode(".", $name);
			$splitName = explode(".", $name); //split the file name by the dot
			$ext = end($splitName);
			if(in_array($ext,$valid_formats)) {
					$actual_image_name = $name; 
					$txt = "eve_".time();
					$actual_image_name  = $newiagename = $name = $txt.'.'.$ext;
					$filePath = SHPBANIMG .$actual_image_name;
					$tmp = $_FILES['prodImage'.$bannnerno]['tmp_name']; 
					if(move_uploaded_file($tmp, $filePath)) 
					{ 
						$width = getWidth($filePath); 
						$height = getHeight($filePath); 
						if(strtolower($ext) == "png"){
							$name = $newiagename . '.jpg';
							$dst_filename = $name;
							$srcFileName = SHPBANIMG.$name;
							$src_ext = "jpg";
							$filedir = SHPBANIMG;
							chmod($filePath, 0777);
							$actual_image_name = $name;
							imagejpeg (convert_image_new($filePath), "$filedir$name", 90 );
						}
						$filePath = SHPBANIMG . $name;
						if ($width > $max_width){ 
							$scale = $max_width/$width;
							$uploaded = resizeImageNew($filePath,$width,$height,$scale,"jpg");
						} else {
							$scale = 1;
							$uploaded = resizeImageNew($filePath,$width,$height,$scale,"jpg");
						}
						chmod($filePath, 0777);
						echo "<div style='margin-top:10px;' class='img-container'><input type='hidden' name='ext' id='ext' value='jpg'><img id='bannerphoto' file-name='".$name."' src='".base_url().$filePath.'?'.time()."' class='preview'/></div><div class='row'>
							<div class='btn-group crop-allbtn'>
							  <button type='button' class='btn btn-info' onclick='zoomplusbanner();' data-method='zoom' data-option='0.1' title='Zoom In'>
					            <span class='docs-tooltip' data-toggle='tooltip' data-animation='false' >
					              <i class='fa fa-search-plus'></i>
					            </span>
					          </button>
					          <button type='button' class='btn btn-info' onclick='zoomminusbanner();' data-method='zoom' data-option='-0.1' title='Zoom Out'>
					            <span class='docs-tooltip' data-toggle='tooltip' data-animation='false'>
					              <span class='fa fa-search-minus'></span>
					            </span>
					          </button>
					          <button type='button' class='btn btn-warning' onclick='rotateleftbanner();' data-method='rotate' data-option='-45' title='Rotate Left'>
					            <span data-toggle='tooltip' data-animation='false'>
					              <i class='fa fa-undo'></i>
					            </span>
					          </button>
					          <button type='button' class='btn btn-warning' onclick='rotaterightbanner();' data-method='rotate' data-option='45' title='Rotate Right'>
					            <span  data-toggle='tooltip' data-animation='false'>
					              <i class='fa fa-repeat'></i>
					            </span>
					          </button>
					        </div>
					          <button type='button' id='save_crop' onclick='savecropbanner();' class='btn btn-primary'>Save</button></div>";

					}
					else
						echo "failed";
			}
			else
				echo "Invalid file format..";
		}
	}
	public function bannerimagetemp()
	{
		define('SHPBANRIMG',"uploads/events/completed/");
		$post = isset($_POST) ? $_POST: array();
		$filename = $_POST['filename'];
		$img = $_POST['pngimageData'];
		$ext = $_POST['imageext'];
		if ($ext == "png")
			$img = str_replace('data:image/png;base64,', '', $img);
		else
			$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		file_put_contents(SHPBANRIMG. $filename, $data);
		$imagePath = SHPBANRIMG.$filename;
		chmod(SHPBANRIMG. $filename, 0777);
		$uploaded = resizeImageNew($imagePath,800,400,1,"jpg");
		@unlink("uploads/".$filename);
		echo json_encode(array("img_path"=>base_url().$imagePath,"up_image"=>$filename));
		exit(0);
	} 
	public function bannerimagetestimonial()
	{
		define('SHPBANRIMG',"uploads/testimonial/");
		$post = isset($_POST) ? $_POST: array();
		$filename = $_POST['filename'];
		$img = $_POST['pngimageData'];
		$ext = $_POST['imageext'];
		if ($ext == "png")
			$img = str_replace('data:image/png;base64,', '', $img);
		else
			$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		file_put_contents(SHPBANRIMG. $filename, $data);
		$imagePath = SHPBANRIMG.$filename;
		chmod(SHPBANRIMG. $filename, 0777);
		$uploaded = resizeImageNew($imagePath,80,80,1,"jpg");
		@unlink("uploads/".$filename);
		echo json_encode(array("img_path"=>base_url().$imagePath,"up_image"=>$filename));
		exit(0);
	} 
	public function bannerimagetempphoto()
	{
		define('SHPBANRIMG',"uploads/photo/");
		$post = isset($_POST) ? $_POST: array();
		$filename = $_POST['filename'];
		$img = $_POST['pngimageData'];
		$ext = $_POST['imageext'];
		if ($ext == "png")
			$img = str_replace('data:image/png;base64,', '', $img);
		else
			$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		file_put_contents(SHPBANRIMG. $filename, $data);
		$imagePath = SHPBANRIMG.$filename;
		chmod(SHPBANRIMG. $filename, 0777);
		$uploaded = resizeImageNew($imagePath,370,375,1,"jpg");
		@unlink("uploads/".$filename);
		echo json_encode(array("img_path"=>base_url().$imagePath,"up_image"=>$filename));
		exit(0);
	} 


	public function bannerimagetempoffer()
	{
		define('SHPBANRIMG',"uploads/offer/");
		$post = isset($_POST) ? $_POST: array();
		$filename = $_POST['filename'];
		$img = $_POST['pngimageData'];
		$ext = $_POST['imageext'];
		if ($ext == "png")
			$img = str_replace('data:image/png;base64,', '', $img);
		else
			$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		file_put_contents(SHPBANRIMG. $filename, $data);
		$imagePath = SHPBANRIMG.$filename;
		chmod(SHPBANRIMG. $filename, 0777);
		$uploaded = resizeImageNew($imagePath,900,500,1,"jpg");
		@unlink("uploads/".$filename);
		echo json_encode(array("img_path"=>base_url().$imagePath,"up_image"=>$filename));
		exit(0);
	} 
}