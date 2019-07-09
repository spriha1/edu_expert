<?php
	class Validation
	{
		public static function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
		public static function validate_name($name)
		{
			return preg_match("/^([a-zA-Z]+)$/",$name);
		}
		public static function validate_username($name)
		{
			return preg_match("/^([a-zA-Z0-9@_]+)$/",$name);
		}
		public static function validate_email($email)
		{
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}
		public static function validate_password($password)
		{
			return preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/",$password);
		}
	}
?>