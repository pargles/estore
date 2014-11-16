<?php
date_default_timezone_set('America/New_York');
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
	    	$this->load->helper('file');
	    	$this->load->library('upload', $config);
	    	$config['protocol']='smtp';
	    	$config['smtp_host']='ssl://smtp.googlemail.com';
	    	$config['smtp_port']=465;
	    	$config['smtp_user']='md5destroyer@gmail.com';
	    	$config['smtp_pass']='achoqueabarradeespacoquebrou';
	    	$config['mailtype']='html';
	    	$config['charset']='iso-8859-1';
	    	$this->load->library('email', $config);
	    	$this->load->helper('file');
	    	$this->email->set_newline("\r\n");
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
    	if (isset($_SESSION["client"])) {
    		$data['clientVariable']= $_SESSION["client"];;
    	}else{
    		$data['clientVariable']= false;
    	}
    	$this->load->view('main_page/main.php',$data);
    }
    
    function loadProductAdmin(){
    	$this->load->model('product_model');
    	$products = $this->product_model->getAll();
    	$data['products']=$products;
    	$this->load->view('product/list.php',$data);
    }
    
   	function createLoginForm(){
   		$data['back2cart'] = false;
    	$this->load->view('login/newForm.php',$data);
    }
    
    function sigIn(){
   		 if (isset($_SESSION["client"])){
			unset($_SESSION['client']);
			if (isset($_SESSION["items"])){
				unset($_SESSION['items']);
			}
		}	
    	
    	$this->load->library('form_validation');
		
    	$this->form_validation->set_rules('first','First','required');
		$this->form_validation->set_rules('last','Last','required');
		$this->form_validation->set_rules('login','Login','required|is_unique[customers.login]');
		$this->form_validation->set_rules('password','Password','required|min_length[6]||matches[repeat_password]|callback_length_password_check');
		$this->form_validation->set_rules('repeat_password','Repeat_Password','required');
		$this->form_validation->set_rules('email','Email','required |valid_email');
		
		if ($this->form_validation->run() == true) {
			$this->load->model('customer_model');
			$currentClient = new Customer();
			$currentClient->first = $this->input->get_post('first');
			$currentClient->last = $this->input->get_post('last');
			$currentClient->login = $this->input->get_post('login');
			$currentClient->password = $this->input->get_post('password');
			$currentClient->email = $this->input->get_post('email');
		
			$this->customer_model->insert($currentClient);
			if (isset($_SESSION["client"])==false){
				$_SESSION["client"] = $currentClient;
			}
			//Then we redirect to the index page again
			//redirect('store/index', 'refresh');
			redirect('store/index', 'refresh');
			
		}
		else {
			redirect('store/createLoginForm', 'refresh');
		}
			
	}
	
	public function length_password_check($length_password) {
    	if (strlen($length_password) < 6 ){
    		$this->form_validation->set_message('length_password_check', 'Your password must have at least 6 characters long');
    		return false;
    	}
    	return true;
	}
	
	function logIn(){
		if (isset($_SESSION["client"])){
			unset($_SESSION['client']);
			if (isset($_SESSION["items"])){
				unset($_SESSION['items']);
			}
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login','Login','required');
		$this->form_validation->set_rules('password','Password','required');
		if ($this->form_validation->run() == true) {
			$this->load->model('customer_model');
			$currentClient = new Customer();
			$log =  $this->input->get_post('login');
			$pass = $this->input->get_post('password');
			$currentClient = $this->customer_model->getUser($log);
			if($currentClient){
				if($currentClient->password == $pass){
					if (isset($_SESSION["client"])==false){
						$_SESSION["client"] = $currentClient;
					}
					if($log == "admin"){
						redirect('store/loadAdministratorPage', 'refresh');
					}
					elseif ($this->input->get_post('backToTheCart')){
						redirect('store/checkout', 'refresh');
					}
					else{
						redirect('store/index', 'refresh');
					}
				}else{
					echo '<script>';
					echo 'alert("wrong password")';
					echo '</script>';
					redirect('store/createLoginForm', 'refresh');
				}
			}else{
				echo '<script>';
				echo 'alert("this user does not exist")';
				echo '</script>';
				redirect('store/createLoginForm', 'refresh');
			}
	
			//redirect('store/loadCustomerAdmin', 'refresh');
		}
		else {
			redirect('store/createLoginForm', 'refresh');
		}
	}
	
	function logOut(){
		if (isset($_SESSION['client'])) {
			unset($_SESSION['client']);
		}
		if (isset($_SESSION['items'])) {
			unset($_SESSION['items']);
		}
		redirect('store/index', 'refresh');
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
    	if(isset($_SESSION["items"])==false){
    		echo '<script>';
    		echo 'alert("your session has expired")';
    		echo '</script>';
    		redirect ( 'store/index', 'refresh' );
    	}else{
    		if (isset($_SESSION["client"])==false){
    			$data['back2cart'] = true;
    			$this->load->view('login/newForm.php',$data);
    		}else{
    			$this->load->view('payment/form.php');
    		}	
    	}
    }
    
    function listItemsFromOrder($orderId){
    	$this->load->model('item_model');
    	$items = $this->item_model->getAll($orderId);
    	$data['items']=$items;
    	$this->load->view('order/listItems.php',$data);
    }
    
    
	function checkCreditCard() {
    	if(isset($_SESSION["items"])==false){
    		echo '<script>';
    		echo 'alert("your session has expired")';
    		echo '</script>';
    		redirect ( 'store/index', 'refresh' );
    	}
    	else
		{
			$this->load->library ( 'form_validation' );
			$this->form_validation->set_rules ( 'creditcard_number', 'Credit Card Number', 'required|exact_length[16]|numeric' );
			$this->form_validation->set_rules ( 'creditcard_month', 'Credit Card Month', 'required|exact_length[2]|numeric' );
			$this->form_validation->set_rules ( 'creditcard_year', 'Credit Card Year', 'required|exact_length[4]|numeric' );
			
			if ($this->form_validation->run () == true) {
				if($this->input->get_post ( 'creditcard_year' ) < date ( 'Y' ) ){
					redirect ( 'store/expiredCreditCard', 'refresh' );
				}
				if($this->input->get_post ( 'creditcard_year' ) == date ( 'Y' ) ){
					if($this->input->get_post ( 'creditcard_month' ) < date ( 'm' )){
						redirect ( 'store/expiredCreditCard', 'refresh' );
					}
				}
				$this->load->model ( 'order_model' );
				$this->load->model ( 'item_model' );
				$order = new Order ();
				// http://php.net/manual/en/function.date.php
				$order->order_date = date ( 'Y-m-d' );
				$order->order_time = date ( 'H:i:s' );
				$order->customer_id = $_SESSION["client"]->id;
				$total = 0;
				foreach ( $_SESSION ['items'] as $k => $v ) {
					$total = $total + $v->price * $v->quantity;
				}
				$order->total = $total;
				$order->creditcard_number = $this->input->get_post ( 'creditcard_number' );
				$order->creditcard_month = $this->input->get_post ( 'creditcard_month' );
				$order->creditcard_year = $this->input->get_post ( 'creditcard_year' );
				$orderIdentification = $this->order_model->insert ( $order );
				
				foreach ( $_SESSION ['items'] as $k => $current_item ) {
					$current_item->order_id = $orderIdentification;
					$this->item_model->insert ( $current_item );
				}
				redirect ( 'store/email', 'refresh' );
			} else {
				$this->load->view ( 'payment/form.php' );
			}
		}
	}
	
	function expiredCreditCard(){
		echo '<script>';
		echo 'alert("your credit card has expired")';
		echo '</script>';
		redirect ( 'store/checkout', 'refresh' );
	}
  
    
    function email(){
    	//sendEmail()
    	if (isset($_SESSION["client"])==false) {
    		$data['back2cart'] = false;
    		$this->load->view('login/newForm.php',$data);
    	}else{
    		$somedata['clientVariable']= $_SESSION["client"];
    	}
    	//$this->email->from('md5destroyer@gmail.com', 'Baseball online store');
    	$this->email->from('bestcards@gmail.com', 'Baseball online store');
    	//$this->email->to('pvitor.93@gmail.com');
    	$this->email->to($somedata['clientVariable']->email);
    	$this->email->subject('Your BestCards order confirmation');
    	if (isset($_SESSION["items"])) {
    		$somedata['automaticitemsvariable']= $_SESSION["items"];
    		$emailbody = $this->load->view('email/emailLayout',$somedata,true);
    		//$emailbody = $this->load->view('order/receiptLayout',$somedata,true);
    		/*foreach($_SESSION['items'] as $k => $v) {
    			echo getcwd() . "/images/product/" . $v->photo_url,'inline';
    			$this->email->attach(getcwd() . "/images/product/" . $v->photo_url,"inline");
    			//echo getcwd();
    		}*/
    		
    		$this->email->message($emailbody);
    		if($this->email->send())
    		{
    			//echo 'Email sent.';
    		}else{
    			show_error($this->email->print_debugger());
    		}
    		unset($_SESSION['items']);
    		//$receiptText = $this->load->view('order/receiptLayout',$somedata,true);
    		$this->load->view('payment/thanks.php',$somedata);
    	}else{
    		echo '<script>';
    		echo 'alert("your session has expired")';
    		echo '</script>';
    		redirect('store/index', 'refresh');
    	}
    	
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
		redirect('store/loadProductAdmin', 'refresh');
	}
	
	function deleteCustomer($id) {
		$this->load->model('customer_model');
	
		if (isset($id))
			$this->customer_model->delete($id);
	
		//Then we redirect to the index page again
		redirect('store/loadCustomerAdmin', 'refresh');
	}
	
	function deleteOrder($id){
		$this->load->model('order_model');
		if (isset($id))
			$this->order_model->delete($id);
		redirect('store/loadOrderAdmin', 'refresh');
	}   
}