<?PHP
class Ordersmodel extends CI_Model
{
	function insertData($tbl_name,$data_array,$sendid = NULL)
	{
		$this->db->insert($tbl_name,$data_array);
	 	//print_r($this->db->last_query());
	    //exit;
		$result_id = $this->db->insert_id();
		
		if($sendid == 1)
	 	{
	 		return $result_id;
	 	}
	}
	
	public function getTblRecords($tbl_name, $fields, $condition){
    	$this -> db -> select($fields);
		$this -> db -> from($tbl_name);
        $this -> db -> where("($condition)");
		$query = $this -> db -> get();
		//print_r($this->db->last_query());
		//exit;
    	return $query->result();
    }
	
	
	function getProductImages($product_id){
	   
		$this -> db -> select('*');
		$this -> db -> from('tbl_productimages as p');
		$this -> db -> where('p.product_id', $product_id);
		$this -> db -> order_by('default', 'asc');
		$query = $this -> db -> get();
	   
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	 
	function getRecords($get){
		//echo "here...<br/>";
		//print_r($get);
		
		$table = "tbl_orders";
		$table_id = 'order_id';
		$default_sort_column = 'order_id';
		$default_sort_order = 'desc';
		
		$condition="1=1";
		
		$colArray = array('u.full_name','i.email_id','i.mobile','i.invoice','i.netpayment','i.status');
		
		$sortArray = array('u.full_name','i.email_id','i.mobile','i.invoice','i.netpayment','i.cod_status');
		
		$page = $get['iDisplayStart'];											// iDisplayStart starting offset of limit funciton
		$rows = $get['iDisplayLength'];											// iDisplayLength no of records from the offset
		
		// sort order by column
		$sort = isset($get['iSortCol_0']) ? strval($sortArray[$get['iSortCol_0']]) : $default_sort_column;  
		$order = isset($get['sSortDir_0']) ? strval($get['sSortDir_0']) : $default_sort_order;

		for($i=0;$i<4;$i++)
		{
			if($i == 2 || $i == 3)
			{
				if(isset($get['sSearch_'.$i]) && $get['sSearch_'.$i]!='')
				{
					$condition .= " AND $colArray[$i] = '".$get['sSearch_'.$i]."'";
				}
			}
			else
			{
				if(isset($get['sSearch_'.$i]) && $get['sSearch_'.$i]!='')
				{
					$condition .= " AND $colArray[$i] like '%".$_GET['sSearch_'.$i]."%'";
				}
			}
		}
		
		//echo "Condition: ".$condition;
		//exit;
		$this -> db -> select('i.*, u.full_name, u.email_id, u.phone_no');
		$this -> db -> from('tbl_orders as i');
		$this -> db -> join('tbl_users as u', 'i.user_id  = u.user_id', 'left');
		$this -> db -> join('tbl_cart as s', 'i.order_id  = s.order_id', 'left');
		$this->db->where("($condition)");
		$this->db->group_by('i.order_id');
		$this->db->order_by($sort, $order);
		$this->db->limit($rows,$page);
		
		$query = $this -> db -> get();
		
		//print_r($this->db->last_query());
		//exit;
		
		$this -> db -> select('i.*, u.full_name, u.email_id, u.phone_no');
		$this -> db -> from('tbl_orders as i');
		$this -> db -> join('tbl_users as u', 'i.user_id  = u.user_id', 'left');
		$this -> db -> join('tbl_cart as s', 'i.order_id  = s.order_id', 'left');
		$this->db->where("($condition)");
		$this->db->group_by('i.order_id');
		$this->db->order_by($sort, $order);
		
		$query1 = $this -> db -> get();
		//echo "total: ".$query1 -> num_rows();
		//exit;
		
		if($query -> num_rows() >= 1)
		{
			$totcount = $query1 -> num_rows();
			return array("query_result" => $query->result(),"totalRecords"=>$totcount);
		}
		else
		{
			return array("totalRecords"=>0);
		}
		
		
		//exit;
	}
	
	function getFormdata($ID){
		// $this -> db -> select('s.*, p.product_code, p.link, p.product_name, p.short_description, p.product_base_price, p.product_tax_amount, p.tax_percentage, p.product_final_price, p.stock_status, i.product_thumbnail_image as imagename, c.color_name');
		$this -> db -> select('o.*,s.*,pv.product_sizetype,pv.product_type_size_weight_quantity_id,c.category_name');
		$this -> db -> from('tbl_orders as o');
		$this -> db -> join('tbl_order_details as s','s.order_id=o.order_id');
		$this->db->join("tbl_product_type_size_weight_quantity as pv","pv.product_id = s.item_id AND pv.product_type_size_weight_quantity_id = s.product_variant_id","left");
		$this->db->join("tbl_categories as c","c.category_id = s.category_id","left");
		
    	
		
		
		$this -> db -> where('o.order_id',$ID);
		// $this -> db -> order_by('i.default', "DESC");
		$query = $this -> db -> get();
		
		 // echo $this->db->last_query();
		 // exit;
		
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	function getOrderdetails($ID){
		
		$condition = " i.order_id='".$ID."' ";
		$this -> db -> select('i.*');
		$this -> db -> from('tbl_orders as i');
		$this->db->where("($condition)");
	
		$query = $this -> db -> get();
	   
		//print_r($this->db->last_query());
		//exit;
	   
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
		
	}
	
	function getdata($table,$condition = '1=1'){
        $sql = $this->db->query("Select * from $table where $condition");
        if($sql->num_rows()>0){
            return $sql->result_array();
        }else{
            return false;
        }
    }
	
	
	function updateRecord($tableName, $data, $column, $value){
		$this->db->where($column, $value);
		// print_r($this->db->last_query());
		// exit;
		if ($this->db->update($tableName, $data)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	} 
	
	function getCartProductColors($condition){
		
		$this -> db -> select('i.productsize');
		$this -> db -> from('tbl_product_colors as i');		
		$this -> db -> where("($condition)");
		$this -> db -> group_by('i.	product_color_id');
		
		$query = $this -> db -> get();
		
		//print_r($this->db->last_query());
		//exit;
		
		if($query -> num_rows() >= 1){
			return $query->result();
		}else{
			return false;
		}
		//exit;
	}
	
	
	
	function getCartProductDetails($condition){
		$this -> db -> select('i.*, pi.imagename, pi.product_thumbnail_image');
		$this -> db -> from('tbl_products as i');
		$this -> db -> join('tbl_productimages as pi', 'i.product_id  = pi.product_id', 'left');
		$this->db->where("($condition)");
		$this -> db -> group_by('i.product_id');
			
		$query = $this -> db -> get();
		
		//print_r($this->db->last_query());
		//exit;
		
		if($query -> num_rows() >= 1){
			return $query->result();
		}else{
			return false;
		}
		//exit;
	}
	
	
	// function getMailDetails($eid) 
	function getEmailContent($mail_key) 
	{
		if(!empty($mail_key) && $mail_key != "")
		{
			$this->db->select('fromemail,toemail,ccemail,subject,content');
			$this->db->from('tbl_emailcontents as e');
			// $this->db->where('eid', $eid);
			$this->db->where('mail_Key', $mail_key);
			$query = $this->db->get();
			if($query->num_rows() >= 1) 
			{
				return $query->result_array();
			} 
			else 
			{
				return false;
			}
		}
		else 
		{
			return false;
		}
	}
	function enum_select($table, $field){
		$query = " SHOW COLUMNS FROM `$table` LIKE '$field' ";
		$row = $this->db->query(" SHOW COLUMNS FROM `$table` LIKE '$field' ")->row()->Type;
		$regex = "/'(.*?)'/";
		preg_match_all( $regex , $row, $enum_array );
		$enum_fields = $enum_array[1];
		return( $enum_fields );
	}
}
?>
