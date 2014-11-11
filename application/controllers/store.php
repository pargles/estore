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
    	$this->load->view('main_page/main.php',$data);
    }
    
    function loadProductAdmin(){
    	$this->load->model('product_model');
    	$products = $this->product_model->getAll();
    	$data['products']=$products;
    	$this->load->view('product/list.php',$data);
    }
        function createLoginForm(){
    	$this->load->view('login/newForm.php');
    }
    
    function createSinginForm(){	
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('first','First','required');
		$this->form_validation->set_rules('last','Last','required');
		$this->form_validation->set_rules('login','Login','required');
    	$this->form_validation->set_rules('password','Password','required|min_length[6]||matches[repeat_password]|callback_length_password_check');
		$this->form_validation->set_rules('repeat_password','Repeat_Password','required');
		$this->form_validation->set_rules('email','Email','required |valid_email');
		
		if ($this->form_validation->run() == true) {
			$this->load->model('customer_model');
			$customers = new Customer();
			$customers->first = $this->input->get_post('first');
			$customers->last = $this->input->get_post('last');
			$customers->login = $this->input->get_post('login');
			$customers->password = $this->input->get_post('password');
			$customers->email = $this->input->get_post('email');
			
		    $data = $this->upload->data();
		
			$this->customer_model->insert($customers);

			//Then we redirect to the index page again
			//redirect('store/index', 'refresh');
			$this->load->view('login/newAccountSuccess.php');
		}
		else {
			//redirect('store/index', 'refresh');
			$this->load->view('login/newForm.php');
		}	
	}
    
	public function length_password_check($length_password) {
    	if (strlen($length_password) < 6 ){
    		$this->form_validation->set_message('length_password_check', 'Your password must have at least 6 characters long');
    		return false;
    	}
    	return true;
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
    	$this->form_validation->set_rules('creditcard_number','Credit Card Number','required|exact_length[16]|numeric');
    	$this->form_validation->set_rules('creditcard_month','Credit Card Month','required|exact_length[2]|numeric|callback_month_check');
    	$this->form_validation->set_rules('creditcard_year','Credit Card Year','required|exact_length[4]|numeric|callback_year_check');
    
    	if ($this->form_validation->run() == true) {
    		$this->load->model('order_model');
    		$this->load->model('item_model');
    		$order = new Order();
    		//http://php.net/manual/en/function.date.php
    		$order->order_date = date('Y-m-d');
    		$order->order_time = date('H:i:s');
    		$order->customer_id = 4;
    		$total = 0;
    		foreach($_SESSION['items'] as $k => $v) {
    			$total = $total + $v->price;
    		}
    		$order->total = $total;
    		$order->creditcard_number = $this->input->get_post('creditcard_number');
    		$order->creditcard_month = $this->input->get_post('creditcard_month');
    		$order->creditcard_year = $this->input->get_post('creditcard_year');  
    		$this->order_model->insert($order);
    		$orderIdentification =  $this->order_model->insert($order);
    		
    		foreach($_SESSION['items'] as $k => $current_item) {
    			$current_item->order_id = $orderIdentification;
    			$this->item_model->insert($current_item);
    		}
    		redirect('store/email', 'refresh');
    	}
    	else {    			
    		$this->load->view('payment/form.php');
    	}
    }
    
    public function month_check($creditcard_month) {
    	if ($creditcard_month < date('m') ){
    		$this->form_validation->set_message('month_check', 'Your credit card has expired');
    		return false;
    	}
    	return true;
    }
    
    public function year_check($creditcard_year) {
    	if ($creditcard_year < date('Y') ){
    		$this->form_validation->set_message('year_check', 'Your credit card has expired');
    		return false;
    	}
    	return true;
    }
    
    function email(){
    	//sendEmail()
    	$this->email->from('md5destroyer@gmail.com', 'Baseball online store');
    	//$this->email->to('pvitor.93@gmail.com');
    	$this->email->to('pargles1@gmail.com');
    	$this->email->subject('Your BestCards order confirmation');
    	$client = "Abias Corpus";
    	$messageHeader = 'Hello '.$client.' <p> Thank you for shopping with us. The following products will be shipped shortly to your address. <br>';
    	$messageBody = '<table>';
    	$messageBottom = '<br>We hope to see you again soon! <br> BestCards';
    	$emailbody='';
    	/*
    	foreach($_SESSION['items'] as $k => $current_item) {
    		//$imagePath = base_url() . 'images/product/' . $current_item->photo_url;
    		//$fileExt = get_mime_by_extension($imagePath); //  get the mime type
    		//$messageBody .= '<tr><td><img src="data:'.$fileExt.';base64,'.base64_encode(file_get_contents($imagePath)).'"></td><td>'.$current_item->price.'</td></tr>';
    		$emailbody = $this->load->view('produt/list.php',$data);
    	}*/
    	if (isset($_SESSION["items"])) {
    		$somedata['automaticitemsvariable']= $_SESSION["items"];
    		//$somedata['msg']= "hello world";
    		$emailbody = $this->load->view('email/emailLayout',$somedata,true);
    	}
    	$messageBody .= '</table>';
    	//$this->email->message($messageHeader.$messageBody.$messageBottom);	
    	$this->email->message($emailbody);
    	if($this->email->send())
     	{
      		echo 'Email sent.';
     	}else{
     		show_error($this->email->print_debugger());
    	}
    	//echo $this->email->print_debugger();
    	//unset($_SESSION['items']);
    	$this->load->view('payment/thanks.php');
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

