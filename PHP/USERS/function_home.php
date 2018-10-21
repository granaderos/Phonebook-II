<?php
	
	include "database_connection.php";
	
	class function_home extends database_connection {
			
			function add_user($firstname, $middlename, $lastname, $gender, $age, $new_username, $new_password) {
				$this->open_connection();
				
				$insert_statement = $this->dbh->prepare("INSERT INTO users VALUES (null, ?, ?, ?, ?, ?, ?, ?);");
				$insert_statement->bindParam(1, $firstname);
				$insert_statement->bindParam(2, $middlename);
				$insert_statement->bindParam(3, $lastname);
				$insert_statement->bindParam(4, $gender);
				$insert_statement->bindParam(5, $age);
				$insert_statement->bindParam(6, $new_username);
				$insert_statement->bindParam(7, $new_password);
				$insert_statement->execute();
				
				$this->close_connection();
			}
			
			function check_username($username_entered) {
				$this->open_connection();
				
				$select_statement = $this->dbh->query("SELECT username FROM users;");
				
				$username_array = array();
				
				while($usernames = $select_statement->fetch()) {
					foreach($usernames as $username) {
						array_push($username_array, $username);
					}
				}

				foreach($username_array as $username) {
					if($username_entered == $username) {
						return true;
					}
				}
				
				$this->close_connection();
			}
			
			function check_password($username_entered, $password_entered) {
				$this->open_connection();
					
				$select_statement = $this->dbh->prepare("SELECT password FROM users WHERE username = ?;");
				$select_statement->bindParam(1, $username_entered);
				$select_statement->execute();	
				
				$password = $select_statement->fetch();
				
				if($password_entered == $password[0]) {
					return true;
				}
				
				$this->close_connection();
			}
     
			function determine_current_user($username_entered){
				$this->open_connection();
				
				$select_statement1 = $this->dbh->prepare("SELECT user_id, firstname, middlename, lastname  FROM users WHERE username = ?");
				$select_statement1->bindParam(1, $username_entered);
				$select_statement1->execute();
				
				$current_user_data = $select_statement1->fetch();
				
				$current_user_fullname = $current_user_data[1]."&nbsp;".$current_user_data[2]."&nbsp;".$current_user_data[3];
				
				$data = array("current_user"=>$username_entered, "current_user_id"=>$current_user_data[0], "current_user_fullname"=>$current_user_fullname);
				$encoded_data = json_encode($data);
				
				echo $encoded_data;
				
				$this->close_connection();
			}
	
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
		
		function display_entries($current_user) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT p.contact_id, p.names, p.contact_number FROM phonebook_entries AS p, users AS u, phonebook_entries_to_user AS pu WHERE p.contact_id = pu.contact_id AND u.user_id = pu.user_id AND p.owner = ?;");
			$select_statement->bindParam(1, $current_user);
			$select_statement->execute();
			
			$contents = $select_statement->fetch();
			echo "<tr>
					<th></th>
					<th>NAME</th>
					<th>CONTACT NUMBER</th>
				</tr>";
			while ($content = $select_statement->fetch()){
				echo "<tr id = '".$content[0]."'>
							<td id = 'share' onclick = 'share(".$content[0].")'>share</share>
							<td>".$content[1]."</td>
							<td>".$content[2]."</td>
							<td id = 'edit' onclick = 'set_input_values(".$content[0].")'>edit</td>
							<td id = 'delete' onclick = 'delete_entry(".$content[0].")'>delete</td>
						</tr>";
					
			}
			$this->close_connection();
		}
		
		function add_phonebook_entry($names, $contact_number, $current_user) {
			$this->open_connection();
		
			$insert_statement1 = $this->dbh->prepare("INSERT INTO phonebook_entries VALUES (null, ?, ?, ?);");
			$insert_statement1->bindParam(1, $names);
			$insert_statement1->bindParam(2, $contact_number);
			$insert_statement1->bindParam(3, $current_user);
			$insert_statement1->execute();
			
			$contact_id = $this->dbh->lastInsertId();
			
			echo "<tr id = ".$contact_id.">
						<td id = 'share' onclick = 'share(".$contact_id.")'>share</share>
						<td>".$names."</td>
						<td>".$contact_number."</td>
						<td id = 'edit' onclick = 'set_input_values(".$contact_id.")'>edit</td>
						<td id = 'delete' onclick = 'delete_entry(".$contact_id.")'>delete</td>
					</tr>";
			
			$select_statement = $this->dbh->prepare("SELECT user_id FROM users WHERE username = ?;");
			$select_statement->bindParam(1, $current_user);
			$select_statement->execute();
			
			$user_id = $select_statement->fetch();
			
			$insert_statement2 = $this->dbh->prepare("INSERT INTO phonebook_entries_to_user VALUES (null, ?, ?);");
			$insert_statement2->bindParam(1, $contact_id);
			$insert_statement2->bindParam(2, $user_id[0]);
			$insert_statement2->execute();
			
			$this->close_connection();
		}
		
		function retrieve_entry($contact_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT * FROM phonebook_entries WHERE contact_id = ?;");
			$select_statement->bindParam(1, $contact_id);
			$select_statement->execute();
			
			$content = $select_statement->fetch();
			$data_array = array("contact_id"=>$content[0], "names"=>$content[1], "contact_number"=>$content[2]);
			$encoded_data = json_encode($data_array);
			
			echo $encoded_data;			
			
			$this->close_connection();
		}
	
		function edit_entry($names, $contact_number, $contact_id) {
			$this->open_connection();
			
			$update_statement = $this->dbh->prepare("UPDATE phonebook_entries SET names = ?, contact_number = ? WHERE contact_id = ?;");
			$update_statement->bindParam(1, $names);
			$update_statement->bindParam(2, $contact_number);
			$update_statement->bindParam(3, $contact_id);
			$update_statement->execute();
			
			echo "<td id = 'share' onclick = 'share(".$contact_id.")'>share</share>
				  <td>".$names."</td>
				  <td>".$contact_number."</td>
				  <td id = 'edit' onclick = 'set_input_values(".$contact_id.")'>edit</td>
				  <td id = 'delete' onclick = 'delete_entry(".$contact_id.")'>delete</td>";
				  
			$this->close_connection();
		}

		function delete_entry($contact_id) {
			$this->open_connection();
			
			$delete_statement = $this->dbh->prepare("DELETE FROM phonebook_entries WHERE contact_id = ?;");
			$delete_statement->bindParam(1, $contact_id);
			$delete_statement->execute();
			
			echo $contact_id;
			
			$this->close_connection();
		}
		
		function get_total_phonebook_entries($current_user_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT COUNT(user_id) FROM phonebook_entries_to_user WHERE user_id = ?");
			$select_statement->bindParam(1, $current_user_id);
			$select_statement->execute();
			
			$total_contact = $select_statement->fetch();
			
			echo $total_contact[0];
			
			$this->close_connection();
		}
		
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
		
		function search_people($search_people_field, $current_user_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT * FROM users WHERE user_id != ? && firstname LIKE '".$search_people_field."%' || lastname LIKE '".$search_people_field."%' ;");
			$select_statement->bindParam(1, $current_user_id);
			$select_statement->execute();
			
			while($content = $select_statement->fetch()) {
			
					echo "<tr id = '".$content[0]."' class = 'tr_background'>
								<td>".$content[1]."</td>
								<td>".$content[2]."</td>
								<td>".$content[3]."</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = 'button' id = 'button_".$content[0]."' onclick = 'add_friends(".$content[0].")' value = 'add to friend list' /></td>
							</tr>";
				
			}
			
			$this->close_connection();
		}
		
		function select_contact_to_share($contact_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT * FROM phonebook_entries WHERE contact_id = ?;");
			$select_statement->bindParam(1, $contact_id);
			$select_statement->execute();
			
			$content = $select_statement->fetch(); 
			
			echo "<table>
						<tr>
							<td>".$content[1]."</td>
							<td>".$content[2]."</td>
						</tr>
					</table>";
			
			$this->close_connection();
		}
		
		function add_friends($current_user_id, $friend_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT friend FROM friends WHERE self = ?;");
			$select_statement->bindParam(1, $current_user_id);
			$select_statement->execute();
			
			$friends_already = false;
			while($friends = $select_statement->fetch()) {
				foreach($friends as $friendships) {
					if($friendships == $friend_id) {
						$friends_already = true;
						break;
					}
				}
			}
			
			if(!$friends_already) {
			
				$insert_statement = $this->dbh->prepare("INSERT INTO friends VALUES (null, ?, ?);");
				$insert_statement->bindParam(1, $current_user_id);
				$insert_statement->bindParam(2, $friend_id);
				$insert_statement->execute();
			
				$select_statement = $this->dbh->prepare("SELECT firstname, middlename, lastname FROM users WHERE user_id = ?;");
				$select_statement->bindParam(1, $friend_id);
				$select_statement->execute();
			
				$content = $select_statement->fetch();
			
				echo $content[0]."&nbsp;".$content[1]."&nbsp;".$content[2]."&nbsp; was successfully added to you friend list.";
			
			}
			
			$this->close_connection();
		}
		
		function display_friends($current_user_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT u.firstname, u.middlename, u.lastname, u.gender, u.age FROM users AS u, friends AS f WHERE u.user_id = f.friend AND f.self = ?;");
			$select_statement->bindParam(1, $current_user_id);
			$select_statement->execute();
	
			while($content = $select_statement->fetch()) {
				echo "<p id = 'friends_p'><span id = 'username'>".$content[0]."&nbsp;".$content[1]."&nbsp;".$content[2]."</span><br />gender:&nbsp;".$content[3]."<br />age:&nbsp".$content[4]."</p>";
			}
			
			$this->close_connection();
		}
		
		function get_total_friends($current_user_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT COUNT(friend) FROM friends WHERE self = ?;");
			$select_statement->bindParam(1, $current_user_id);
			$select_statement->execute();
			
			$total_friends = $select_statement->fetch();

			echo $total_friends[0];
			
			$this->close_connection();
		}
		
		function add_shared_phonebook_entries($current_user_id, $friend_id, $shared_contact_id, $time_shared) {
			$this->open_connection();
			
			$insert_statement = $this->dbh->prepare("INSERT INTO shared_phonebook_entries VALUES (null, ?, ?, ?, ?);");
			$insert_statement->bindParam(1, $current_user_id);
			$insert_statement->bindParam(2, $friend_id);
			$insert_statement->bindParam(3, $shared_contact_id);
			$insert_statement->bindParam(4, $time_shared);
			$insert_statement->execute();
				
			$this->close_connection();
		}
		
		function display_shared_contacts($current_user_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT p.contact_id, p.names, p.contact_number, u.user_id, u.firstname, u.middlename, u.lastname, s.shared_time FROM phonebook_entries as p, users as u, shared_phonebook_entries as s WHERE p.contact_id = s.shared_contact_id AND u.user_id = s.shared_by_id AND s.shared_to_id = ? ORDER BY s.shared_time DESC;");
			$select_statement->bindParam(1, $current_user_id);
			$select_statement->execute();
			
			//date_default_timezone_set('Asia/Philippines');
			//$date = date('m/d/Y h:i:s a', time());
			while($shared = $select_statement->fetch()) {
				echo "<div id = 'shared_div'><p id = 'shared_p'><span class = 'sharer_span'>".$shared[4]."&nbsp;".$shared[5]."&nbsp;".$shared[6]."</span>&nbsp; shared a contact.</p><p class = 'contact_shared'><tr id = 'shared_contact_".$shared[0]."'><td>".$shared[1]."</td><td>&nbsp;-----&nbsp;</td><td> ".$shared[2]."</td></p><p id = 'shared_time'>Date/Time shared: ".$shared[7]."</p><br /><input type = 'button' id = 'like_".$shared[0]."' onclick = 'like(".$shared[0].")' value = 'like'><input type = 'button' id = 'save_".$shared[0]."' onclick = 'save_shared(".$shared[0].")' value = 'save'></div><br /><hr />";
			}
			
			$this->close_connection();
		}
		
		function select_friend($current_user_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT u.user_id, u.firstname, u.middlename, u.lastname FROM users AS u, friends AS f WHERE u.user_id = f.friend AND f.self = ?");
			$select_statement->bindParam(1, $current_user_id);
			$select_statement->execute();
			
			while($content = $select_statement->fetch()) {
				echo "<tr id = '".$content[0]."'>
							<td><input type = button value = '".$content[1]."&nbsp;".$content[2]."&nbsp;".$content[3]."' onclick = 'share_share(".$content[0].")' /> </td>
						</tr>";
			}

			$this->close_connection();
		}
		
		function add_like_notification($current_user_id, $liked_contact_id, $liked_time) {
			$this->open_connection();
			
			$select_statement1 = $this->dbh->prepare("SELECT * FROM users WHERE user_id = ?;");
			$select_statement1->bindParam(1, $current_user_id);
			$select_statement1->execute();
			
			$content = $select_statement1->fetch();
			
			$liker_fullname = $content[1]." ".$content[2]." ".$content[3];
			
			$select_statement2 = $this->dbh->prepare("SELECT * FROM phonebook_entries WHERE contact_id = ?");
			$select_statement2->bindParam(1, $liked_contact_id);
			$select_statement2->execute();
			
			$liked_contact = $select_statement2->fetch();
			
			$select_statement3 = $this->dbh->prepare("SELECT shared_by_id FROM shared_phonebook_entries WHERE shared_to_id = ? AND shared_contact_id = ?;");
			$select_statement3->bindParam(1, $current_user_id);
			$select_statement3->bindParam(2, $liked_contact_id);
			$select_statement3->execute();
			
			$sharer_id = $select_statement3->fetch();
			
			$insert_statement = $this->dbh->prepare("INSERT INTO likes VALUE (null, ?, ?, ?, ?, ?);");
			$insert_statement->bindParam(1, $liker_fullname);
			$insert_statement->bindParam(2, $sharer_id[0]);
			$insert_statement->bindParam(3, $liked_contact[1]);
			$insert_statement->bindParam(4, $liked_contact[2]);
			$insert_statement->bindParam(5, $liked_time);
			$insert_statement->execute();

			$this->close_connection();
		}
		
		function display_like_notification($current_user_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT * FROM likes WHERE sharer = ? ORDER BY liked_time DESC;");
			$select_statement->bindParam(1, $current_user_id);
			$select_statement->execute();
			while($content = $select_statement->fetch()) {
				echo "<p id = 'like_notification'><span class = 'sharer_span'>".$content[1]."</span>&nbsp; likes the contact you've shared (<span class = 'contact_shared'>".$content[3]."&nbsp;-----&nbsp;".$content[4]."</span>).<br /><br />Date/Time:&nbsp;".$content[5]."</p><hr /><hr />";
			}
			$this->close_connection();
		}
		
		function add_save_shared($current_user_id, $saved_contact_id, $saved_time) {
			$this->open_connection();
			
			$select_statement1 = $this->dbh->prepare("SELECT * FROM users WHERE user_id = ?;");
			$select_statement1->bindParam(1, $current_user_id);
			$select_statement1->execute();
			
			$current_user = $select_statement1->fetch();
			
			$saver_fullname = $current_user[1]." ".$current_user[2]." ".$current_user[3];
			
			$select_statement2 = $this->dbh->prepare("SELECT shared_by_id FROM shared_phonebook_entries WHERE shared_to_id = ? AND shared_contact_id = ?;");
			$select_statement2->bindParam(1, $current_user_id);
			$select_statement2->bindParam(2, $saved_contact_id);
			$select_statement2->execute();
			
			$sharer_id = $select_statement2->fetch();
			
			$select_statement3 = $this->dbh->prepare("SELECT * FROM phonebook_entries WHERE contact_id = ?;");
			$select_statement3->bindParam(1, $saved_contact_id);
			$select_statement3->execute();
			
			$contact_saved = $select_statement3->fetch();
			
			$insert_statement1 = $this->dbh->prepare("INSERT INTO saves VALUES (null, ?, ?, ?, ?, ?);");
			$insert_statement1->bindParam(1, $saver_fullname);
			$insert_statement1->bindParam(2, $sharer_id[0]);
			$insert_statement1->bindParam(3, $contact_saved[1]);
			$insert_statement1->bindParam(4, $contact_saved[2]);
			$insert_statement1->bindParam(5, $saved_time);
			$insert_statement1->execute();
			
			$insert_statement2 = $this->dbh->prepare("INSERT INTO phonebook_entries VALUES (null, ?, ?, ?);");
			$insert_statement2->bindParam(1, $contact_saved[1]);
			$insert_statement2->bindParam(2, $contact_saved[2]);
			$insert_statement2->bindParam(3, $current_user[6]);
			$insert_statement2->execute();
			
			$last_inserted_contact_id = $this->dbh->lastInsertId();
			
			$insert_statement3 = $this->dbh->prepare("INSERT INTO phonebook_entries_to_user VALUES (null, ?, ?);");
			$insert_statement3->bindParam(1, $last_inserted_contact_id);
			$insert_statement3->bindParam(2, $current_user[0]);
			$insert_statement3->execute(); 
		
			echo "<tr id = '".$last_inserted_contact_id."'>
					<td id = 'share' onclick = 'share(".$last_inserted_contact_id.")'>share</share>
					<td>".$contact_saved[1]."</td>
					<td>".$contact_saved[2]."</td>
					<td id = 'edit' onclick = 'set_input_values(".$last_inserted_contact_id.")'>edit</td>
					<td id = 'delete' onclick = 'delete_entry(".$last_inserted_contact_id.")'>delete</td>
				</tr>";
			
			
			
			$this->close_connection();
		}
		
		function display_saves_notifications($current_user_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT * FROM saves WHERE sharer = ? ORDER BY saved_time DESC;");
			$select_statement->bindParam(1, $current_user_id);
			$select_statement->execute();
			
			while($content = $select_statement->fetch()) {
				echo "<p><span class = 'sharer_span'>".$content[1]."</span> saved the contact you've shared (<span class = 'contact_shared'>".$content[3]."&nbsp;-----&nbsp;".$content[4]."</span>).<br /><br />Date/Time: &nbsp;".$content[5]."</p><hr /><hr />";
			}
			
			$this->close_connection();
		}
		
		function get_total_notifications($current_user_id) {
			$this->open_connection();
			
			$select_statement1 = $this->dbh->prepare("SELECT COUNT(sharer) FROM likes WHERE sharer = ?;");
			$select_statement1->bindParam(1, $current_user_id);
			$select_statement1->execute();
			
			$total_likes = $select_statement1->fetch();
			
			$select_statement2 = $this->dbh->prepare("SELECT COUNT(sharer) FROM saves WHERE sharer = ?;");
			$select_statement2->bindParam(1, $current_user_id);
			$select_statement2->execute();
			
			$total_saves = $select_statement2->fetch();
			
			$total_notifications = $total_likes[0] + $total_saves[0];
			
			$data_array = array("total_likes"=>$total_likes[0], "total_saves"=>$total_saves[0], "total_notifications"=>$total_notifications);
			$encoded_array = json_encode($data_array);
			
			echo $encoded_array; 
			
			$this->close_connection();
		}
		
		
		
	}
	
?>
