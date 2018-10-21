$(document).ready(function(){
	
	$("#submit_button").click(function(){
		
		var firstname = $("#firstname").val();
		var middlename = $("#middlename").val();
		var lastname = $("#lastname").val();
		var gender = $("#gender").val();
		var age = $("#age").val();
		var new_username = $("#new_username").val();
		var new_password = $("#new_password").val();
		var retyped_password = $("#retyped_password").val();
		
		var string_pattern = /^[A-Z, a-z]*$/;
		var integer_pattern = /^[0-9]*$/;
		
		var firstname_valid = string_pattern.test(firstname);
		var middlename_valid = string_pattern.test(middlename);
		var lastname_valid = string_pattern.test(lastname);
		var new_username_valid = string_pattern.test(new_username);
		var age_valid = integer_pattern.test(age);
	
		if(firstname != "" && firstname_valid && middlename != "" && middlename_valid && lastname != "" && lastname_valid && age != "" && age_valid && new_username != "" && new_username_valid && new_password != "" && retyped_password != ""){
			if(new_password == retyped_password) {
				$.ajax({
					type: "POST",
					url: "PHP/USERS/add_user.php",
					data: {data: JSON.stringify($("#registration_form").serializeArray())},
					success: function(data){
						$("#registration_div").dialog("close");
						$("#registered_user_span").html($("input[name = 'new_username']").val());
						$("#registration_finished").dialog({
							show: "puff",
							hide: "explode",
							height: 250,
							width: 550,
							modal: true,
							buttons: {
								"OKAY": function(){
									$(this).dialog("close");
								}
							}
						});
					},
					error: function(data) {
						alert("error in adding user! = " + data);
					}
				});
			}else{
				$("#password_mismatched").fadeIn(200);
				$("#password_mismatched").fadeOut(5000);
			}
		}else {
			$("#invalid_information").fadeIn(200);
			$("#invalid_information").fadeOut(5000);
		}
	});
})

