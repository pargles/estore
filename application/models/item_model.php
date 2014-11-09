<?php
class Item_model extends CI_Model {

	function getAll()
	{  
		$query = $this->db->get('order_items');
		return $query->result('Item');
	}  
	
	function insert($current_item) {
		return ($this->db->insert("order_items", array('order_id' =>$current_item->order_id,
													'product_id' =>$current_item->product_id,
												  'quantity' => $current_item->quantity)));
		
	}
	
	
}
?>
