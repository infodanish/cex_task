<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Productdetail extends CI_Controller {
	
	function _remap($method_name = 'index'){
		if(!method_exists($this, $method_name)){
			$this->index();
		}else{
			$this->{$method_name}();
		}
	}

	function __construct()
	{
		parent::__construct();
		//$this->load->library('email');
		$this->load->model('productdetailmodel','',TRUE);
	}
 
	function index()
	{
		//echo "here..";
		$id = $this->uri->segment(2);
		
		$getProductsDetails = $this->productdetailmodel->getSortedData("product_id, product_name, product_description, product_image, product_price","tbl_products","product_id='".$id."' ","product_name","asc");
		//echo "res: <pre>";print_r($getProductsDetails);exit;
		
		$result['productdetails'] = $getProductsDetails;
		
		$this->load->view('template/header.php');
		$this->load->view('index',$result);
		// $this->load->view('template/callout.php');
		$this->load->view('template/footer.php');
	}

 }

?>
