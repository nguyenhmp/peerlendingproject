<?php

	class lending extends CI_model {

		//check the table name for registration validation
		public function registerUser($user) {
			$this->form_validation->set_rules("first", "First Name", "trim|required|alpha");
			$this->form_validation->set_rules("last", "Last Name", "trim|required|alpha");
			$this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
			$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
			$this->form_validation->set_rules("confirm", "Password Confirmation", "trim|required|matches[password]");

			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('registerError', validation_errors());
				return false;
			} else {
				$this->session->set_flashdata('registerMessage', "User Created Successfully");
				$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
							VALUES (?, ?, ?, ?, NOW(), NOW());";
				$values = array($user['first'], $user['last'], $user['email'], $user['password']);
				$this->db->query($query, $values);
				return true;
			}
		}

		//checks if valid user
		public function loginUser($user) {
			$query = "SELECT * FROM users WHERE email = ? && password = ?;";
			$values = array($user['email'], $user['password']);
			return $this->db->query($query, $values)->row_array();
		}

		//updates user account in edit page
		public function updateAccount($userNew) {
			$this->form_validation->set_rules("first", "First Name", "trim|required|alpha");
			$this->form_validation->set_rules("last", "Last Name", "trim|required|alpha");
			$this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
			$this->form_validation->set_rules("password", "Password Confirmation", "trim|required|min_length[8]");
			$this->form_validation->set_rules("confirm", "Password Confirmation", "trim|required|matches[password]");

			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('updateMessage', validation_errors());
			} else {
				$this->session->set_flashdata('updateMessage', "User Update was Successful");


				$query = "UPDATE users
							SET first_name = ?, last_name = ?, email = ?, password = ?, updated_at = NOW()
							WHERE id = ?;";
				$values = array($userNew['first'], $userNew['last'], $userNew['email'], $userNew['password'], $this->session->userdata('id'));
				$this->db->query($query, $values);

				return $this->db->query("SELECT * FROM users WHERE id = ?", array($this->session->userdata['id']))->row_array();
			}
		}

		//updates/inserts address in edit page
		public function updateAddress($address) {
			$this->form_validation->set_rules("house", "House Number", "trim|required|numeric");
			$this->form_validation->set_rules("street", "Street Name", "trim|required");
			$this->form_validation->set_rules("apt", "Apt #", "trim");
			$this->form_validation->set_rules("city", "City", "trim|required|alpha");
			$this->form_validation->set_rules("state", "State", "trim|required|alpha|exact_length[2]");
			$this->form_validation->set_rules("zip", "Zip Code", "trim|required|numeric|exact_length[5]");
			
			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('addressMessage', validation_errors());
				return false;
			} else {
				$this->session->set_flashdata('addressMessage', "Address Update was Successful");
				$query = "INSERT INTO user_address (house_number, street_name, apt_number, city, state, zip_code)
							VALUES(?, ?, ?, ?, ?, ?);";
				$values = array($address['house'], $address['street'], $address['apt'], $address['city'], $address['state'], $address['zip']);
				$this->db->query($query,$values);

				$addressID = $this->db->insert_id();
				$query2 = "UPDATE users SET address_id = ? where users.id = ?;";
				$values2 = array($addressID, $this->session->userdata('id'));
				$this->db->query($query2,$values2);
			}
		}

		//gets Single address for currentUser
		public function getAddress() {
			return $this->db->query("SELECT * FROM users
								LEFT JOIN user_address ON users.address_id = user_address.id
								WHERE users.id = ?", array($this->session->userdata('id')))->row_array();
		}

		//adds item into the item table (missing picture_src)
		//how to set status validation to either in/out
		public function addItem($item) {
			$this->form_validation->set_rules("name", "Item Name", "trim|required");
			$this->form_validation->set_rules("description", "Item Description", "trim|required");
			$this->form_validation->set_rules("status", "Item Status", "trim|required");
			$this->form_validation->set_rules("price", "Item Price", "trim|required|numeric");
			
			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('itemMessage', validation_errors());
				redirect('/Lendings/viewAddItem');
			} else {
				$this->session->set_userdata('itemMessage', "Item Successfully Added");
				$query = "INSERT INTO items (title, description, picture_src, stock, price, users_id) 
							VALUES (?, ?, ' ',? , ?, ?);";
				$values = array($item['name'], $item['description'], $item['status'], $item['price'], $this->session->userdata('id'));
				$this->db->query($query, $values);
				echo "<script type = 'text/javascript'> window.opener.location.reload(); window.close(); </script>";
			}
		}

		//gets all items from logged in user
		public function getUserItems($userID) {
			$query = "SELECT *, items.id as item_id FROM items
						LEFT JOIN users ON items.users_id = users.id
						WHERE users.id = ?;";
			$values = array($userID);
			return $this->db->query($query, $values)->result_array();
		}

		//gets items that dont belong to user
		public function getOtherItems() {
			$query = "SELECT *, items.id FROM items
						LEFT JOIN users ON items.users_id = users.id
						WHERE users.id != ?;";
			$values = array($this->session->userdata('id'));
			return $this->db->query($query, $values)->result_array();
		}


		//removes item from db
		public function removeItem($itemID) {
			$this->db->query("DELETE FROM items WHERE items.id = ?", array($itemID));
		}

		//gets item from db
		public function getItem($itemID) {
			return $this->db->query("SELECT *, items.id as item_id FROM items LEFT JOIN users ON items.users_id = users.id WHERE items.id = ?", array($itemID))->row_array();
		}

		public function userData($userID) {
			return $this->db->query("SELECT * FROM users
									LEFT JOIN items ON items.users_id = users.id
									where users.id = ?;", array($userID))->result_array();
		}

		public function userAddress($userID) {
			return $this->db->query("SELECT * FROM users
									LEFT JOIN user_address ON users.address_id = user_address.id 
									where users.id = ?;", array($userID))->row_array();
		}


		public function getMessagesByUserID($id){
			$query = "SELECT messages.id as msg_id, message_title as title, message_content as content, sent_at, first_name as fname, last_name as lname, email, users.id as u_id FROM messages join users WHERE created_by = users.id AND sent_to=?";
			$values = array($id);
			return $this->db->query($query, $values)->result_array();
		}

		public function getMessageByMessageID($messageID, $createrID){
			$query = "SELECT messages.id as msg_id, message_title as title, message_content as content, sent_at, first_name as fname, last_name as lname, email, users.id as u_id FROM messages join users WHERE messages.id=? AND users.id=?";
			$values = array($messageID, $createrID);
			return $this->db->query($query, $values)->row_array();
		}

		public function sendMessage($post, $id){
			if($post['title'] == ""){
				$post['title'] = "NO SUBJECT";
			}
			$query = "INSERT INTO messages (message_title, message_content, sent_at, created_by, sent_to) VALUES (?, ?, NOW(), ?, ?)";
			$values = array($post['title'], $post['message'], $this->session->userdata['id'], $id);
			$this->db->query($query, $values);
			$query = "INSERT INTO messages_out (message_title, message_content, sent_at, created_by, sent_to) VALUES (?, ?, NOW(), ?, ?)";
			$this->db->query($query, $values);
		}

		public function getUserByEmail($email){
			$query = "SELECT id, first_name, last_name, email FROM users WHERE email = ?";
			$values = array($email);
			return $this->db->query($query, $values)->row_array();
		}

		public function deleteMessage($id){
			$query = "DELETE FROM messages WHERE id = ?";
			$values = array($id);
			return $this->db->query($query, $values);
		}

		public function getSentMessages($createrID){
			$query = "SELECT messages_out.id as msg_id, message_title as title, message_content as content, sent_at, first_name as fname, last_name as lname, email, users.id as u_id FROM messages_out JOIN users WHERE sent_to = users.id AND created_by = ?";
			$values = array($createrID);
			return $this->db->query($query, $values)->result_array();
		}

		public function getUserRatings($userID) {
			$query = "SELECT * FROM ratings_user
					LEFT JOIN users on users.id = ratings_user.users_id
					WHERE users_id = ?;";
			$value = array($userID);
			return $this->db->query($query, $value)->result_array();
		}

		public function getOtherRatings($userID) {
				return $this->db->query("SELECT ratings_user.num_stars, ratings_user.users_id FROM users
				LEFT JOIN ratings_user on ratings_user.users_id != users.id;", array($userID))->result_array();
		}

		public function addRating($ratingInfo) {
			$this->form_validation->set_rules("title", "Rating Title", "trim");
			$this->form_validation->set_rules("comment", "Rating Comment", "trim|required");
			$this->form_validation->set_rules("stars", "Number of Stars", "trim|required|numeric");
			

			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('ratingMessage', validation_errors());
				return false;
			} else {
				$this->session->set_flashdata('ratingMessage', 'Rating Successfully Posted');
				$query = "INSERT INTO ratings_user (title, num_stars, comment, created_at, createdBy_id, users_id)
							VALUES (?, ?, ?, NOW(), ?, ?);";
				$values = array($ratingInfo['rating']['title'], $ratingInfo['rating']['stars'], $ratingInfo['rating']['comment'], $this->session->userdata('id'), $ratingInfo['profileID']);
				$this->db->query($query, $values);
			}
		}

		

		public function addItemRating($itemRating) {
			$this->form_validation->set_rules("title", "Rating Title", "trim");
			$this->form_validation->set_rules("comment", "Rating Comment", "trim|required");
			$this->form_validation->set_rules("stars", "Number of Stars", "trim|required|numeric");
			
			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('ratingMessage', validation_errors());
				return false;
			} else {
				$this->session->set_flashdata('ratingMessage', 'Rating Successfully Posted');
				$query = "INSERT INTO ratings_item (title, num_stars, comment, created_at, createdby_id, items_id)
							VALUES (?, ?, ?, NOW(), ?, ?);";
				$values = array($itemRating['rating']['title'], $itemRating['rating']['stars'], $itemRating['rating']['comment'], $this->session->userdata('id'), $itemRating['profileID']);
				$this->db->query($query, $values);
			}
		}


		public function getItemRatings($itemID) {
			$query = "SELECT * FROM ratings_item
						LEFT JOIN items on items.id = ratings_item.items_id
						WHERE items.id = ?;";
			$value = array($itemID);
			return $this->db->query($query, $value)->result_array();
		}


		public function getAllItemRatings() {
			return $this->db->query("SELECT * FROM ratings_item;")->result_array();
		}
		public function sendRequest($post){
			$this->load->helper(array('form', 'url'));
			$this->load->library("form_validation");
			$config = array(
				array('field' => 'start_date',
					'label' => 'Start Date',
					'rules' => 'trim|required'
					),
				array('field' => 'end_date',
					'label' => 'Return Date',
					'rules' => 'trim|required'
					),
				array('field' => 'price',
					'label' => 'Price',
					'rules' => 'trim|required'
					),
			);
			$this->form_validation->set_rules($config);
			$string = '/Lendings/requestItem/' . $post['item_id'];
			// if($this->form_validation->run() == FALSE){
			// 	$this->session->set_flashdata('errors', validation_errors());
			// 	redirect($string);
			// }else{
			// 	if(strtotime($post['start_date']) < strtotime(date("Y-m-d"))){
			// 		$this->session->set_flashdata('errors', 'please enter a future date from today');
			// 		redirect($string);
			// 	} 
			// 	else if (strtotime($post['start_date']) > strtotime($post['end_date'])){	
			// 		$this->session->set_flashdata('errors', 'please enter an end date in the future of your rental start');
			// 		redirect($string);
			// 	} else{
					$query = "INSERT INTO checkout_dates (start_date, end_date, items_id, owners_id, requesters_id, sent_at, approved) VALUES (?, ?, ?, ?, ?, NOW(), ?)";
					$values = array($post['start_date'], $post['end_date'], $post['item_id'], $post['owner_id'], $this->session->userdata('id'), 0);/*approved value is equal to 0 for request, 1 for approved and 2 for unapproved*/
					$this->db->query($query, $values);
					//sends notification message to owner of item
					$query = "INSERT INTO messages (message_title, message_content, sent_at, created_by, sent_to) VALUES (?, ?, NOW(), ?, ?)";
					$msgLink = "/lendings/requestReply/" . $this->session->userdata('id');
					$acceptReq = "/lendings/acceptRequest/" . $this->db->insert_id() . "/" . $this->session->userdata('id');
					$message = 'You have a new item request from ' . $this->session->userdata('email') . ' for ' . $post['title'] . ' from ' . date('d M Y', strtotime($post['start_date'])) . ' until ' . date('d M Y', strtotime($post['end_date'])) . ' at the offered price of ' . $post['price'] . '. Please use the links below to reply. <br> <a href=' . $msgLink . '>Send a message</a> <br> <a href=' . $acceptReq . '> Accept Request </a>';
					$values = array('ITEM REQUEST', $message, 99, $post['owner_id']);
					$this->db->query($query, $values);
					redirect('/lendings/welcome');
			// 	}
			// }
		}
		public function acceptRequest($reqInfo){
			$query1 = "UPDATE checkout_dates SET approved = 1 WHERE id = ?";
			$values1 = array($reqInfo['reqID']);
			$this->db->query($query1, $values1);
			$query2 = "INSERT INTO messages (message_title, message_content, sent_at, created_by, sent_to) VALUES (?, ?, NOW(), ?, ?)";
			$msgLink = "/lendings/requestReply/" . $this->session->userdata('id');
			$message = 'Your request to '  . $this->session->userdata('email') . ' for ' . $reqInfo['title'] . ' from ' . date('d M Y', strtotime($reqInfo['start_date'])) . ' until ' . date('d M Y', strtotime($reqInfo['end_date'])) . ' at the offered price of ' . $reqInfo['price'] . 'has been accepted. Please request a time and location for pick up through a personal message <br> <a href=' . $msgLink . '>Send a Message to' . $this->session->userdata('email') . '</a> ';
			$values2 = array('ITEM REQUEST accepted', $message, 99, $reqInfo['requesters_id']);
			$this->db->query($query2, $values2);

		}

		public function getRequestInfo($reqID){
			$query = "SELECT *, checkout_dates.id as reqID FROM checkout_dates JOIN items ON items_id = items.id WHERE checkout_dates.id = ?";
			$values = array($reqID);
			return $this->db->query($query, $values)->row_array();
		}

		public function getUserByID($id){
			$query = "SELECT first_name as fname, last_name as lname, email FROM users WHERE id = $id";
			return $this->db->query($query)->row_array();
		}

		public function getReqByApprove($userID, $approved){
			$query = "SELECT * FROM items JOIN checkout_dates on items.id = items_id JOIN users on requesters_id = users.id WHERE owners_id = $userID AND approved = $approved";
			return $this->db->query($query)->result_array();
		}

		public function addBillAddress($address) {
			$this->form_validation->set_rules("house", "House Number", "trim|required|numeric");
			$this->form_validation->set_rules("street", "Street Name", "trim|required");
			$this->form_validation->set_rules("apt", "Apt #", "trim");
			$this->form_validation->set_rules("city", "City", "trim|required|alpha");
			$this->form_validation->set_rules("state", "State", "trim|required|alpha|exact_length[2]");
			$this->form_validation->set_rules("zip", "Zip Code", "trim|required|numeric|exact_length[5]");
			
			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('addressMessage', validation_errors());
				return false;
			} else {
				$this->session->set_flashdata('addressMessage', "Billing Address submitted Successfully. Please click Pay Now");
				$query = "INSERT INTO cc_address (house_number, street_name, apt_number, city, state, zip_code)
							VALUES(?, ?, ?, ?, ?, ?);";
				$values = array($address['house'], $address['street'], $address['apt'], $address['city'], $address['state'], $address['zip']);
				$this->db->query($query,$values);

				$billAddress = $this->db->insert_id();
				$this->session->set_userdata('billAddress', $billAddress);
			}
		}

		public function saveStripeCustomerId($customer) {
			$query = "INSERT INTO cc_info (receiving_id, customer_id, cc_address_id, email)
						VALUES (?, ?, ?, ?);";
			$values = array($customer['receiving'], $customer['customerID'], $this->session->userdata('billAddress') , $customer['email']);
			$this->db->query($query,$values);
			$this->session->set_flashdata('billingMessage', "Payment was Succcessful!");
		}

		public function getStripeCustomerId($user) {

		}

	}

?>