<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		checklogin();
		$this->load->model('homemodel','',TRUE);
	}
 
	function index()
	{                     			              
		$this->load->view('template/header.php');
		$this->load->view('home/index');
		$this->load->view('template/footer.php');	
	}
 
	function logout()
	{

		if(!empty($_SESSION['chheda_webadmin'])){
	        unset($_SESSION['chheda_webadmin']);
	    }
	   // session_destroy();
	    redirect("login");
		// $this->session->unset_userdata('chheda_webadmin');
		// session_destroy();
		
		// echo "<pre>";
		// print_r($_SESSION);
		// print_r($this->session->all_userdata());
		// exit;
		
		// redirect('login', 'refresh');
	}
}

?>