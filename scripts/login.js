$(document).ready(function() {
	$("#login").submit(function() {
		event.preventDefault();
		$.post('ajax_login.php', $('#login').serialize(), function(result) {
			var response = JSON.parse(result)["msg"];
			var newToken = JSON.parse(result)["token"];
			$('#token').val(newToken);
			console.log(newToken);
			if (response === "Admin") {
				window.location.href = 'admin_dashboard.php';
			}
			else if (response === "Student") {
				window.location.href = 'student_dashboard.php';
			}
			else if (response === "Teacher") {
				window.location.href = 'teacher_dashboard.php';
			}
			else {
				$('#alert').text(response);
				$("#alert").css("display" , "block");
			}
		})
	});
})



