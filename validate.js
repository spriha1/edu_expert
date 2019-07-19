document.body.addEventListener("blur", validate_fields, true);
document.body.addEventListener("submit", validate_forms, true);
document.body.addEventListener("click", display_info, true);

function validate_forms(obj)
{
	if(event.target.id === 'login')
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
	if(event.target.id === 'registration')
	{
		var i,check,c = 0;
		var length = document.getElementById("registration").elements.length;
		for(i = 0 ; i < length-1 ; i++)
		{
			check = document.getElementById("registration").elements[i].value.trim();
			if (check === "") 
			{
				document.getElementById("registration").elements[i].style.borderColor = "red";
				c++;
			}
		}
		if(c > 0)
		{
			document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>Please fill in the highlighted fields</div>";
			obj.preventDefault();
		}
	}
}

function validate_fields()
{
	if (event.target.id === 'username') 
	{
		var obj = document.forms.registration.username;
		var username_pattern = /^([a-zA-Z0-9@_]+)$/;
		var username = obj.value;

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(Number(this.responseText) === 1)
				{
					document.getElementById('username').style.borderColor = "red";
					document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>This username already exists</div>";
				}
				
			}
		};
		xhttp.open("GET", "fetch_info.php?q1=username&q2="+username, true);
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
	else if (event.target.id === 'password') 
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
	else if(event.target.id ==="email")
	{
		var obj = document.forms.registration.email;
		var email = obj.value;

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) 
			{
				if(Number(this.responseText) === 1)
				{
					document.getElementById('email').style.borderColor = "red";
					document.getElementById("alert").innerHTML = "<div class='alert alert-danger'>This email already exists</div>";
				}
				
			}
		};
		xhttp.open("GET", "fetch_info.php?q1=email&q2="+email, true);
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
	else if(event.target.id === 'fname')
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
	else if(event.target.id === 'lname')
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
	
	
}

function display_info()
{
	if(event.target.id === 'password' && event.target.parentElement.id === 'registration')
	{
		var msg = "The password :<br> Must be a minimum of 8 characters<br>Must contain at least 1 number<br>Must contain at least one uppercase character<br>Must contain at least one lowercase character";
		document.getElementById("alert").innerHTML = "<div class='alert alert-info'>"+msg+"</div>";
	}
	if(event.target.id === 'username' && event.target.parentElement.id === 'registration')
	{
		var msg = "The username can contain letters, digits, @ and _";
		document.getElementById("alert").innerHTML = "<div class='alert alert-info'>"+msg+"</div>";
	}
}
