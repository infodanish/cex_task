<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// session_start(); //we need to call PHP's session object to access it through CI
class Login extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		if(!empty($_SESSION["chheda_webadmin"]))
		{
			redirect('home/index', 'refresh');
		}
		$this->load->model('loginmodel','',TRUE);
	}
 
	function index()
	{
		$this->load->view('template/login_header.php');
		$this->load->view('login');
		$this->load->view('template/login_footer.php');
	}
 
	function loginvalidate()
	{
		$result = $this->loginmodel->login($_POST['username'],md5($_POST['password']));
		if($result)
		{
			$_SESSION["chheda_webadmin"] = $result;
			// $this->privilegeduser->getByUsername($_SESSION["chheda_webadmin"][0]->user_id);	
			// echo "<pre>";print_r($_SESSION);exit();
				
			echo json_encode(array("success"=>true, "msg"=>'You are successfully logged in.'));
			exit;		
		}
		else
		{
			echo json_encode(array("success"=>false, "msg"=>'Username or Password incorrect.'));
			exit;
		}
	}

	function forgotpassword()
	{
		if(!empty($_POST['email_id']))
		{
			$result = $this->loginmodel->forgotpass($_POST['email_id']);	
			if($result)
			{
				// $result_content = $this->loginmodel->getContentForgetPass(1);
				$result_content = $this->loginmodel->getEmailContent("ADMIN_FORGOT_PASSWORD");
				
				$url = base_url()."forgetchangepassword?text=".rtrim(strtr(base64_encode("eid=".$_POST['email_id']), '+/', '-_'), '=')."/".rtrim(strtr(base64_encode("uid=".$result[0]->user_id ), '+/', '-_'), '=')."/".rtrim(strtr(base64_encode("dt=".date("Y-m-d")), '+/', '-_'), '=');
				// echo $url; exit;
				
				$message = str_replace(array('{username}','{url}','{link}'), array($result[0]->user_name,$url,base_url()), $result_content['content']);
				
				$this->email->from(FROM_EMAIL); // change it to yours
				$this->email->to($_POST['email_id']);// change it to yours
				$this->email->subject($result_content['subject']);
				$this->email->message($message);		
				$checkemail = $this->email->send();
				
				if($checkemail)
				{
					echo json_encode(array("success"=>true, "msg"=>'Mail sent successfully, Please check your mail.'));
					exit;
				}
				else
				{
					echo json_encode(array("success"=>false, "msg"=>'Problem while sending mail..'));
					exit;
				}			
			}
			else
			{		
				echo json_encode(array("success"=>false, "msg"=>'Invalid Email ID.'));
				exit;
			}
		}
		else
		{		
			echo json_encode(array("success"=>false, "msg"=>'Invalid Email ID.'));
			exit;
		}	
	}
}

?>