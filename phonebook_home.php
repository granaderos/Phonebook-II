<?php
	session_start();
	
	if(!isset($_SESSION['username_entered'])){
		header("Location: phonebook_log_in.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8" />
		<meta http-equiv=”refresh” content=”5; URL=phonebook_home.php”>
		<title>PHONEBOOK HOME</title>
		<script src = "JS/jquery-1.8.2.min.js"></script>
		<script src = "JS/jquery-ui-1.9.0.custom.min.js"></script>
		<link rel = "stylesheet" href = "CSS/jquery-ui-1.9.0.custom.min.css" />
		<link rel = "stylesheet" href = "CSS/page_style.css" />
		<script src = "JS/page_script.js"></script>
		<script src = "JS/phonebook3.js"></script>

	</head>
	<body onload=”javascript:setTimeout(“location.reload(true);”,5000);”>
		<h1>YOUR &#0222;h&#0214;neb&#0212;&#0216;k Ap&#0254;.</h1>
		<p id = "p_user">Hi <span id = "username"></span>!</p>
		
		<div id = "menu_div">
			<ul>
				<li id = "log_out"><a href = "phonebook_log_out.php">&laquo;log out&raquo;</a></li>
				<li id = "select_friends"><a href = "#friends_div"><input type = "button" id = "friends_button"/>&laquo;friends&raquo;</a></li>
				<li id = "noti_list"><input type = "button" id = "notifications"/>&laquo;notifications&raquo;</li>
				<li id = "select_contacts"><a href = "#view_entries_div"><input type = "button" id = "number_of_contacts" />&laquo;phonebook entries&raquo;</a></li>
			</ul>
		</div><!**********menu_div-->
					<div id = "noti_div">
						<ul id = "noti_ul">
							<li id = "select_likes"><input type = "button" id = "total_likes" />LIKES</li>
							<li id = "select_saves"><input type = "button" id = "total_saves" />SAVES</li>
						</ul>
					</div><!******noti_div>
		<div id = "search_people_div">
			search:&nbsp;<input type = text id = "search_people_field" placeholder = "find friends">
			<table id = "search_people_table" class = "background"></table>
		</div><!******************search people div><br />
		<div id = "shared_contacts_div">
			<img src = "CSS/images/updates.gif" />
		</div><!*******************shared_div><br />
		<!--
		<div id = "search_div">
			<input type = "search" id = "search_field" name = "name_to_search" placeholder = "enter name to search" /><button id = "search_button">search</button>
		</div>
		-->
		<div id = "phonebook_area">
			<span id = "options">options</span>
			<div id = "options1">
				<ul>
					<li id = "log_out"><a href = "phonebook_log_out.php">&laquo;log out&raquo;</a></li>
					<li id = "select_friends"><a href = "#friends_div">&laquo;friends&raquo;</a></li>
					<li id = "select_updates"><a href = "#shared_contacts_div">&laquo;updates&raquo;</a></li>
					<li id = "noti_list"><a href = "#menu_div">&laquo;notifications&raquo;</a></li>
					
				</ul>
			</div><!**********menu_div-->
			<div id = "add_entry_div">
				<form id = "add_entry_form">
					<input type = "text" name = "names"  id = "names" placeholder = "name"/>
					<input type = "text" name = "contact_number" id = "contact_number" placeholder = "contact number"/>
					<input type = "hidden" name = "id" id = "id"  />
					<input type = "hidden" name = "current_user" id = "current_user"/>
					<input type = "hidden" name = "current_user_id" id = "current_user_id" />
					<input type = "hidden" name = "friend_id" id = "friend_id" />
					<input type = "hidden" name = "shared_contact_id" id = "shared_contact_id" />
					<input type = "hidden" name = "current_time" id = "current_time">
				</form>
				<p id = "empty_phonebook_field">Please check what you have entered/fill up the required info.</p>
				<button id = "add_button">add</button>
				<button id = "save_button">save</button>
				
			</div><!--add entry div ends-->
			<div id = "view_entries_div">
				<table id = "entries_table" border = "1">
					<caption><img src = "CSS/images/phonebook_entries.gif" /></caption>
				</table>
			</div><!*******************view entries div>
			<div id = "delete_confirmation" title = "DELETE CONFIRMATION">
				Are you sure to delete this phonebook entry?
			</div><!****delete confirmation>
		</div> <!***********phonebook_area******><br />
		<div id = "friends_div">
			<img src = "CSS/images/friends.gif" />
			<div id = "friend_div">
			</div>
		</div><!***************friends div>
		<div id = "share_confirmation_div" title = "Sharing Your Contacts">
			Share this phonebook entry to your friend?
		</div>
		<div id = "share_confirmed" title = "Sharing confirmation">
			Your selected contact was successfully shared to your friend.
		</div><!*******************friend_confirmation>
		<div id = "select_friend_div" title = "SELECT FRIEND:">
			<table id = "select_friend_table">
			</table>
		</div><!****select friends div><br />
		<div id = "likes_notifications" title = "LIKES NOTIFICATIONS">
		</div><!********likes_notifications div*****>
		<div id = "saves_notifications" title = "SAVES NOTIFICATIONS">
		</div><!****saves notifications div>
					</td>
				</tr>
			</table>
		</div><!******notifications div ********>
	</body>
</html>
