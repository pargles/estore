<?php

class Store extends CI_Controller {
     
     
    function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();
	    	
	    	
	    	$config['upload_path'] = './images/product/';
	    	$config['allowed_types'] = 'gif|jpg|png';
/*	    	$config['max_size'] = '100';
	    	$config['max_width'] = '1024';
	    	$config['max_height'] = '768';
*/
	    		    	
	    	$this->load->library('upload', $config);
	    	//include 'models/item.php';
	    	session_start();
	    	
    }

    function index() {
    		$this->loadMainPage();
    }
    
    function loadAdministratorPage(){
    	$this->load->view('adminFirstPage.php');
    }
    
    function loadMainPage(){
    	$this->load->model('product_model');
    	$products = $this->product_model->getAll();
    	$data['products']=$products;
    	$this->load->view('main_page/main.php',$data);
    }
    
    function loadProductAdmin(){
    	$this->load->model('product_model');
    	$products = $this->product_model->getAll();
    	$data['products']=$products;
    	$this->load->view('product/list.php',$data);
    }
    
    function loadCustomerAdmin(){
    	$this->load->model('customer_model');
    	$customers = $this->customer_model->getAll();
    	$data['customers']=$customers;
    	$this->load->view('customer/list.php',$data);
    }
    
    function loadOrderAdmin(){
    	$this->load->model('order_model');
    	$orders = $this->order_model->getAll();
    	$data['orders']=$orders;
    	$this->load->view('order/list.php',$data);
    }
    
    function newForm() {
	    	$this->load->view('product/newForm.php');
    }
    
    function buyItem($id){
    	//$this->loadCart();
    	//Also we are going to need the dog model
    	$this->load->model('product_model');
    	$product = $this->product_model->get($id);    	
    	$this->load->model('item');
    	$item = new Item();
    	$item->product_id = $product->id;
    	$item->name = $product->name;
    	$item->photo_url = $product->photo_url;
    	$item->price = $product->price;
    	$item->quantity = 1;
    	$isInTheCart = false; 
    	if (isset($_SESSION["items"])==false){
    		$_SESSION["items"] = array();
    	}else{
    		foreach($_SESSION['items'] as $k => $v) {
    			if($v->product_id == $product->id )
    				$isInTheCart=true;
    		}
    	}
    	if(!$isInTheCart)
    		$_SESSION["items"][] = $item;
    	 
    	//Then we redirect to the index page again
    	redirect('store/loadCart', 'refresh');
    }
    
    function loadCart(){
    	//$this->load->view('cart/myCart.php');
    	if (isset($_SESSION["items"])) {
    		$somedata['automaticitemsvariable']= $_SESSION["items"];
    		//$somedata['msg']= "hello world";
    		$this->load->view('cart/myCart',$somedata);
    	}
    	else{
    		$this->load->view('cart/myCart',array());
    	}
    }
    
    function cleanCart(){
    	if (isset($_SESSION['items'])) {
    		unset($_SESSION['items']);
    		redirect('store/loadCart', 'refresh');
    	}
    }
    
    function deleteItemFromSession($product_id){
    	foreach($_SESSION['items'] as $k => $v) {
    		if($v->product_id == $product_id)
    			unset($_SESSION['items'][$k]);
    	}
    	redirect('store/loadCart', 'refresh');
    }
    
    function increaseProductQuantity($product_id){
    	foreach($_SESSION['items'] as $k => $v) {
    		if($v->product_id == $product_id)
    			$v->quantity = $v->quantity+1;
    	}
    	redirect('store/loadCart', 'refresh');
    }
    function decreaseProductQuantity($product_id){
    	foreach($_SESSION['items'] as $k => $v) {
    		if($v->product_id == $product_id && $v->quantity > 1 )
    			$v->quantity = $v->quantity-1;
    	}
    	redirect('store/loadCart', 'refresh');
    }
    
    function checkout(){
    	$this->load->view('payment/form.php');
    }
    
    function checkCreditCard() {
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('creditcard_number','Credit Card Number','required');
    	$this->form_validation->set_rules('creditcard_month','Credit Card Month','required');
    	$this->form_validation->set_rules('creditcard_year','Credit Card Year','required');
    
    	if ($this->form_validation->run() == true) {
    		$this->load->model('order_model');
    
    		$order = new Order();
    		$order->order_date = date('Y-m-d');
    		$order->order_time = date('H:i:s');
    		$order->customer_id = 1;
    		$order->total = 150;
    		$order->creditcard_number = $this->input->get_post('creditcard_number');
    		$order->creditcard_month = $this->input->get_post('creditcard_month');
    		$order->creditcard_month = $this->input->get_post('creditcard_year');  
    		  			
    		$this->order_model->insert($order);
    		redirect('store/concluded', 'refresh');
    	}
    	else {    			
    		$this->load->view('payment/form.php');
    	}
    }
    
    function concluded(){
    	$this->load->view('payment/thanks.php');
    	//send email here
    }
    
    function printReceipt(){
    	
    }
    
	function create() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|is_unique[products.name]');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		$fileUploadSuccess = $this->upload->do_upload();
		
		if ($this->form_validation->run() == true && $fileUploadSuccess) {
			$this->load->model('product_model');

			$product = new Product();
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$data = $this->upload->data();
			$product->photo_url = $data['file_name'];
			
			$this->product_model->insert($product);

			//Then we redirect to the index page again
			redirect('store/index', 'refresh');
		}
		else {
			if ( !$fileUploadSuccess) {
				$data['fileerror'] = $this->upload->display_errors();
				$this->load->view('product/newForm.php',$data);
				return;
			}
			
			$this->load->view('product/newForm.php');
		}	
	}
	
	function read($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/read.php',$data);
	}
	
	function editForm($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/editForm.php',$data);
	}
	
	function update($id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		if ($this->form_validation->run() == true) {
			$product = new Product();
			$product->id = $id;
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$this->load->model('product_model');
			$this->product_model->update($product);
			//Then we redirect to the index page again
			redirect('store/index', 'refresh');
		}
		else {
			$product = new Product();
			$product->id = $id;
			$product->name = set_value('name');
			$product->description = set_value('description');
			$product->price = set_value('price');
			$data['product']=$product;
			$this->load->view('product/editForm.php',$data);
		}
	}
    	
	function delete($id) {
		$this->load->model('product_model');
		
		if (isset($id)) 
			$this->product_model->delete($id);
		
		//Then we redirect to the index page again
		redirect('store/index', 'refresh');
	}
	
	function deleteCustomer($id) {
		$this->load->model('customer_model');
	
		if (isset($id))
			$this->customer_model->delete($id);
	
		//Then we redirect to the index page again
		redirect('store/index', 'refresh');
	}
      
   
    
    
    
}

