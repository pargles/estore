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
	
	function getUser($login){
		//$query = $this->db->query('SELECT * FROM customers WHERE login ='."$login");
		$query = $this->db->get_where('customers',array('login' => $login));
		return $query->row(0,'Customer');
		//return $query->result('Customer');
	}
	
	function delete($id) {
		return $this->db->delete("customers",array('id' => $id ));
	}
	
	function insert($customer) {
		return $this->db->insert("customers", array('first' => $customer->first,
				                                  'last' => $customer->last,
											      'login' => $customer->login,
												  'password' => $customer->password,
												  'email'=> $customer->email));
	}	
}
?>