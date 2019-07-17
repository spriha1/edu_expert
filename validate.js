function validate_login(obj)
{
	var username = obj.username.value.trim();
	var password = obj.password.value.trim();
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
		return false;
	}
	return true;
}


function validate_registration(obj)
{
	var fname = obj.fname.value.trim();
	var lname = obj.lname.value.trim();
	var email = obj.email.value.trim();
	var username = obj.username.value.trim();
	var password = obj.password.value.trim();
	var user_type = obj.user_type.value.trim();

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
		return false;
	}
	return true;
}

function validate_fname(obj)
{
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

function validate_lname(obj)
{
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

function validate_email(obj)
{
	if(obj.value === "")
	{
		document.getElementById('email').style.borderColor = "grey";
		document.getElementById("alert").innerHTML = "";
	}
	else if(obj.value.indexOf("@") < 1 || obj.value.indexOf(".") < 1)
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

function validate_username(obj)
{
	var username_pattern = /^([a-zA-Z0-9@_]+)$/;
	if(obj.value === "")
	{
		document.getElementById('username').style.borderColor = "grey";
		document.getElementById("alert").innerHTML = "";
	}
	else if(!username_pattern.test(obj.value))
	{
		document.getElementById('email').style.borderColor = "red";
		document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>Invalid username</div>";
	}
	else
	{
		document.getElementById('email').style.borderColor = "green";
		document.getElementById("alert").innerHTML = "";
	}
}

function validate_password(obj)
{
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