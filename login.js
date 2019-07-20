document.getElementById('login').addEventListener("submit", login);

function login()
{
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var token = document.getElementById('token').value;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var response = this.responseText;
				console.log(this.responseText);

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
				document.getElementById('alert').innerHTML = "<div class='alert alert-danger'>"+response+"</div>";
			}
		}
	};
	xhttp.open("POST", "ajax_login.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("username="+username+"&password="+password+"&token="+token);
}

