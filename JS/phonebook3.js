$(document).ready(function(){
	
	$.ajax({
		url: "PHP/USERS/determine_current_user.php",
		success: function(data) {
			var parsed_data = JSON.parse(data);
			$("#current_user").val(parsed_data.current_user);
			$("#current_user_id").val(parsed_data.current_user_id);
			$("#username").html(parsed_data.current_user_fullname);
			display_shared_contacts();
			display_friends();
			display_likes();
			display_saves();
			get_total_friends();
			get_total_phonebook_entries();
			get_total_notifications();
		},
		error: function(data) {
			alert("error in determining the current user = " + data);
		}
	}).done(function(){
		$.ajax({
			type: "POST",
			url: "PHP/display_entries.php",
			data: {"current_user": $("input[name = 'current_user']").val()},
			success: function(data) {
				$("#entries_table").append(data);
			},
			error: function(data) {
				alert("error in displaying entries = " + data);
			}
		});
	});
	
	$("#add_button").click(function(){
		var names_pattern = /^[A-Z, a-z]*$/;
		var contact_number_pattern = /^[0-9]*$/;
		
		var name_entered = $("#names").val();
		var contact_number_entered = $("#contact_number").val();
		
		var name_valid = names_pattern.test(name_entered);
		var contact_number_valid = contact_number_pattern.test(contact_number_entered);
		
		
		if(name_entered != "" && contact_number_entered != "" && name_valid && contact_number_valid) {
			
			$.ajax({
				type: "POST",
				url: "PHP/add_phonebook_entry.php",
				data: {data: JSON.stringify($("#add_entry_form").serializeArray())},
				success: function(data) {
					$("#entries_table").append(data);
					get_total_phonebook_entries();
				},
				error: function(data) {
					alert("error in adding entry = " + data);
				}
			});
		} else {
			$("#empty_phonebook_field").show();
			$("#empty_phonebook_field").fadeOut(4000);
		}
		
	});
	
	$("#save_button").click(function(){
		$(this).hide();
		$("#add_button").show();
		
		$.ajax({
			type: "POST",
			url: "PHP/edit_phonebook_entry.php",
			data: {"id": $("#id").val(), "names": $("#names").val(), "contact_number": $("#contact_number").val()},
			success: function(data) {
				var id = $("#id").val();
				document.getElementById(id).innerHTML = data;
			},
			error: function() {
				alert("error in saving = " + data);
			}
		});
	});
	
	$("#search_people_field").keyup(function(){
		if($("#search_people_field").val() == "") {
			$("#search_people_table").html("");
		}else {
		
			$.ajax({
				type: "POST",
				url: "PHP/USERS/search_people.php",
				data: {"search_people_field": $("#search_people_field").val(), "current_user_id": $("#current_user_id").val()},
				success: function(data){
					$("#search_people_table").html(data);
					$("#search_people_div").mouseleave(function(){
						$("#search_people_table").html("");
					});
				},
				error: function(data) {
					alert("error in searching people = " + data);
				}
			});
		}
	});
	
	$("#friends_button").click(function(){
		$("#friends_div").show();
	});

});

function share(id){
	$("#share_confirmation_div").dialog({
		show: "slideDown",
		hide: "slideUp",
		modal: true,
		buttons: {
			"YES": function() {
					var time = new Date();
	            var hour = time.getHours();
	            var minutes = time.getMinutes();
	            var extension = "AM";
	
	            if(minutes < 10) {
	               minutes = "0" + minutes;
	            }
	
	            if(hour >= 12) {
	               extension = "PM";
	               hour = hour - 12;
	            }
	
	            if(hour == 0) {
	               hour = 12;
	            }

	            var month = time.getMonth();
	            var date = time.getDate();
	            var year = time.getFullYear()
	
	            var shared_time = month + 1 + "-" + date + "-" + year + " " + hour + ":" + minutes + " " + extension;
	
				$("#current_time").val(shared_time);
				
				$.ajax({
					type: "POST",
					url: "PHP/USERS/select_friend.php",
					data: {"current_user_id": $("#current_user_id").val()},
					success: function(data) {
						$("#shared_contact_id").val(id);
						$("#select_friend_table").html(data);
						$("#select_friend_div").dialog({
							show: "slideDown",
							hide: "slideUp",
							modal: true,
							width: 900,
							buttons: {
								"DONE": function() {
									$(this).dialog("close");
								}
							}
						});
					},
					error: function(data) {
						alert("error in selecting friends = " + JSON.stringify(data));
					}
				});
				
				
				$(this).dialog("close");
			},
			"NO": function() {
				$(this).dialog("close");
			},
			"CANCEL": function() {
				$(this).dialog("close");
			}
		}
	})
}

