<?php
class Item_model extends CI_Model {
	//SELECT * FROM `order_items` INNER JOIN `products` ON order_items.`product_id`=products.`id` WHERE `order_id`=68
	function getAll($orderId)
	{  
		$query = $this->db->query('SELECT * FROM order_items INNER JOIN products ON order_items.product_id=products.id WHERE order_id='.$orderId.'');
		return $query->result('Item');
	}  
	
	function insert($current_item) {
		return ($this->db->insert("order_items", array('order_id' =>$current_item->order_id,
													'product_id' =>$current_item->product_id,
												  'quantity' => $current_item->quantity)));
		
	}
	
	
}
?>
