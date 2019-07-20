document.body.addEventListener("submit", register, true);

function register()
{
	if(event.target.id === 'registration')
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  document.getElementById("demo").innerHTML = this.responseText;
			}
		};
		xhttp.open("POST", "send_verification_mail.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("fname=Henry&lname=Ford");
	}
}