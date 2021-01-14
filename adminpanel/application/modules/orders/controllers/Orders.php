<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// session_start(); //we need to call PHP's session object to access it through CI
class Orders extends CI_Controller

{
	function __construct()
	{
		parent::__construct();

		// $this->load->helper('erp_setting');
		checklogin();
		$this->load->model('ordersmodel', '', TRUE);
	}

	function index()
	{
		$result = "";
		$this->load->view('template/header.php');
		$this->load->view('orders/index',$result);
		$this->load->view('template/footer.php');
		
	}

	/*new code*/
	function view($id = NULL){
	
		$record_id = "";
		if (!empty($_GET['text']) && isset($_GET['text'])) {
			$varr = base64_decode(strtr($_GET['text'], '-_', '+/'));
			parse_str($varr, $url_prams);
			$record_id = $url_prams['id'];
		}
		
		//echo "record_id: ".$record_id;exit;
		$result = "";
		// $result['product_status'] = $this->ordersmodel->enum_select("tbl_shoppingcarts","product_status");
		$result['order_status'] = $this->ordersmodel->enum_select("tbl_orders","order_status");
		$result['cartdetail'] = json_decode(json_encode($this->ordersmodel->getFormdata($record_id)), TRUE);
		
// 		echo "<pre>";
// 		print_r($result);
// 		exit;
		$this->load->view('template/header.php');
		$this->load->view('orders/view', $result);
		$this->load->view('template/footer.php');

	}

	/*new code end*/
	
	function fetch()
	{
		$get_result = $this->ordersmodel->getRecords($_GET);
		//echo "<pre>";print_r($get_result);exit();
		
		$result = array();
		$result["sEcho"] = $_GET['sEcho'];
		$result["iTotalRecords"] = $get_result['totalRecords']; //	iTotalRecords get no of total recors
		$result["iTotalDisplayRecords"] = $get_result['totalRecords']; //  iTotalDisplayRecords for display the no of records in data table.
		$items = array();
		
		$order_condition = "";
		$shipping_charges = 0;
		$codamt = 0;
		$netpayment = 0;
		$discount_amt = 0;
		$redeem_amt = 0;
		// $are_amt = 0;
		
		if(!empty($get_result['query_result']) && count($get_result['query_result']) > 0)
		{
			for ($i = 0; $i < sizeof($get_result['query_result']); $i++) 
			{
				$temp = array();
				array_push($temp, $get_result['query_result'][$i]->full_name);
				array_push($temp, $get_result['query_result'][$i]->email_id);
				array_push($temp, $get_result['query_result'][$i]->mobile);			
				array_push($temp, $get_result['query_result'][$i]->invoice);
				array_push($temp, $get_result['query_result'][$i]->netpayment);
				array_push($temp, $get_result['query_result'][$i]->status);
				array_push($temp, $get_result['query_result'][$i]->created_on);
				
				array_push($items, $temp);
			}
		}

		$result["aaData"] = $items;
		echo json_encode($result);
		exit;
	}
	
	function delRecord()
	{
		
		$id=$_POST['id'];
		$status=$_POST['status'];
		
		$appdResult = $this->ordersmodel->delrecord("tbl_users","user_id",$id,$status);
		if($appdResult)
		{
			echo "1";
		}
		else
		{
			echo "2";	
		}	
	}
	
	
}

?>
