<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function number_to_word( $num = '' ){
    $number = $num;
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? ' ' : null; //remove s ''
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Only ' : '') . $paise;
}
function getHeight($image) {
    $sizes = getimagesize($image);
    $height = $sizes[1];
    return $height;
}
/* Function to get image width */
function getWidth($image) {
    $sizes = getimagesize($image);
    $width = $sizes[0];
    return $width;
}
function convert_image_new($convFile){
    $input = imagecreatefromstring( file_get_contents( $convFile ) );
    list($width, $height) = getimagesize($convFile);
    $output = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($output,  255, 255, 255);
    imagefilledrectangle($output, 0, 0, $width, $height, $white);
    imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
    return $output; //imagejpeg($output, $output_file);
}
/* Function to resize image */
function resizeImageNew($image,$width,$height,$scale, $ext) {
    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
    //$source = imagecreatefromjpeg($image);
    switch ($ext) {
        case 'jpg':
            $source = imagecreatefromjpeg($image);
        case 'jpeg':
            $source = imagecreatefromjpeg($image);
            break;
        case 'gif':
            $source = imagecreatefromgif($image);
            break;
        case 'png':
            $source = imagecreatefrompng($image);
            break;
        default:
            $source = false;
            break;
    }
    $width = imagesx($source);
    $height = imagesy($source);
    imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
    switch ($ext) {
        case 'jpg':
            imagejpeg($newImage,$image,90);
            break;
        case 'jpeg':
            imagejpeg($newImage,$image,90);
            break;
        case 'png':
            imagepng($newImage,$image,90,"PNG_ALL_FILTERS");
            break;
        default:
            imagejpeg($newImage,$image,90);
            break;
    }
    return $image;
}
function get_upcoming_events()
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('events');
    $ci->db->where('status',1);
    $ci->db->order_by("id","desc");
    $ci->db->limit(3);
    $query = $ci->db->get();
    return $query->result_array();
}
function compress($source, $destination, $quality)
{
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);
    imagejpeg($image, $destination, $quality);
    return $destination;
}
function make_thumb($src, $dest, $desired_width) {

    /* read the source image */
    $source_image = imagecreatefromjpeg($src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $dest);
}

function create_thumbAll($image1_path, $dest, $box=300){
    list($width1, $height1, $image1_type) = getimagesize($image1_path);
 
  //  $image2_path = dirname($image1_path) . '/tn_' .basename($image1_path);
    
	$image2_path =$dest;
     
    // make image smaller if doesn't fit to the box 
    if ($width1 > $box || $height1 > $box){
        // set the largest dimension
        $width2 = $height2 = $box;
        // calculate smaller thumb dimension (proportional)
        if ($width1 < $height1) $width2  = round(($box / $height1) * $width1);
        else                    $height2 = round(($box / $width1) * $height1);
         
        // set image type, blending and set functions for gif, jpeg and png
        switch($image1_type){
            case IMAGETYPE_PNG:  $img = 'png';  $blending = false; break;
            case IMAGETYPE_GIF:  $img = 'gif';  $blending = true;  break;
            case IMAGETYPE_JPEG: $img = 'jpeg'; break;
        }
        $imagecreate = "imagecreatefrom$img";
        $imagesave   = "image$img";
     
        // initialize image from the file
        $image1 = $imagecreate($image1_path);
 
        // create a new true color image with dimensions $width2 and $height2
        $image2 = imagecreatetruecolor($width2, $height2);
 
        // preserve transparency for PNG and GIF images
        if ($img == 'png' || $img == 'gif'){
          // allocate a color for thumbnail
            $background = imagecolorallocate($image2, 0, 0, 0);
            // define a color as transparent 
            imagecolortransparent($image2, $background);
            // set the blending mode for thumbnail
            imagealphablending($image2, $blending);
            // set the flag to save alpha channel  
            imagesavealpha($image2, true); 
        }
     
        // save thumbnail image to the file
        imagecopyresampled($image2, $image1, 0, 0, 0, 0, $width2, $height2, $width1, $height1);
        $imagesave($image2, $image2_path);
    }
    // else just copy the image
    else copy($image1_path, $image2_path);
}

