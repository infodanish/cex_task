<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// session_start(); //we need to call PHP's session object to access it through CI
class Customers extends CI_Controller
{
	function __construct(){
		parent::__construct();

		// $this->load->helper('erp_setting');

		$this->load->model('customersmodel', '', TRUE);
		checklogin();
	}

	function index(){
		
		$this->load->view('template/header.php');
		$this->load->view('customers/index');
		$this->load->view('template/footer.php');
	
	}

	function addEdit($id = NULL){
		$record_id = "";

		// print_r($_GET);

		if (!empty($_GET['text']) && isset($_GET['text'])) {
			$varr = base64_decode(strtr($_GET['text'], '-_', '+/'));
			parse_str($varr, $url_prams);
			$record_id = $url_prams['id'];
		}
		// print_r($record_id);exit;
		$result = "";
		$result['details'] = $this->customersmodel->getFormdata($record_id);
		
		$this->load->view('template/header.php');
		$this->load->view('customers/addEdit', $result);
		$this->load->view('template/footer.php');
	}
	
	/*new code*/
	function view($id = NULL){
			$record_id = "";

			// print_r($_GET);

			if (!empty($_GET['text']) && isset($_GET['text'])) {
				$varr = base64_decode(strtr($_GET['text'], '-_', '+/'));
				parse_str($varr, $url_prams);
				$record_id = $url_prams['id'];
			}
			$result = "";
			$result['details'] = $this->customersmodel->getFormdata($record_id);
			
            
			$this->load->view('template/header.php');
			$this->load->view('customers/view', $result);
			$this->load->view('template/footer.php');
	}
	/*new code end*/
	
	function fetch()
	{
		$get_result = $this->customersmodel->getRecords($_GET);
		$result = array();
		$result["sEcho"] = $_GET['sEcho'];
		$result["iTotalRecords"] = $get_result['totalRecords']; //	iTotalRecords get no of total recors
		$result["iTotalDisplayRecords"] = $get_result['totalRecords']; //  iTotalDisplayRecords for display the no of records in data table.
		$items = array();
		for ($i = 0; $i < sizeof($get_result['query_result']); $i++) {
			$temp = array();
			
			array_push($temp, $get_result['query_result'][$i]->first_name);	
			array_push($temp, $get_result['query_result'][$i]->last_name);
			array_push($temp, $get_result['query_result'][$i]->email_id);
			array_push($temp, $get_result['query_result'][$i]->phone_no);
			
			$actionCol21="";
			$actionCol21 .= '<a href="javascript:void(0);" onclick="changestatus(\'' . $get_result['query_result'][$i]->user_id . '\',\'' . $get_result['query_result'][$i]->status. '\');" title="Delete" class="btn btn-sm">'.$get_result['query_result'][$i]->status .'</a>';
			
			$actionCol1 = "";
			
			$actionCol1.= '<a href="customers/view?text=' . rtrim(strtr(base64_encode("id=" . $get_result['query_result'][$i]->user_id) , '+/', '-_') , '=') . '" title="View">View</a>';
			
			$actionCol = "";
			$actionCol.= '<a href="customers/addEdit?text=' . rtrim(strtr(base64_encode("id=" . $get_result['query_result'][$i]->user_id) , '+/', '-_') , '=') . '" title="Edit"><i class="fa fa-edit"></i></a>';
			//$actionCol.= '&nbsp;&nbsp;<a href="javascript:void(0);" onclick="deleteData(\'' . $get_result['query_result'][$i]->user_id . '\');" title="Delete"><i class="fa fa-remove"></i></a>';
			
			
			array_push($temp, $actionCol21);
			
			array_push($temp, $actionCol1);
			array_push($temp, $actionCol);
			
			
			array_push($items, $temp);
		}

		$result["aaData"] = $items;
		echo json_encode($result);
		exit;
	}
	
