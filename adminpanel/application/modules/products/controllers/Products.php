<?php	if (!defined('BASEPATH')) exit('No direct script access allowed');
// session_start(); //we need to call PHP's session object to access it through CI
class Products extends CI_Controller 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->model('productsmodel', '', TRUE);
		checklogin();
	}
	
	function index() 
	{
		$this->load->view('template/header.php');
		$this->load->view('index');
		$this->load->view('template/footer.php');
	}
	
	function addEdit($id = NULL) 
	{
		$record_id = "";
		// print_r($_GET);
		if (!empty($_GET['text']) && isset($_GET['text'])) 
		{
			$varr = base64_decode(strtr($_GET['text'], '-_', '+/'));
			parse_str($varr, $url_prams);
			$record_id = $url_prams['id'];
		}
		// echo $record_id;
		$result = array();
		// $result['details'] = $this->productsmodel->getFormdata($record_id);
		
		if (!empty($record_id)) 
		{
			$result['product_details'] = $this->productsmodel->getDropdown("tbl_products", "*", " product_id = '".$record_id."'  ");
			
		
		}
		
		// $result['users1'] = $this->productsmodel->getDropDownMarkupCat($markup_data);
		$result['categories'] = $this->productsmodel->getDropdown("tbl_categories", "category_id, category_name", "status = 'Active' ", "category_name", "asc");
		
		// echo "<pre>";
		// print_r($result);
		// exit;
		
		$this->load->view('template/header.php');
		$this->load->view('products/addEdit', $result);
		$this->load->view('template/footer.php');
	}

 
	
	function fetch() 
	{
		$get_result = $this->productsmodel->getRecords($_GET);
		$result = array();
		$result["sEcho"] = $_GET['sEcho'];
		$result["iTotalRecords"] = $get_result['totalRecords']; //iTotalRecords get no of total records
		$result["iTotalDisplayRecords"] = $get_result['totalRecords']; //iTotalDisplayRecords for display the no of records in data table.
		$items = array();
		
		if(!empty($get_result['query_result']) && count($get_result['query_result']) > 0)
		{
			for ($i = 0; $i < sizeof($get_result['query_result']); $i++) 
			{
				$temp = array();
				
				array_push($temp, $get_result['query_result'][$i]->category_name);
				array_push($temp, $get_result['query_result'][$i]->product_name);
				
				$actionCol1 = "";
				$actionCol1 .= '<a href="products/view?text=' . rtrim(strtr(base64_encode("id=" . $get_result['query_result'][$i]->product_id), '+/', '-_'), '=') . '" title="View">View</a>';
				
					$actionCol = "";
					$actionCol .= '<a href="products/addEdit?text=' . rtrim(strtr(base64_encode("id=" . $get_result['query_result'][$i]->product_id), '+/', '-_'), '=') . '" title="Edit"><i class="fa fa-edit"></i></a>';
				
				
				array_push($temp, $actionCol);
				array_push($items, $temp);
			}	
		}	
		$result["aaData"] = $items;
		echo json_encode($result);
		exit;
	}
   
	function submitForm(){
	// 	echo "<pre>"; 
		// print_r($_POST); 
	// 	// exit;
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			/* check for empty records */
			if (empty($_POST['category_id'])) {
				echo json_encode(array('success' => false, 'msg' => 'Please select category.'));
				exit;
			}
			
			if (empty($_POST['product_name'])){
				echo json_encode(array('success' => false, 'msg' => 'Please enter product name.'));
				exit;
			}
			
			/* Check for duplicate records */
			$concat_product_name = trim($_POST['product_name']);
			$condition = '';
			if(!empty($_POST['product_id'])){
				$condition = ' AND product_id <> '.$_POST['product_id'];
			}
			
			$product_name_check = $this->productsmodel->getdata("tbl_products","product_name = '".$concat_product_name."' $condition", "product_name");
			
			if(is_array($product_name_check))
			{
				echo json_encode(array('success' => false, 'msg' => 'Product already exist.'));
				exit;
			}
			
			//echo DOC_ROOT_FRONT;exit;
			
			$data_array = array();
			$data_array['category_id']         = $_POST['category_id'];
			$data_array['product_name']        = trim($_POST['product_name']);
			$data_array['product_description'] = htmlentities($_POST['product_description']);
			$data_array['product_price']         = $_POST['product_price'];
			
			$data_array['updated_on']          = date("Y-m-d H:i:s");
			$data_array['updated_by']          = $_SESSION["chheda_webadmin"][0]->user_id;
			
			$thumnail_value = "";
			if(isset($_FILES) && isset($_FILES["product_image"]["name"]))
			{
				 $config = array();
				$config['upload_path'] = DOC_ROOT_FRONT."/images/product_images/";
				$config['max_size']    = '0';
				//$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['allowed_types'] = '*';
				$config['file_name']     = md5(uniqid("100_ID", true));
				//$config['file_name']     = $_FILES["product_image"]["name"];
				
				// print_r($config);
				// exit;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload("product_image"))
				{
					$image_error = array('error' => $this->upload->display_errors());
					echo json_encode(array("success"=>false, "msg"=>$image_error['error']));
					exit;
				}
				else
				{
					$image_data = array('upload_data' => $this->upload->data());
					$thumnail_value = $image_data['upload_data']['file_name'];
					 
					// print_r($config);
					// exit;

					

				}
				
			}
			else
			{
				$thumnail_value = $_POST['input_product_image'];
			}
			
			$data_array['product_image'] = $thumnail_value;
			
			$product_id = "";

			if (!empty($_POST['product_id'])) {
				$product_id = $_POST['product_id'];
				$result = $this->productsmodel->updateRecord('tbl_products', $data_array, 'product_id = "'.$product_id.'"');
			}else{
				$data_array['created_on']          = date("Y-m-d H:i:s");
				$data_array['created_by']          = $_SESSION["chheda_webadmin"][0]->user_id;
				$result   = $this->productsmodel->insertData('tbl_products', $data_array, '1');
				
			}
			

			if($result){
				echo json_encode(array('success' => true, 'msg' => 'Product  add successfully '));
				exit;
			}else{
				echo json_encode(array('success' => false, 'msg' => 'Problem while data add/update.'));
				exit;
			}
		}else{
			echo json_encode(array('success' => false, 'msg' => 'Problem while data add/update.'));
			exit;
		}
	}

	function dublicate()
	{
		$sku = $_REQUEST['sku'];
		$prod_id = $_REQUEST['prod_id'];
		$condition = "product_code = '".$sku."'";
		if($prod_id > 0 && $prod_id != "")
		{
			$condition .= ' AND product_id != '.$prod_id;
		}
		$result = $this->productsmodel->getdata("tbl_products", $condition);
		if(is_array($result) && count($result) > 0)
		{
			echo json_encode(array("success"=>true));
		}
		else
		{
			echo json_encode(array("success"=>false));
		}
	}
	
	
	private function set_upload_options()
	{   
		$config = array();
		$config['upload_path'] = DOC_ROOT_FRONT ."/images/products_images";
		// $config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['allowed_types'] = '*';
		$config['max_size']      = '10000000';
		$config['overwrite']     = FALSE;
		
		/* echo "<pre>";
		print_r($config);
		exit;  */
		
		return $config;
	} 
	private function set_upload_options_thumbnails()
	{   
		$config = array();
		$config['upload_path'] = DOC_ROOT_FRONT ."/images/thumbnails";
		// $config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['allowed_types'] = '*';
		$config['max_size']      = '10000000';
		$config['overwrite']     = FALSE;
		
		/* echo "<pre>";
		print_r($config);
		exit;  */
		
		return $config;
	} 
	
	
}
?>
