<?php
	
	session_start();
	
	include "USERS/function_home.php";
	
	$data = $_POST['data'];
	$decoded_data = json_decode($data, true);
	
	foreach($decoded_data as $value){
		$$value['name'] = $value['value'];
	}
	
	$execute_add = new function_home();
	$execute_add->add_phonebook_entry($names, $contact_number, $current_user);
?>
