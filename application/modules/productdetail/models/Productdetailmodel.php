<?PHP
class Productdetailmodel extends CI_Model
{
	function insertData($tbl_name,$data_array,$sendid = NULL){
		$this->db->insert($tbl_name,$data_array);
	 	$result_id = $this->db->insert_id();
	 	
	 	/*echo $result_id;
	 	exit;*/
	 	
	 	if($sendid == 1)
	 	{
	 		//return id
	 		return $result_id;
	 	}	
	}
	
	function getSortedData($select, $table, $condition = "", $sort_col = "", $sort_order = "")
	{	
		$this->db->select($select);
		$this->db->from($table);
		
		if(!empty($condition)){
			$this->db->where($condition);
		}
		
		if(!empty($sort_col) && !empty($sort_order)){
			$this->db->order_by($sort_col, $sort_order);
		}
		
		$query = $this->db->get();
		
		// echo "<br/>";
		// print_r($this->db->last_query());
		// exit;
	   
		if($query->num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	 

}
?>
