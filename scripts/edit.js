document.getElementById('registration').addEventListener("submit", edit);
document.body.addEventListener("blur", validate_fields, true);
document.body.addEventListener("click", display_info, true);

function edit() {
	event.preventDefault();
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var email = document.getElementById('email').value;
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var token = document.getElementById('token').value;
	console.log(token);

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);

			var response = JSON.parse(this.responseText);
			if (response.email == 1) {
				document.getElementById('alert').innerHTML = "Please verify it by clicking the activation link that has been send to your email.";
				document.getElementById("alert").style.display = "block";
			}
			else if (response.success == 1) {
				document.getElementById('alert').innerHTML = "Updated successfully";
				document.getElementById("alert").style.display = "block";
			}
			else if (response.email == 0) {
				document.getElementById('alert').innerHTML = "Invalid email format";
				document.getElementById("alert").style.display = "block";
			}
			else if (response.username == 0) {
				document.getElementById('alert').innerHTML = "Invalid username format";
				document.getElementById("alert").style.display = "block";
			}
		}
	};
	xhttp.open("POST", "ajax_update_profile.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("fname="+fname+"&lname="+lname+"&email="+email+"&username="+username+"&password="+password+"&token="+token);
}

function validate_fields()
{
	if (event.target.closest("form").getAttribute("id") === 'registration') {
		if (event.target.id === 'username') {
			var obj = document.forms.registration.username;
			var username_pattern = /^([a-zA-Z0-9@_]+)$/;
			var username = obj.value;

			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if (Number(this.responseText) === 1) {
						document.getElementById('username').style.borderColor = "red";
						document.getElementById("alert").innerHTML = "This username already exists";
						document.getElementById("alert").style.display = "block";
					}
					
				}
			};
			xhttp.open("GET", "fetch_info.php?q1=username&q2="+username, true);
			xhttp.send();

			if (obj.value === "") {
				document.getElementById('username').style.borderColor = "rgba(0,0,0,.125)";
				document.getElementById("alert").innerHTML = "";
			}

			else if (!username_pattern.test(obj.value)) {
				document.getElementById('username').style.borderColor = "red";
				document.getElementById("alert").innerHTML = "Invalid username";
				document.getElementById("alert").style.display = "block";
			}

			else {
				document.getElementById('username').style.borderColor = "green";
			}
		}

		else if (event.target.id === 'password') {
			var obj = document.forms.registration.password;
			var password_pattern = /^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/;
			if (obj.value === "") {
				document.getElementById('password').style.borderColor = "rgba(0,0,0,.125)";
			}

			else if (!password_pattern.test(obj.value)) {
				document.getElementById('password').style.borderColor = "red";
				document.getElementById("alert").innerHTML = "Invalid password";
				document.getElementById("alert").style.display = "block";
			}

			else {
				document.getElementById('password').style.borderColor = "green";
			}
		}

		else if (event.target.id ==="email") {
			var obj = document.forms.registration.email;
			var email = obj.value;

			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if (Number(this.responseText) === 1) {
						document.getElementById('email').style.borderColor = "red";
						document.getElementById("alert").innerHTML = "This email already exists";
						document.getElementById("alert").style.display = "block";
					}
					
				}
			};
			xhttp.open("GET", "fetch_info.php?q1=email&q2="+email, true);
			xhttp.send();

			if (obj.value === "") {
				document.getElementById('email').style.borderColor = "rgba(0,0,0,.125)";
			}

			else if (obj.value.indexOf("@") < 0 || obj.value.indexOf(".") < 0) {
				document.getElementById('email').style.borderColor = "red";
				document.getElementById("alert").innerHTML = "Invalid email";
				document.getElementById("alert").style.display = "block";
			}

			else {
				document.getElementById('email').style.borderColor = "green";
			}
		}

		else if (event.target.id === 'fname') {
			var obj = document.forms.registration.fname;
			var name_pattern = /^([a-zA-Z]+)$/;
			if (obj.value === "") {
				document.getElementById('fname').style.borderColor = "rgba(0,0,0,.125)";
			}

			else if (!name_pattern.test(obj.value)) {
				document.getElementById('fname').style.borderColor = "red";
				document.getElementById("alert").innerHTML = "Invalid first name";
				document.getElementById("alert").style.display = "block";
			}

			else {
				document.getElementById('fname').style.borderColor = "green";
			}
		}

		else if (event.target.id === 'lname') {
			var obj = document.forms.registration.lname;
			var name_pattern = /^([a-zA-Z]+)$/;
			if (obj.value === "") {
				document.getElementById('lname').style.borderColor = "rgba(0,0,0,.125)";
			}

			else if (!name_pattern.test(obj.value)) {
				document.getElementById('lname').style.borderColor = "red";
				document.getElementById("alert").innerHTML = "Invalid last name";
				document.getElementById("alert").style.display = "block";
			}

			else {
				document.getElementById('lname').style.borderColor = "green";
			}
		}
	}	
}

function display_info()
{
	if (event.target.id === 'password' && event.target.closest("form").getAttribute("id") === 'registration') {
		var msg = "The password :<br> Must be a minimum of 8 characters<br>Must contain at least 1 number<br>Must contain at least one uppercase character<br>Must contain at least one lowercase character";
		document.getElementById("info").innerHTML = msg;
		document.getElementById("info").style.display = "block";
	}

	if (event.target.id === 'username' && event.target.closest("form").getAttribute("id") === 'registration') {
		var msg = "The username can contain letters, digits, @ and _";
		document.getElementById("info").innerHTML = msg;
		document.getElementById("info").style.display = "block";
	}
}

