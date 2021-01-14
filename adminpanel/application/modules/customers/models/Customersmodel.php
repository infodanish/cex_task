<?PHP
class Customersmodel extends CI_Model
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
	 
	function getRecords($get)
	{	
		$table = "tbl_users";
		$table_id = 'i.user_id';
		$default_sort_column = 'i.user_id';
		$default_sort_order = 'desc';
		
		$condition = "1=1";
		
		$colArray = array('i.first_name','i.last_name','i.email_id','i.phone_no','i.status');
		$searchArray = array('i.first_name','i.last_name','i.email_id','i.phone_no');
				
		
		$page = $get['iDisplayStart'];											// iDisplayStart starting offset of limit funciton
		$rows = $get['iDisplayLength'];											// iDisplayLength no of records from the offset
		
		// sort order by column
		$sort = isset($get['iSortCol_0']) ? strval($colArray[$get['iSortCol_0']]) : $default_sort_column;  
		$order = isset($get['sSortDir_0']) ? strval($get['sSortDir_0']) : $default_sort_order;

		for($i=0;$i<4;$i++)
		{
			
			if(isset($get['sSearch_'.$i]) && $get['sSearch_'.$i]!='')
			{
				$condition .= " && $searchArray[$i] like '%".$_GET['sSearch_'.$i]."%'";
			}
			
		}
		
		//echo "condition ".$condition;exit;
		
		$this -> db -> select('i.*');
		$this -> db -> from('tbl_users as i');
		$this->db->where("($condition)");
		$this->db->order_by($sort, $order);
		$this->db->limit($rows,$page);		
		$query = $this -> db -> get();
		
		$this -> db -> select('i.*');
		$this -> db -> from('tbl_users as i');
		$this->db->where("($condition)");
		$this->db->order_by($sort, $order);		
		$query1 = $this -> db -> get();
		
		if($query -> num_rows() >= 1)
		{
			$totcount = $query1 -> num_rows();
			return array("query_result" => $query->result(),"totalRecords"=>$totcount);
		}
		else
		{
			return false;
		}
		
		
		//exit;
	}
	
	function getFormdata($ID)
	{
		$condition = "i.user_id='".$ID."' ";
		$this -> db -> select('i.*');
		$this -> db -> from('tbl_users as i');
		//$this -> db -> join('tbl_categorygroup as cg', 'i.categorygroup_id  = cg.categorygroup_id', 'left');
		$this->db->where("($condition)");
	
		$query = $this -> db -> get();
	   
		// print_r($this->db->last_query());
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

	function updateRecord($tableName, $data, $column, $value)
	{
		$this->db->where("$column", $value);
		$this->db->update($tableName, $data);
		//print_r($this->db->last_query());
		//exit;
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else {
			return true;
		}
	} 
	 
	function delrecord($tbl_name,$tbl_id,$record_id,$status)
	{
		$data = array('status' => $status);
		 
		$this->db->where($tbl_id, $record_id);
		$this->db->update($tbl_name,$data); 
		 
		if($this->db->affected_rows() >= 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getExportRecords($get)
	{
		$table = "tbl_users";
		$table_id = 'i.user_id';
		$default_sort_column = 'i.user_id';
		$default_sort_order = 'desc';
		
		$condition = "1=1";
		
		$colArray = array('i.first_name','i.last_name','i.email_id','i.phone_no');
		$searchArray = array('i.first_name','i.last_name','i.email_id','i.phone_no');
			

		for($i=0;$i<4;$i++)
		{
			if(isset($get['sSearch_'.$i]) && $get['sSearch_'.$i]!='')
			{
				$condition .= " && $searchArray[$i] like '%".$_GET['sSearch_'.$i]."%'";
			}
		}
		$this -> db -> select('i.*');
		$this -> db -> from('tbl_users as i');
		$this->db->where("($condition)");
		$query = $this -> db -> get();
		
		if($query -> num_rows() >= 1)
		{
			return array("query_result" => $query->result());
		}
		else
		{
			return false;
		}
	}
	
	function dataExist($table,$data){
		$this -> db -> select("*");
		$this -> db -> from($table);
		$this -> db -> where("email_id", $data);
		$query = $this -> db -> get();
		if($query -> num_rows() >= 1){
			return $query ->result()[0]->user_id;
		}else{
			return false;
		}
	}
	
	function getData($table, $select, $condition = "1=1")
	{
		$this -> db -> select($select);
		$this -> db -> from($table);
		$this -> db -> where($condition);
		$query = $this -> db -> get();
		if($query -> num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
}
?>