function share_share(friend_id) {
	$.ajax({
		type: "POST",
		url: "PHP/add_shared_phonebook_entries.php",
		data: {"current_user_id": $("#current_user_id").val(), "shared_contact_id": $("#shared_contact_id").val(), "friend_id": friend_id, "shared_time": $("#current_time").val()},
		success: function(data) {
		},
		error: function(data) {
			alert("error in adding shared contacts = " + data);
		}
	}).done(function(){
		$("#share_confirmation_div").dialog("close");
			$("#share_confirmed").dialog({
				show: "drop",
				hide: "explode",
				modal: true,
				buttons: {
					"OKAY": function() {
						$(this).dialog("close");
					}
				}
			});
	});
}

function display_friends() {
	
	$.ajax({
		type: "POST",
		url: "PHP/USERS/display_friends.php",
		data: {"current_user_id": $("#current_user_id").val()},
		success: function(data) {
			document.getElementById("friend_div").innerHTML = data;
			
		},
		error: function(data) {
			alert("error in displaying your friends = " + data);
		}
	});
}

function add_friends(friend_id) {
	
	$.ajax({
		type: "POST",
		url: "PHP/USERS/add_friends.php",
		data: {"current_user_id": $("#current_user_id").val(), "friend_id": friend_id},
		success: function(data) {
			$("#friend_confirmation").html(data);
			$("#friend_confirmation").show();
			$("#friend_confirmation").fadeOut(5000);
			//$(document.getELementById('button_' + friend_id)).att('id', 'friends_already');
			$("#friends_already").val("friends");
			$(document.getElementById('button_' + friend_id)).val("friends");
			$(document.getElementById('button_' + friend_id)).attr("id", "friends");
			display_friends();
			get_total_friends();
		},
		error: function(data) {
			alert("error in adding friends = " + data);
		}
	});
}

function get_total_friends() {
	$.ajax({
		type: "POST",
		url: "PHP/USERS/get_total_friends.php",
		data: {"current_user_id": $("#current_user_id").val()},
		success: function(data) {
			$(document.getElementById('friends_button')).val(data);
		},
		error: function(data) {
			alert("error in getting the total friends = " + data);
		}
	});
}

function get_total_phonebook_entries() {
	$.ajax({
		type: "POST",
		url: "PHP/get_total_phonebook_entries.php",
		data: {"current_user_id": $("#current_user_id").val()},
		success: function(data) {
			$("#number_of_contacts").val(data);
		},
		error: function(data) {
			alert("error in getting total phonebook_entries = " + JSON.stringify(data));
		}
	});
}

function display_shared_contacts() {
	$.ajax({
		type: "POST",
		url: "PHP/display_shared_contacts.php",
		data: {"current_user_id": $("#current_user_id").val()},
		success: function(data) {     
		   $("#shared_contacts_div").append(data);
		},
		error: function(data) {
			alert("error in displaying shared_contacts = " + JSON.stringify(data));
		} 
	});
}

function like(id) {
	
	var time = new Date();
	var hour = time.getHours();
	var minutes = time.getMinutes();
	var extension = "AM";
	
	if(minutes < 10) {
	   minutes = "0" + minutes;
	}
	
	if(hour >= 12) {
	   extension = "PM";
	   hour = hour - 12;
	}
	
	if(hour == 0) {
	   hour = 12;
	}

	var month = time.getMonth();
	var date = time.getDate();
	var year = time.getFullYear()
	
	var shared_time = month+1 + "-" + date + "-" + year + " " + hour + ":" + minutes + " " + extension;
	
	$("#current_time").val(shared_time);
	
	$.ajax({
		type: "POST",
		url: "PHP/USERS/add_like_notification.php",
		data: {"current_user_id": $("#current_user_id").val(), "liked_time": $("#current_time").val(), "id": id},
		success: function(data) {
			$(document.getElementById('like_' + id)).val("you like this");
			get_total_notifications();
		},
		error: function(data) {
			alert("error in liking = " + data);
		}
	});
}

