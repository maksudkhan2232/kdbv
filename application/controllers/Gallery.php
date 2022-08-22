<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/Crud_Model');		
    }
	public function index()
	{
		$this->data['title'] = "Photo Gallery |  KD Bhindi Jewellers";
		$this->load->view('gallery',$this->data);
	}
	public function fetch_photo_gallery()
    {
        $this->db->select('photo_gallery_detail.*,photo_gallery.name');
	    $this->db->from('photo_gallery_detail');
	    $this->db->join('photo_gallery', 'photo_gallery_detail.event_id = photo_gallery.id');
	    $this->db->where('photo_gallery.status',1);
	    $this->db->order_by('photo_gallery_detail.id', "desc");
	    $this->db->limit($this->input->post('limit'), $this->input->post('start'));
	    $viewdata=  $this->db->get()->result_array();

        $output = '';
        foreach ($viewdata as $key => $val) 
        {
           $output.='<div class="col-sm-6 col-md-4 col-lg-3 item mb-3 pl-2 pr-2 img-hover-zoom"><a href="'.base_url().'uploads/photo/'.$val['image_name'].'" data-lightbox="photos"><img class="img-fluid" src="'.base_url().'uploads/photo/thumb/'.$val['image_name'].'"></a></div>';
        }



        $this->db->select('photo_gallery_detail.*,photo_gallery.name');
	    $this->db->from('photo_gallery_detail');
	    $this->db->join('photo_gallery', 'photo_gallery_detail.event_id = photo_gallery.id');
	    $this->db->where('photo_gallery.status',1);
	    $this->db->order_by('photo_gallery_detail.id', "desc");
	    $cnt_data=  $this->db->get()->result_array();

        $total_rows = count($cnt_data);
        echo json_encode(array('gdata'=>$output,'total_rows'=>$total_rows));
    }
}