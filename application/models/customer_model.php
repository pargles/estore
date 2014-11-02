<?php
class Customer_model extends CI_Model {

	function getAll()
	{  
		$query = $this->db->get('customers');
		return $query->result('Customer');
	}  
	
	function delete($id) {
		return $this->db->delete("customers",array('id' => $id ));
	}
	
	function insert($product) {
		return $this->db->insert("customers", array('first' => $custormer->first,
				                                  'last' => $custormer->last,
											      'login' => $custormer->login,
												  'password' => $custormer->password,
												  'email'=> $customer->email));
	}	
}
?>
