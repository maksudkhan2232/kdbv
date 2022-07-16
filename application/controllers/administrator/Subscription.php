<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Subscription extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->is_admin_logged_in();
		$this->load->model('administrator/Crud_Model');
	}
	
	public function index()
	{
		$data['page_title']='Email Subscription';
		$data['active_menu'] = 'subscription';
		$data['sub_active_menu'] = '';
		$data['viewdata']=$this->Crud_Model->getDatafromtable('subscription');
		$this->load->view('administrator/view_subscription',$data);
	}
	
	public function createExcel() {
		$fileName = 'subscription.xlsx';  
		$employeeData = $this->Crud_Model->getDatafromtable('subscription');	
		// echo "<pre>"; print_r($employeeData)	; exit;
		$spreadsheet = new Spreadsheet();		
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
		$sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Date');
		
        $rows = 2;
		$abc=1;
        foreach ($employeeData as $val){
		$date = date('d-M-Y H:i:s',strtotime($val['created_at']));
            $sheet->setCellValue('A' . $rows, "".$abc);
            $sheet->setCellValue('B' . $rows, $val['email']);
            $sheet->setCellValue('C' . $rows, $date);
            $rows++;
			$abc++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("uploads/subscription/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/uploads/subscription/".$fileName);              
    } 
	
	
	
	
}
?>