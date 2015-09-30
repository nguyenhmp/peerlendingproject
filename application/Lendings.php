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

	//Input login data and redirects
	public function welcome() {
		if ($this->session->userdata('loggedIn') == TRUE) {
			$data = array();
			$data['current'] = $this->session->userdata();
			$data['otherItems'] = $this->lending->getOtherItems($this->session->userdata('id'));
			$data['otherRatings'] = $this->lending->getOtherRatings($this->session->userdata('id'));
			$this->load->view('welcome', $data);
		} else {
			$currentUser = $this->lending->loginUser($this->input->post());

			if ($currentUser != null) {
				$data = array();
				$this->session->set_userdata($currentUser);
				$this->session->set_userdata('loggedIn', TRUE);

				$data['current'] = $this->session->userdata();	
				$data['otherItems'] = $this->lending->getOtherItems($this->session->userdata('id'));
				$data['otherRatings'] = $this->lending->getOtherRatings($this->session->userdata('id'));
				$this->load->view('welcome', $data);
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
		$data['userItems'] = $this->lending->getUserItems($this->session->userdata('id'));
		$this->load->view('inventory', $data);
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
		$this->load->view('viewItem', $data);
	}

	public function viewProfile($profileID) {	
		$data['profileInfo'] = $this->lending->userData($profileID);
		$data['addressInfo'] = $this->lending->userAddress($profileID);
		$data['userRating'] = $this->lending->getUserRatings($profileID);
		$data['userItems'] = $this->lending->getUserItems($profileID);

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
			redirect('Lendings/sendMessage', $this->session->set_flashdata('error', 'The email you provided did not have an accont with us'));
		} else {
			$this->lending->sendMessage($this->input->post(), $user['id']); 
			$sentMessage = "Message sent to " . $user['email'] . "!";
			redirect('Lendings/message', $this->session->set_flashdata('success', $sentMessage));
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




}
?>