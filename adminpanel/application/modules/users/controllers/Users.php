<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Users extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('usersmodel','',TRUE);
		checklogin();
	}
 
	function index()
	{
		$result['roles'] = $this->usersmodel->getData("role_id, role_name", "roles", "", "role_name", "asc");
		//print_r($result);exit;
		
		$this->load->view('template/header.php');
		$this->load->view('users/index',$result);
		$this->load->view('template/footer.php');
	}
 
	function fetch()
	{
		//print_r($_GET);
		$get_result = $this->usersmodel->getRecords($_GET);
		
		//print_r($get_result['query_result']);
		//echo "Count: ".$get_result['totalRecords'];
		
		$result = array();
		$result["sEcho"]= $_GET['sEcho'];
		
		$result["iTotalRecords"] = $get_result['totalRecords'];	//iTotalRecords get no of total recors
		$result["iTotalDisplayRecords"]= $get_result['totalRecords']; //iTotalDisplayRecords for display the no of records in data table.
		
		$items = array();
		
		if(!empty($get_result['query_result']) && count($get_result['query_result']) > 0) 
		{
			for($i=0;$i<sizeof($get_result['query_result']);$i++)
			{
				$temp = array();
				array_push($temp, $get_result['query_result'][$i]->user_name);
				array_push($temp, $get_result['query_result'][$i]->first_name);
				array_push($temp, $get_result['query_result'][$i]->last_name);
				array_push($temp, $get_result['query_result'][$i]->email_id);
				array_push($temp, $get_result['query_result'][$i]->phone);
				array_push($temp, $get_result['query_result'][$i]->role_name);
				array_push($temp, $get_result['query_result'][$i]->status);
				
				$actionCol = "";
			//	if ($this->privilegeduser->hasPrivilege("UserAddEdit")) 
				//{
					$actionCol .='<a href="users/addEdit?text='.rtrim(strtr(base64_encode("id=".$get_result['query_result'][$i]->user_id), '+/', '-_'), '=').'" title="Edit"><i class="fa fa-edit"></i></a>';
			//	}
				/* if ($this->privilegeduser->hasPrivilege("UserDelete")) {
					$actionCol .='&nbsp;&nbsp;<a href="javascript:void(0);" onclick="deleteData(\''.$get_result['query_result'][$i]->user_id.'\');" title="Delete"><i class="fa fa-remove"></i></a>';
				} */
				
				array_push($temp, $actionCol);
				array_push($items, $temp);
			}
		}
		
		$result["aaData"] = $items;
		echo json_encode($result);
		exit;
	}
	
	function addEdit($id=NULL)
	{
		//print_r($_GET);
		$user_id = "";
		if(!empty($_GET['text']) && isset($_GET['text']))
		{
			$varr=base64_decode(strtr($_GET['text'], '-_', '+/'));	
			parse_str($varr,$url_prams);
			$user_id = $url_prams['id'];
		}
		
		//echo $user_id;
		$result['roles'] = $this->usersmodel->getData("role_id, role_name", "roles", "", "role_name", "asc");
		$result['users'] = $this->usersmodel->getFormdata($user_id);
		
		// echo "<pre>";
		// print_r($result);
		// exit;
		
		$this->load->view('template/header.php');
		$this->load->view('users/addEdit',$result);
		$this->load->view('template/footer.php');
	}
 
	function submitForm()
	{
			
		//print_r($_POST);
		//exit;
		
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$condition = "user_name= '".$_POST['user_name']."'";
			if(isset($_POST['user_id']) && $_POST['user_id'] > 0)
			{
				$condition .= " AND  user_id != ".$_POST['user_id'];
			}
			
			$check_name = $this->usersmodel->checkRecord($_POST,$condition);
			if(!empty($check_name[0]->user_id))
			{
				echo json_encode(array("success"=>false, 'msg'=>'User Already Present!'));
				exit;
			}
			
			$condition1 = "email_id= '".$_POST['email_id']."'";
			if(isset($_POST['user_id']) && $_POST['user_id'] > 0)
			{
				$condition1 .= " AND  user_id != ".$_POST['user_id'];
			}
			
			$check_name1 = $this->usersmodel->checkRecord($_POST,$condition1);
			if(!empty($check_name1[0]->user_id))
			{
				echo json_encode(array("success"=>false, 'msg'=>'User Already Present!'));
				exit;
			}
			
			$data = array();
			$data['role_id'] = $_POST['role_id'];
			$data['first_name'] = $_POST['first_name'];
			$data['last_name'] = $_POST['last_name'];
			$data['email_id'] = $_POST['email_id'];
			$data['phone'] = $_POST['phone'];
			$data['status'] = $_POST['status'];
			$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] = $_SESSION["chheda_webadmin"][0]->user_id;
			
			if(!empty($_POST['user_id']))
			{
				//update
				$result = $this->usersmodel->updateUserId($data,$_POST['user_id']);
				
				if($result)
				{
					echo json_encode(array('success'=>true, 'msg'=>'Record Updated Successfully'));
					exit;
				}
				else
				{
					echo json_encode(array('success'=>false, 'msg'=>'Problem while updating data.'));
					exit;
				}
			}
			else
			{
				//add
				$data['user_name'] = $_POST['user_name'];
				$data['password'] = md5($_POST['password']);
				$data['created_on'] = date("Y-m-d H:i:s");
				$data['created_by'] = $_SESSION["chheda_webadmin"][0]->user_id;
				
				$result = $this->usersmodel->insertData('tbl_admin_users',$data,'1');
				
				$condition = array("mail_Key"=>"ADMIN_USER_REGI");
				$getAdminEmailContents = $this->usersmodel->getEmailRecord('tbl_emailcontents','*',$condition);

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
				
				if(!empty($result))
				{
					echo json_encode(array("success"=>true, 'msg'=>'Record Added Successfully.'));
					exit;
				}
				else
				{
					echo json_encode(array("success"=>false, 'msg'=>'Problem while adding data.'));
					exit;
				}
			}
		}
		else
		{
			echo json_encode(array("success"=>false, 'msg'=>'Problem while Add/Edit data..'));
			exit;
		}
	}
 
	//For Delete
	function delRecord($id)
	{
		$data = array();
		$data['status'] = "In-active";
		$appdResult = $this->usersmodel->delrecord("tbl_admin_users","user_id",$id,$data);
		
		if($appdResult)
		{
			echo "1";
		}
		else
		{
			echo "2";	
				 
		}	
	}	
	function dataEmailExist(){
		 if($_POST['user_id']==""){
			$result=$this->usersmodel->dataExist("tbl_admin_users",$_POST['email_id'],"email_id");
			if($result>0){
				echo  json_encode(FALSE);
			}else{
				echo  json_encode(TRUE);
			}
		 }else{
			 $result=$this->usersmodel->dataExist("tbl_admin_users",$_POST['email_id'],"email_id");
			 if($result==$_POST['user_id']){
				echo  json_encode(TRUE);
			 }else if($result==0){
				echo  json_encode(TRUE); 
			 }else if($result!=$_POST['user_id'] && $result>0){
				 echo  json_encode(FALSE);
			 }
		 } 
	 }
	function dataUsernameExist(){
		 if($_POST['user_id']==""){
			$result=$this->usersmodel->dataExist("tbl_admin_users",$_POST['user_name'],"user_name");
			if($result>0){
				echo  json_encode(FALSE);
			}else{
				echo  json_encode(TRUE);
			}
		 }else{
			 $result=$this->usersmodel->dataExist("tbl_admin_users",$_POST['user_name'],"user_name");
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