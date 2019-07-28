$(document).ready(function() {
	$("#login").submit(function() {
		event.preventDefault();
		var username = document.getElementById('username').value;
		var password = document.getElementById('password').value;
		var token = document.getElementById('token').value;
		$.ajax({
			url: 'ajax_login.php',
			type: 'POST',
			data: {username: username , password: password , token: token},
			success: function(result){
				var response = JSON.parse(result)["msg"];
				var newToken = JSON.parse(result)["token"];
				document.getElementById('token').value = newToken;
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
					document.getElementById('alert').innerHTML = response;
					document.getElementById("alert").style.display = "block";
				}
			}
		})
	});
})


// document.getElementById('login').addEventListener("submit", login);

// function login() {
// 	event.preventDefault();
// 	var username = document.getElementById('username').value;
// 	var password = document.getElementById('password').value;
// 	var token = document.getElementById('token').value;
// 	console.log(token)
// 	var xhttp = new XMLHttpRequest();
// 	xhttp.onreadystatechange = function() {
// 		if (this.readyState == 4 && this.status == 200) {
// 			var response = JSON.parse(this.responseText)["msg"];
// 			var newToken = JSON.parse(this.responseText)["token"];
// 			document.getElementById('token').value = newToken;
// 			console.log(newToken);
// 			if (response === "Admin") {
// 				window.location.href = 'admin_dashboard.php';
// 			}
// 			else if (response === "Student") {
// 				window.location.href = 'student_dashboard.php';
// 			}
// 			else if (response === "Teacher") {
// 				window.location.href = 'teacher_dashboard.php';
// 			}
// 			else {
// 				document.getElementById('alert').innerHTML = response;
// 				document.getElementById("alert").style.display = "block";
// 			}
// 		}
// 	};
// 	xhttp.open("POST", "ajax_login.php", true);
// 	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 	xhttp.send("username="+username+"&password="+password+"&token="+token);
// }

