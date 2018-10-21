<?php
	include 'PHP/USERS/function_home.php';
	
	$execute = new function_home();
	
	session_start();
	
	if(isset($_SESSION['username_entered'])){
		header('Location: phonebook_home.php');
	} else {
		if(isset($_POST['username_entered']) && isset($_POST['password_entered'])){
			$username_exist = $execute->check_username($_POST['username_entered']);	
			if($username_exist){
				$password_matched = $execute->check_password($_POST['username_entered'], $_POST['password_entered']);
				if($password_matched){
					$_SESSION['username_entered'] = $_POST['username_entered'];
					header('Location: phonebook_home.php');
					$execute->add_logged_in_users($_POST['username_entered']);
				}else{
					$error_message =  "Invalid PASSWORD";
				}
			}else{
					$error_message =  "Unknown USERNAME";
			}
		}
	}
?>