	function export()
	{
		$this->load->library("excel");
		
		$get_result = $this->customersmodel->getExportRecords($_POST);
		
	    //echo "<pre>"; print_r($get_result); exit;
		
		//Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		//Set properties
		$objPHPExcel->getProperties()->setCreator("Attoinfotech")
		->setLastModifiedBy("Attoinfotech")
		->setTitle("Office 2007 XLSX Test Document")
		->setSubject("Office 2007 XLSX Test Document")
		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
		->setKeywords("office 2007 openxml php")
		->setCategory("Export Excel");
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('OutPut-File');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->setCellValueExplicit("A1",'FULL NAME',PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValueExplicit("B1",'EMAIL',PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValueExplicit("C1",'PHONE',PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValueExplicit("D1",'CRATED',PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->getStyle("A1:AA1")->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:C20')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
		
		$j = 2;
		
		for($i=0;$i<sizeof($get_result['query_result']);$i++)
		{
			$objPHPExcel->getActiveSheet()->setCellValueExplicit("A$j", $get_result['query_result'][$i]->full_name);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit("B$j", $get_result['query_result'][$i]->email_id);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit("C$j", $get_result['query_result'][$i]->phone_no);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit("D$j", $get_result['query_result'][$i]->created_on);
			
			$j++;
		}
		// Redirect output to a client's web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Customers('.date('d-m-Y').').xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
	
	

	function submitForm()
	{ 
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
			if(empty($_POST['email_id']))
			{
				echo json_encode(array('success' => '0','msg' => 'Please enter email id..'));
				exit;
			}
			
			$condition = "email_id = '".trim($_POST['email_id'])."' ";
			if(!empty($_POST['user_id'])) {
				$condition.=" AND user_id != ".$_POST['user_id'];
			}
			$check_exist = $this->customersmodel->getData('tbl_users',"user_id",$condition);
			// print_r($check_exist);
			if(!empty($check_exist[0]->user_id))
			{
				echo json_encode(array('success' => '0','msg' => 'Email id already exist..'));
				exit;
			}
			
			$data_array = array();			
			
			$data_array['first_name'] = trim($_POST['first_name']);
			$data_array['last_name'] = trim($_POST['last_name']);
			$data_array['full_name'] = trim($_POST['first_name'])." ".trim($_POST['last_name']);
			$data_array['email_id'] = trim($_POST['email_id']);
			$data_array['phone_no'] = $_POST['phone_no'];	
			
			$data_array['updated_by']=$_SESSION["chheda_webadmin"][0]->user_id;
			$data_array['updated_on'] = date("Y-m-d H:i:s");
			
			if (!empty($_POST['user_id'])) 
			{    
				$result = $this->customersmodel->updateRecord('tbl_users', $data_array,'user_id',$_POST['user_id']);
			}
			else 
			{
				$data_array['password'] = md5($_POST['password']);
				$data_array['created_on'] = date("Y-m-d H:i:s");
				$data_array['created_by'] = $_SESSION["chheda_webadmin"][0]->user_id;
				$data_array['status'] = 'Active';

				$result = $this->customersmodel->insertData('tbl_users', $data_array, '1');
				$condition1 = array("mail_Key"=>"USER_USER_REGI");
				$getAdminEmailContents = $this->usersmodel->getEmailRecord('tbl_emailcontents','*',$condition1);

				if(!empty($getAdminEmailContents[0]->mail_Key)){
					//echo "infomail: ".infomail;exit;
					$message	= str_replace(array(				
						'{first_name}',
						'{username}',
						'{password}'
						), array(
						$_POST['first_name'],				
						$_POST['user_name'],
						$_POST['password'],	
						), $getAdminEmailContents[0]->content);
						
					/* echo "1:----".$message;
					exit;		 */			
						
					$this->email->clear();
					$this->email->from(FROM_EMAIL); // change it to yours
					$this->email->to($_POST['email_id']); // change it to yours
					$this->email->subject($getAdminEmailContents[0]->subject);
					$this->email->message($message);
					$checkemail = $this->email->send();
					//$this->email->clear(TRUE);
				}	
			}
			if(!empty($result)) {
				echo json_encode(array('success' => '1', 'msg' => 'Record Added/Updated Successfully.'));
				exit;
			}else{
				echo json_encode(array('success' => '0', 'msg' => 'Problem while data update.'));
				exit;
			}
		}else {
			echo json_encode(array('success' => '0', 'msg' => 'Problem while add/edit data.'));
			exit;
		}
	
	}
	
	function set_upload_options()
	{   
		//upload an image options //products
		$config = array();
		//$config['file_name']     = md5(uniqid("100_ID", true));
		$config['upload_path'] = DOC_ROOT_FRONT."/images/products";
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;

		return $config;
	}
	
	function changestatus() 
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {			
			if(!empty($_POST['id']) && !empty($_POST['status'])){	
				$id         = $_POST['id'];
				$data['status'] = $_POST['status'];
				
				$appdResult = $this->customersmodel->updateRecord("tbl_users", $data, "user_id",$id);
				if($appdResult) {
					echo json_encode(array('success'=>true));
					exit;
				}else{
					echo json_encode(array('success'=>false));
					exit;
				}
			}else{
				echo json_encode(array('success'=>false));
				exit;
			}
		}else{
			echo json_encode(array('success'=>false));
			exit;
		}		
	}
	
	function dataExist()
	{
		 if($_POST['user_id']==""){
			$result=$this->customersmodel->dataExist("tbl_users",$_POST['email_id']);
			if($result>0){
				echo  json_encode(FALSE);
			}else{
				echo  json_encode(TRUE);
			}
		 }else{
			 $result=$this->customersmodel->dataExist("tbl_users",$_POST['email_id']);
			 if($result==$_POST['user_id']){
				echo  json_encode(TRUE);
			 }else if($result==0){
				echo  json_encode(TRUE); 
			 }else if($result!=$_POST['user_id'] && $result>0){
				 echo  json_encode(FALSE);
			 }
		} 
	}
}


?>
