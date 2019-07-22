document.getElementById('login').addEventListener("submit", login);

function login()
{
	event.preventDefault();
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var token = document.getElementById('token').value;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			var response = this.responseText;
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
	};
	xhttp.open("POST", "ajax_login.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("username="+username+"&password="+password+"&token="+token);
}

