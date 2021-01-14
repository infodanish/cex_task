<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Productlisting extends CI_Controller {
	
	function _remap($method_name = 'index'){
		if(!method_exists($this, $method_name)){
				$this->index();
			}else{
				$this->{$method_name}();
			}
	}

	function __construct()
	{
		//echo "here..";exit;
		parent::__construct();
		$this->load->model('productlistingmodel','',TRUE);
		$this->load->model('productdetail/productdetailmodel','',TRUE);

	}
 
	function index()
	{
		$this->load->view('template/header.php');
		$this->load->view('index');
		$this->load->view('template/footer.php');
	}
	
	function getRecords(){
		$html = '';
		$getProducts = $this->productlistingmodel->getSortedData("product_id, product_name, product_description, product_image, product_price","tbl_products","status='Active' ","product_name","asc");
		
		//echo "res: ";print_r($getProducts);exit;
		if(!empty($getProducts)){
			
			for($i=0; $i < sizeof($getProducts); $i++){
				//echo $getProducts[$i]['image'];exit;
				$prod_img = FRONT_URL."images/product_images/".$getProducts[$i]->product_image;
				
				$html .='<div class="col-xl-2 col-md-6 col-6 ">
						<div class="product-box">
							<div class="img-wrapper">
								<div class="front">';
									$html .='<a href="'.base_url().'productdetail/'.$getProducts[$i]->product_id.'">
									<img src="'.$prod_img.'" style="width:160px;height:150px;" class="img-fluid blur-up lazyload bg-img" alt=""></a>';
									
								$html .='</div>
								<div class="cart-info cart-wrap"></div>
							</div>
							<div class="product-detail">
								<div>
									<a href="'.base_url().'productdetail/'.$getProducts[$i]->product_id.'">
										<h6>'.$getProducts[$i]->product_name.'</h6>
									</a>
									<p>'.substr($getProducts[$i]->product_description,0,20).'...</p>
									<h4>&#8377; '.$getProducts[$i]->product_price.'</h4>									
								</div>
							</div>
						</div>
					</div>';
				
			}
			
			//echo $html;exit;
			
			echo json_encode(array('msg'=>'success','htmldata'=>$html));
			exit;
		}else{
			echo json_encode(array('msg'=>'error','htmldata'=>'No Products Found'));
			exit;
		}		
	}
}

?>
