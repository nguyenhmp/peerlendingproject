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
				return false;
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
				return false;
			} else {
				$this->session->set_flashdata('itemMessage', "Item Successfully Added");

				$query = "INSERT INTO items (title, description, picture_src, stock, price, users_id) 
							VALUES (?, ?, ' ',? , ?, ?);";
				$values = array($item['name'], $item['description'], $item['status'], $item['price'], $this->session->userdata('id'));
				$this->db->query($query, $values);
			}
		}

		//gets all items from logged in user
		public function getUserItems($userID) {
			$query = "SELECT * FROM items
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
			return $this->db->query("SELECT * FROM items LEFT JOIN users ON items.users_id = users.id WHERE items.id = ?", array($itemID))->row_array();
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

	}

?>