function display_likes() {
	$.ajax({
		type: "POST",
		url: "PHP/USERS/display_likes.php",
		data: {"current_user_id": $("#current_user_id").val()},
		success: function(data) {
			$("#likes_notifications").html(data);
		},
		error: function (data) {
			alert("error in displaying likes = " + JSON.stringify(data));
		}
	});
}

function save_shared(id) {
   var time = new Date();
   var month = time.getMonth;
   var date = time.getDate;
   var year = time.getFullYear(); 
   var hour = time.getHours();
   var minutes = time.getMinutes;
   var extension = "AM";
   
   if(minutes < 10) {
      minutes = "0" + minutes;
   }
   
   if(hour >= 12) {
      hour = hour - 12;
      extension = "PM";
   }
   
   if(hour = 0) {
      hour = 12;
   }
   
   var current_time = month + 1 + "-" + date + "-" + year + " " + hour + ":" + minutes + " " + extension;
   
   $("#current_time").val(current_time);
   
	$.ajax({
		type: "POST",
		url: "PHP/USERS/add_saved_shared.php",
		data: {"current_user_id": $("#current_user_id").val(), "id": id, "saved_time": $("#current_time").val()},
		success: function(data) {
			$("#entries_table").append(data);
			
			$.ajax({
				type: "POST",
				url: "PHP/get_total_phonebook_entries.php",
				data: {"current_user_id": $("#current_user_id").val()},
				success: function(data) {
					$("#number_of_contacts").val(data);
					$(document.getElementById('save_' + id)).val("you saved this");
					display_saves();
					get_total_notifications();
				},
				error: function(data) {
					alert("error in getting total phonebook_entries = " + JSON.stringify(data));
			}
	});
		},
		error: function(data) {
			alert("error in saving shared = " + JSON.stringify(data));
		}
	});
}

function display_saves() {
	$.ajax({
		type: "POST",
		url: "PHP/USERS/display_saves.php",
		data: {"current_user_id": $("#current_user_id").val()},
		success: function(data) {
			$("#saves_notifications").html(data);
		},
		error: function(data) {
			alert("error in displaying saved shared = " + JSON.stringify(data));
		}
	})
}

function get_total_notifications() {
	$.ajax({
		type: "POST",
		url: "PHP/USERS/get_total_notifications.php",
		data: {"current_user_id": $("#current_user_id").val()},
		success: function(data) {
			var parsed_data = JSON.parse(data);
			$("#notifications").val(parsed_data.total_notifications);
			$("#total_likes").val(parsed_data.total_likes);
			$("#total_saves").val(parsed_data.total_saves);
		},
		error: function(data) {
			alert("error in getting total notification = " + JSON.stringify(data));
		}
	});
}

function set_input_values(id) {
	$("#add_button").hide()
	$("#save_button").show();
	
	$.ajax({
		type: "POST",
		url: "PHP/retrieve_phonebook_entry.php",
		data: {"id": id},
		success: function(data) {
			var parsed_data = JSON.parse(data);
			$("input[name = 'id']").val(parsed_data.contact_id);
			$("input[name = 'names']").val(parsed_data.names);
			$("input[name = 'contact_number']").val(parsed_data.contact_number);
		},
		error: function(data) {
			alert("error in retrieving entry = " + data);
		}
	});
}

function delete_entry(id) {
	$("#delete_confirmation").dialog({
		modal: true,
		show: "bounce",
		hide: "explode",
		buttons: {
			"YES": function() {
				$.ajax({
					type: "POST",
					url: "PHP/delete_phonebook_entry.php",
					data: {"id": id},
					success: function(data) {
						$(document.getElementById(id)).remove();
						get_total_phonebook_entries();
					},
					error: function(data) {
						alert("error in deleting = " + data);
					}
				});
				$(this).dialog("close");
			},
			
			"NO": function() {
				$(this).dialog("close");
			}
		}
	})
	
}
