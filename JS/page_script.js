$(document).ready(function(){

	$("#registration_div").hide();
	$("#registration_finished").hide();
	$("#password_mismatched").hide();
	$("#invalid_information").hide();
	$("#save_button").hide();
	$("#users_div").hide();
	$("#share_confirmed").hide();
	$("#share_confirmation_div").hide();
	$("#empty_phonebook_field").hide();
	$("#noti_div").hide();
	$("#likes_notifications").hide();
	$("#saves_notifications").hide();
	$("#options1").hide();
	$("#delete_confirmation").hide();
	

	$("#registration_button").click(function(){
		$("#registration_div").slideDown(200);
	});
	
	$("#add_entry_div").wrapInner("<div class = 'wrap'>");
	$("h1").wrapInner("<div class = 'background'>");
	
	$("#entries_table").find("tr").hover(function(){
		$(this).css("background", "white");
		$(this).mouseout(function(){
			$(this).css("background", "gray");
		});
	});
	
	$("#noti_list").click(function(){
		$("#noti_div").show();
		$("#noti_div").mouseleave(function(){
			$(this).fadeOut(200);
		});
	});
	
	$("#select_likes").click(function(){
		$("#likes_notifications").dialog({
			show: "fadeIn",
			hide: "fadeOut",
			width: 900,
			modal: true,
			buttons: {
				"CLOSE": function(){
					$(this).dialog("close");
				}
			}
		});
	});
	
	$("#select_saves").click(function(){
		$("#saves_notifications").dialog({
			show: "fadeIn",
			hide: "fadeOut",
			width: 900,
			modal: true,
			buttons: {
				"CLOSE": function(){
					$(this).dialog("close");
				}
			}
		});
	});
	
	$("#options").mouseenter(function() {
		$("#options1").fadeIn(300);
	});
	
	$("#options1").mouseleave(function() {
		$("#options1").fadeOut(100);
	});
	
	$("#registration_link").click(function(){
		$("#registration_div").dialog({
			show: "drop",
			hide: "fold",
			modal: true,
			height: 500,
			width: 500
		});
	});
	
	
});
