<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Lendings extends CI_Controller {

	//comes to the landing page
	public function index() {
		$this->session->sess_destroy();
		$this->load->view('landing');
	}

	//Registration Page
	public function registration(){
		$this->load->view('registration');
	}

	//after user registers, redirects
	public function addUser(){
		$success = $this->lending->registerUser($this->input->post());
		if ($success == false) {
			redirect('/lending/register');
		} else { 
			echo "hi";
			redirect('/lendings/login');
		}
	}

	//Login Page
	public function login(){
		$this->load->view('login');
	}

	public function viewDashboard(){
		$data = array();
		$data['current'] = $this->session->userdata();
		$data['otherItems'] = $this->lending->getOtherItems($this->session->userdata('id'));
		$data['otherRatings'] = $this->lending->getOtherRatings($this->session->userdata('id'));
		$data['allItemRatings'] = $this->lending->getAllItemRatings();
		$data['unapprovedReq'] = $this->lending->getReqByApprove($this->session->userdata('id'), 0);
		$data['approvedReq'] = $this->lending->getReqByApprove($this->session->userdata('id'), 1);
		$this->load->view('welcome', $data);

	}

	//Input login data and redirects
	public function welcome() {
		if ($this->session->userdata('loggedIn') == TRUE) {
			redirect('/Lendings/viewDashboard');
		} else {
			$currentUser = $this->lending->loginUser($this->input->post());
			if ($currentUser != null) {
				$data = array();
				$this->session->set_userdata($currentUser);
				$this->session->set_userdata('loggedIn', TRUE);
				redirect('Lendings/viewDashboard');
			} else {
				$this->session->set_flashdata('loginMessage', 'Account does not exist.');
				$this->load->view('login');
			}
		}
	}

	//Shows user their profile (links to edit)
	public function profile() {
		$data['current'] = $this->session->userdata();
		$data['userItems'] = $this->lending->getUserItems($this->session->userdata('id'));
		$data['userRating'] = $this->lending->getUserRatings($this->session->userdata('id'));
		$addressData = $this->lending->getAddress();
		$this->session->set_userdata('address', $addressData);
		$this->load->view('profile', $data);
	}

	//edits user profile (resubmits into database)
	public function edit() {
		$addressData = $this->lending->getAddress();
		$this->session->set_userdata('address', $addressData);
		$this->load->view('edit');
	}

	//updates user info and redirects back to edit
	public function update() {
		$currentUserUpdated = $this->lending->updateAccount($this->input->post());
		$this->session->set_userdata($currentUserUpdated);
		$this->load->view('edit');
	}

	//updates user address and redirects back to edit
	public function address() {
		$this->lending->updateAddress($this->input->post());
		$addressData = $this->lending->getAddress();
		$this->session->set_userdata('address', $addressData);
		$this->load->view('edit');
	}

	//goes to user inventory, can add product
	public function inventory() {
		$data['userItems'] = $this->lending->getUserItems($this->session->userdata('id'));
		$this->load->view('inventory', $data);
	}


	//adds the product and refreshes to show inventory page
	public function addInventory() {
		//where does image go????
		$this->lending->addItem($this->input->post());
	}

	public function editInventory($itemID) {
		$item = $this->lending->getItem($itemID);
		$data['item'] = $item;
		$this->load->view('itemPage', $data);
	}

	public function removeItem($itemID) {
		$this->lending->removeItem($itemID);
		$data['userItems'] = $this->lending->getUserItems($this->session->userdata('id'));
		$this->load->view('inventory', $data);
	}

	public function viewItem($itemID) {
		$data['item'] = $this->lending->getItem($itemID);
		$data['itemRating'] = $this->lending->getItemRatings($itemID);
		$this->load->view('viewItem', $data);
	}

	public function viewProfile($profileID) {	
		$data['profileInfo'] = $this->lending->userData($profileID);
		$data['addressInfo'] = $this->lending->userAddress($profileID);
		$data['userRating'] = $this->lending->getUserRatings($profileID);
		$data['userItems'] = $this->lending->getUserItems($profileID);
		$data['profileID'] = $profileID;
		$this->load->view('viewProfile', $data);
	}

	public function message() {
		$this->load->model('lending');
		$data['messages'] = $this->lending->getMessagesByUserID($this->session->userdata['id']);
		$this->load->view('message', $data);
	}

	public function messageDetails($messageID, $createrID){
		$this->load->model('lending');
		$data['message'] = $this->lending->getMessageByMessageID($messageID, $createrID);
		$this->load->view('messagedetail', $data);
	}

	public function reply($msgID, $userID){
		$this->load->model('lending');
		$this->session->set_flashdata('msg', $this->lending->getMessageByMessageID($msgID, $userID));
		redirect('Lendings/sendMessage');
	}
	public function sendMessage(){
		$data['info'] = $this->session->flashdata('msg');
		if($data['info']['title'] != NULL){
			$data['info']['title'] .= " (reply)";
		}
		$this->load->view('sendmessage', $data);
	}

	public function sendingMessage(){
		$this->load->model('lending');
		$user = $this->lending->getUserByEmail($this->input->post('email'));
		if($user == NULL){
			redirect('/Lendings/sendMessage', $this->session->set_flashdata('error', 'The email you provided did not have an accont with us'));
		} else {
			$this->lending->sendMessage($this->input->post(), $user['id']); 
			$sentMessage = "Message sent to " . $user['email'] . "!";
			redirect('/Lendings/message', $this->session->set_flashdata('success', $sentMessage));
		}
	}

	public function deleteMessage($id){
		$this->load->model('lending');
		$this->lending->deleteMessage($id);
		$delMessage = 'Message has been deleted';
		redirect('/Lendings/message', $this->session->set_flashdata('success', $delMessage));

	}

	public function messageOut(){
		$this->load->model('lending');
		$data['messages'] = $this->lending->getSentMessages($this->session->userdata['id']);
		$this->load->view('messageout', $data);
	}

	public function addUserRating($profileID) {
		$userData['rating'] = $this->input->post();
		$userData['profileID'] = $profileID;
		$this->lending->addRating($userData);

		$data['profileInfo'] = $this->lending->userData($profileID);
		$data['addressInfo'] = $this->lending->userAddress($profileID);
		$data['userRating'] = $this->lending->getUserRatings($profileID);
		$data['userItems'] = $this->lending->getUserItems($profileID);
		$data['profileID'] = $profileID;
		$this->load->view('viewProfile', $data);
	}

	public function viewAddItem(){
		$this->load->view('additem');
	}

	public function requestItem($itemID){
		$data['item'] = $this->lending->getItem($itemID);
		$this->load->view('requestitem', $data);
	}

	public function sendRequest(){
		$this->lending->sendRequest($this->input->post());

	}

	public function addItemRating($itemID) {
		$itemData['rating'] = $this->input->post();
		$itemData['profileID'] = $itemID;
		$this->lending->addItemRating($itemData);

		$data['item'] = $this->lending->getItem($itemID);
		$data['itemRating'] = $this->lending->getItemRatings($itemID);
		$this->load->view('viewItem', $data);
	}

	public function acceptRequest($reqID){
		$data = $this->lending->getRequestInfo($reqID);
		$this->lending->acceptRequest($data);
		redirect('Lendings/message');
	}

	public function requestReply($userID){
		$data = $this->lending->getUserByID($userID);
		$data['title'] = "Request Pickup Info";
		$this->session->set_flashdata('msg', $data);
		redirect('/Lendings/sendMessage');
	}

	//NEW CODE
	public function charge() {

		require_once("\assets\init.php");
		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");

		// Get the credit card details submitted by the form
		$token = $this->input->post('stripeToken');

		// Create a Customer
		$customer = \Stripe\Customer::create(array(
		  "source" => $token,
		  "description" => "Example customer")
		);

		// Charge the Customer instead of the card
		\Stripe\Charge::create(array(
		  "amount" => 1000, # amount in cents, again
		  "currency" => "usd",
		  "customer" => $customer->id)
		);

		// var_dump($customer->id);
		// Save the customer ID in your database so you can use it later
		$data['email'] = $this->input->post('stripeEmail');
		$data['customerID'] = $customer->id;
		$data['receiving'] = 1; //dont havc receiving id reference yet
		$this->lending->saveStripeCustomerId($data);
		
		$this->load->view('checkout');

		// Later...DONT KNOW HOW TO BUILD
		// $customerId = getStripeCustomerId($user);

		// \Stripe\Charge::create(array(
		//   "amount"   => 1500, # $15.00 this time
		//   "currency" => "usd",
		//   "customer" => $customerId)
		// );
	}

	public function bill() {
		$this->lending->addBillAddress($this->input->post());
		$this->load->view('checkout');
	}

	public function pay() {
		$this->load->view('checkout');
	}

}
?>