function square_crop($src_image, $dest_image, $thumb_size = 64, $jpg_quality = 90)
{
    // Get dimensions of existing image
    $image = getimagesize($src_image);
    // Check for valid dimensions
    if( $image[0] <= 0 || $image[1] <= 0 ) return false;
    // Determine format from MIME-Type
    $image['format'] = strtolower(preg_replace('/^.*?\//', '', $image['mime']));
    // Import image
    switch( $image['format'] ) {
        case 'jpg':
        case 'jpeg':
            $image_data = imagecreatefromjpeg($src_image);
        break;
        case 'png':
            $image_data = imagecreatefrompng($src_image);
        break;
        case 'gif':
            $image_data = imagecreatefromgif($src_image);
        break;
        default:
            // Unsupported format
            return false;
        break;
    }
    // Verify import
    if( $image_data == false ) return false;
    // Calculate measurements
    if( $image[0] > $image[1] ) {
        // For landscape images
        $x_offset = ($image[0] - $image[1]) / 2;
        $y_offset = 0;
        $square_size = $image[0] - ($x_offset * 2);
    } else {
        // For portrait and square images
        $x_offset = 0;
        $y_offset = ($image[1] - $image[0]) / 2;
        $square_size = $image[1] - ($y_offset * 2);
    }
    // Resize and crop
    $canvas = imagecreatetruecolor($thumb_size, $thumb_size);
    if( imagecopyresampled(
        $canvas,
        $image_data,
        0,
        0,
        $x_offset,
        $y_offset,
        $thumb_size,
        $thumb_size,
        $square_size,
        $square_size
    )) {
        // Create thumbnail
        switch( strtolower(preg_replace('/^.*\./', '', $dest_image)) ) {
            case 'jpg':
            case 'jpeg':
                return imagejpeg($canvas, $dest_image, $jpg_quality);
            break;
            case 'png':
                return imagepng($canvas, $dest_image);
            break;
            case 'gif':
                return imagegif($canvas, $dest_image);
            break;
            default:
                // Unsupported format
                return false;
            break;
        }
    } else {
        return false;
    }
}
function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  // trim
  $text = trim($text, '-');
  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);
  // lowercase
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}

function send_mail($email="vinayakwebinfotech@gmail.com",$message,$subject,$attachment="")
{
    $ci = &get_instance();
    $ci->load->library('phpmailer_lib');
    $mail = $ci->phpmailer_lib->load();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'livingwoods.morbi@gmail.com';
    $mail->Password = 'edqeiyetsthfwvzd';				
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('vinayakinfotechjnd@gmail.com', $subject);
    if($attachment !=""){           
        $mail->addAttachment($attachment); 
    }
   // $mail->addAddress($email);
    $mail->addAddress('vinayakwebinfotech@gmail.com'); 
    $mail->Subject = $subject;
    $mail->IsHTML(true);
    $mail->Body = $message; 
    if(!$mail->send())
    {
        echo 'Error';
        echo  'Mailer Error: '. $mail->ErrorInfo; exit;
        return false;
    }
    else
    {                
        return true;
    }
}

function common_testimonials()
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->where("status",1);
    $ci->db->where("homepage",1);
    $res = $ci->db->from('testimonial')->get()->result_array();
    return  $res;
}

function DailyRateChangerDetails()
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->where("status",1);
    $res = $ci->db->from('dailyratechanger')->get()->row_array();
    return  $res;
}
function WebsiteInformation()
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->where("status",1);
	$ci->db->where("id",1);
    $res = $ci->db->from('admin')->get()->row_array();
    return  $res;
}
function CollectionDetails()
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->where("status",1);
    $res = $ci->db->from('category')->get()->result_array();
    return  $res;
}
function CategoryDetails()
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->where("status",1);
    $res = $ci->db->from('sub_category')->get()->result_array();
    return  $res;
}
function GenderDetails()
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->where("status",1);
    $res = $ci->db->from('gender')->get()->result_array();
    return  $res;
}
function TestimonialDetails()
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->where("status",1);
    $res = $ci->db->from('testimonial')->get()->result_array();
    return  $res;
}
function PriceRangeDetails()
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->where("status",1);
    $res = $ci->db->from('product_pricerange')->get()->result_array();
    return  $res;
}
function WelcomeNoteDetails()
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->where("status",1);
    $ci->db->limit(1);
    $res = $ci->db->from('welcomenote')->get()->row_array();
    return  $res;
}
function FooterGalleryDetails($limit=0)
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->order_by('rand()');
    if($limit!=0){
        $ci->db->limit($limit);    
    }    
    $res = $ci->db->from('photo_gallery_detail')->get()->result_array();
    return  $res;
}
function CategoryLimitedDetails($limit=0)
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->order_by('rand()');
    $ci->db->where("status",1);
    if($limit!=0){
        $ci->db->limit($limit);    
    }  
    $res = $ci->db->from('sub_category')->get()->result_array();
    return  $res;
}

function OfferImageSingleDetails()
{
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->where("status",1);
    $ci->db->order_by('id','DESC');
    $ci->db->limit(1);
    $res = $ci->db->from('offerzone')->get()->row_array();
    return  $res;
}




function get_admin($uid)
{
    $ci = &get_instance();
    $query = $ci->db->query("SELECT u.* FROM admin u WHERE u.id='".$uid."' ");
    $u = $query->row_array();
    return $u;
}


?>