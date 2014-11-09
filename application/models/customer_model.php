<?php
class Customer_model extends CI_Model {

	function getAll(){  
		$query = $this->db->get('customers');
		return $query->result('Customer');
	}  
	
	function get($id){
		$query = $this->db->get_where('customers',array('id' => $id));
		
		return $query->row(0,'Customer');
	}
	
	function delete($id) {
		return $this->db->delete("customers",array('id' => $id ));
	}
	
	function insert($customer) {
		return $this->db->insert("customers", array('first' => $custormer->first,
				                                  'last' => $custormer->last,
											      'login' => $custormer->login,
												  'password' => $custormer->password,
												  'email'=> $customer->email));
	}	
}
?>