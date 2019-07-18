//document.getElementById("login").addEventListener("submit", validate_login);
document.getElementById("registration").addEventListener("submit", validate_registration);
document.getElementById("fname").addEventListener("blur", validate_fname);
document.getElementById("lname").addEventListener("blur", validate_lname);
document.getElementById("email").addEventListener("blur", validate_email);
document.getElementById("username").addEventListener("blur", validate_username);
document.getElementById("password").addEventListener("blur", validate_password);
document.getElementById("password").addEventListener("click", password_info);

function validate_login(obj)
{
	var username = document.forms.login.username.value.trim();
	var password = document.forms.login.password.value.trim();
	if(username === "")
	{
		document.getElementById('username').style.borderColor = "red";
	}
	if(password === "")
	{
		document.getElementById('password').style.borderColor = "red";
	}
	if(username === "" || password === "")
	{
		document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>Please fill in the highlighted fields</div>";
		obj.preventDefault();
	}
}

function validate_registration(obj)
{
	var fname = document.forms.registration.fname.value.trim();
	var lname = document.forms.registration.lname.value.trim();
	var email = document.forms.registration.email.value.trim();
	var username = document.forms.registration.username.value.trim();
	var password = document.forms.registration.password.value.trim();
	var user_type = document.forms.registration.user_type.value.trim();

	if(fname === "")
	{
		document.getElementById('fname').style.borderColor = "red";
	}
	if(lname === "")
	{
		document.getElementById('lname').style.borderColor = "red";
	}
	if(email === "")
	{
		document.getElementById('email').style.borderColor = "red";
	}
	if(username === "")
	{
		document.getElementById('username').style.borderColor = "red";
	}
	if(password === "")
	{
		document.getElementById('password').style.borderColor = "red";
	}
	if(user_type === "")
	{
		document.getElementById('user_type').style.borderColor = "red";
	}
	if(fname === "" || lname === "" || username === "" || password === "" || user_type === "")
	{
		document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>Please fill in the highlighted fields</div>";
		obj.preventDefault();
	}
}

function validate_fname()
{
	var obj = document.forms.registration.fname;
	var name_pattern = /^([a-zA-Z]+)$/;
	if(obj.value === "")
	{
		document.getElementById('fname').style.borderColor = "grey";
		document.getElementById("alert").innerHTML = "";
	}
	else if(!name_pattern.test(obj.value))
	{
		document.getElementById('fname').style.borderColor = "red";
		document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>Invalid first name</div>";
	}
	else
	{
		document.getElementById('fname').style.borderColor = "green";
		document.getElementById("alert").innerHTML = "";
	}
}

function validate_lname()
{
	var obj = document.forms.registration.lname;
	var name_pattern = /^([a-zA-Z]+)$/;
	if(obj.value === "")
	{
		document.getElementById('lname').style.borderColor = "grey";
		document.getElementById("alert").innerHTML = "";
	}
	else if(!name_pattern.test(obj.value))
	{
		document.getElementById('lname').style.borderColor = "red";
		document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>Invalid last name</div>";
	}
	else
	{
		document.getElementById('lname').style.borderColor = "green";
		document.getElementById("alert").innerHTML = "";
	}
}

function validate_email()
{
	var obj = document.forms.registration.email;
	var email = obj.value;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var arr = JSON.parse(this.responseText);
			for(var i = 0; i < arr.length; i++)
			{
				if(arr[i] === email)
				{
					document.getElementById('email').style.borderColor = "red";
					document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>This email already exists</div>";
				}
			}
		}
	};
	xhttp.open("GET", "fetch_info.php?q=email", true);
	xhttp.send();

	if(obj.value === "")
	{
		document.getElementById('email').style.borderColor = "grey";
		document.getElementById("alert").innerHTML = "";
	}
	else if(obj.value.indexOf("@") < 0 || obj.value.indexOf(".") < 0)
	{
		document.getElementById('email').style.borderColor = "red";
		document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>Invalid email</div>";
	}
	else
	{
		document.getElementById('email').style.borderColor = "green";
		document.getElementById("alert").innerHTML = "";
	}
}

function validate_username()
{
	var obj = document.forms.registration.username;
	var username_pattern = /^([a-zA-Z0-9@_]+)$/;
	var username = obj.value;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var arr = JSON.parse(this.responseText);
			for(var i = 0; i < arr.length; i++)
			{
				if(arr[i] === username)
				{
					document.getElementById('username').style.borderColor = "red";
					document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>This username already exists</div>";
				}
			}
		}
	};
	xhttp.open("GET", "fetch_info.php?q=username", true);
	xhttp.send();

	if(obj.value === "")
	{
		document.getElementById('username').style.borderColor = "grey";
		document.getElementById("alert").innerHTML = "";
	}
	else if(!username_pattern.test(obj.value))
	{
		document.getElementById('username').style.borderColor = "red";
		document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>Invalid username</div>";
	}
	else
	{
		document.getElementById('username').style.borderColor = "green";
		document.getElementById("alert").innerHTML = "";
	}
}

function validate_password()
{
	var obj = document.forms.registration.password;
	var password_pattern = /^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/;
	if(obj.value === "")
	{
		document.getElementById('password').style.borderColor = "grey";
		document.getElementById("alert").innerHTML = "";
	}
	else if(!password_pattern.test(obj.value))
	{
		document.getElementById('password').style.borderColor = "red";
		document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>Invalid password</div>";
	}
	else
	{
		document.getElementById('password').style.borderColor = "green";
		document.getElementById("alert").innerHTML = "";
	}
}

function password_info()
{
	var msg = "The password :\nMust be a minimum of 8 characters\nMust contain at least 1 number\nMust contain at least one uppercase character\nMust contain at least one lowercase character";
	document.getElementById("alert").innerHTML = "<div class='alert alert-info'>"+msg+"</div>";
}