<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// session_start(); //we need to call PHP's session object to access it through CI
class Myprofile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('myprofile_model','',TRUE);
		checklogin();
	}
 
	function index()
	{
		$this->load->view('template/header.php');
		$this->load->view('myprofile/addEdit');
		$this->load->view('template/footer.php');
	}
 
	function addEdit($id=NULL)
	{
		//echo $user_id;
		$result = "";
		$result['user_details'] = $this->myprofile_model->getFormdata($_SESSION["chheda_webadmin"][0]->user_id);
		
		$this->load->view('template/header.php');
		$this->load->view('myprofile/addEdit',$result);
		$this->load->view('template/footer.php');
	}
 
	function submitForm()
	{
		// print_r($_POST);
		// exit;
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$condition = "email_id = '".$_POST['email_id']."' ";
			$condition .= " AND  user_id != ".$_SESSION["chheda_webadmin"][0]->user_id;
			
			$check_name = $this->myprofile_model->checkRecord("tbl_admin_users",$_POST,$condition);
			
			if(!empty($check_name[0]->vendor_id))
			{
				echo json_encode(array("success" => false,'msg'=>'Email ID already exist!'));
				exit;
			}
			
			$data = array();
			$data['first_name'] = $_POST['first_name'];
			$data['last_name'] = $_POST['last_name'];
			$data['email_id'] = $_POST['email_id'];
			$data['phone'] = $_POST['phone'];
			$data['updated_by'] = $_SESSION["chheda_webadmin"][0]->user_id;	
			$data['updated_on'] = date("Y-m-d H:i:s");
			$result = $this->myprofile_model->updateRecord('tbl_admin_users', $data, 'user_id', $_SESSION["chheda_webadmin"][0]->user_id);
			
			if(!empty($result))
			{
				echo json_encode(array('success' => true, 'msg'=>'Record Updated Successfully.'));
				exit;
			}
			else
			{
				echo json_encode(array('success' => false, 'msg'=>'Problem while updating record.'));
				exit;
			}
		}
		else
		{
			echo json_encode(array('success' => false, 'msg'=>'Problem while updating record.'));
			exit;
		}
	}
}

?>
