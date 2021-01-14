<?PHP
class Productlistingmodel extends CI_Model
{
	function insertData($tbl_name,$data_array,$sendid = NULL)
	 {
	 	/*echo $tbl_name."<br/>";
	 	print_r($data_array);
	 	echo $sendid;
	 	exit;*/
	 	
	 	/*$this->db->where('UserId', $did);
     	$this->db->delete('test_user_roles');*/

     	/*$this->db->where('UserId', $did);
     	$this->db->delete('test_customer_warehouse_details');*/ 
	 	
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

	 function getfeaturedproduct()
	 {
	 	$this->db->select('p.*,pi.imagename');
		$this->db->from('tbl_products as p');
		$this->db->join('tbl_productimages as pi', 'p.product_id  = pi.product_id', 'left');
    	$this->db->where("p.is_featured=1 and p.status='Active'");
    	$this->db->group_by("p.product_id");
    	$query = $this->db->get();
		if ($query->num_rows() >= 1) 
		{
			return $query->result();
		} 
		else 
		{
			return false;
		}	
    	
	 }
	 
	 function getdata($table,$condition =''){
        if(!empty($condition))
        {
        $sql = $this->db->query("Select * from $table where $condition");
        }else{
        $sql = $this->db->query("Select * from $table");
        }
      
        if($sql->num_rows()>0){
            return $sql->result_array();
        }else{
            return false;
        }
    }

    

	function getDropdown($tbl_name,$tble_flieds){
	   
	   $this -> db -> select($tble_flieds);
	   $this -> db -> from($tbl_name);
	
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
	
	function getDropdownSelval($tbl_name,$tbl_id,$tble_flieds,$rec_id=NULL){
		//echo "in condition...";
	   /*echo $tbl_name."<br/>";
	   echo $tbl_id."<br/>";
	   echo $tble_flieds."<br/>";
	   echo $rec_id."<br/>";*/
	   
	   
	   $this -> db -> select($tble_flieds);
	   $this -> db -> from($tbl_name);
	   $this -> db -> where($tbl_id, $rec_id);
	
	   $query = $this -> db -> get();
		
	   //print_r($query->result());
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
