$(document).ready(function() {
	$("#registration").submit(function() {
		event.preventDefault();
		$.post('ajax_register.php' , $('#registration').serialize() , function(result){
			$('#alert').text(result);
			$("#alert").css("display" , "block");
		})
	});
})


