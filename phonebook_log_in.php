<?php
	include 'log_in_validation.php';
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "UTF-8" />
		<title>PHONEBOOK LOG-IN</title>
		<script src = "JS/jquery-1.8.2.min.js"></script>
		<script src = "JS/jquery-ui-1.9.0.custom.min.js"></script>
		<script src = "JS/page_script.js"></script>
		<script src = "JS/log_in_script.js"></script>
		<link rel = "stylesheet" href = "CSS/jquery-ui-1.9.0.custom.min.css" />
		<link rel = "stylesheet" href = "CSS/log_in_page.css" />
	</head>
	<body>
		<img src = "CSS/images/welcome.gif" id = "welcome"/>
		<h1>YOUR &#0222;h&#0214;neb&#0212;&#0216;k Ap&#0254;.</h1>
		<div id = "log_in_div">
			<form action = "phonebook_log_in.php" method = "POST">
				username: <input type = "text" name = "username_entered" id = "username" />
				password: <input type = "password" name = "password_entered" id = "password"><input type = "submit" value = "log in" id = "log_in_button">
			</form>
			<?php
				if(isset($error_message)){
					echo "<p id = 'error_message'>".$error_message."</p>";
				}
			?>
			<p id = "account_p">Doesn't have an ACCOUNT?&nbsp;<a href = "#" id = "registration_link">&raquo;Click here to REGISTER&laquo;</a></p>
		</div>
		
		<div id = "registration_div" title = "REGISTRATION FORM">
			<form id = "registration_form">
				<table>
					<tr>
						<td>firstname:</td><td><input type = "text" name = "firstname" id = "firstname" ></td>
					</tr>
					<tr>
						<td>middlename:</td><td><input type = "text" name = "middlename" id = "middlename"></td>
					</tr>
					<tr>
						<td>lastname:</td><td><input type = "text" name = "lastname" id = "lastname"></td>
					</tr>
					<tr>
						<td>gender:</td><td><select name = "gender" id = "gender" ><option>female</option><option>male</option></select></td>
					</tr>
					<tr>
						<td>age:</td><td><input type = "number" name = "age" id = "age"></td>
					</tr>
					<hr />
					<tr>
						<td>username:</td><td><input type = "text" name = "new_username" id = "new_username"></td>
					</tr>
					<tr>
						<td>password:</td><td><input type = "password" name = "new_password" id = "new_password"></td>
					</tr>
					<tr>
						<td>retype password:</td><td><input type = "password" name = "retyped_password" id = "retyped_password"></td>
					</tr>
				</table>
				<input type = "reset" value = reset />
			</form>
			<p id = "password_mismatched">Password didn't matched! Please try again.</p>
			<p id = "invalid_information">Please check and fill up the required information. Thank you!</p>
			<br />
			<br />
			<button id = "submit_button">submit</button>
		</div><!--#registration_div-->
		<div id = "registration_finished" title = "CONFIRMATION">Congratulations! You're already registered to YOUR &#0222;h&#0214;neb&#0212;&#0216;k Ap&#0254;. You may now log in as <span id = "registered_user_span"></span>.
		</div>
	
		
	</body>
</html>
