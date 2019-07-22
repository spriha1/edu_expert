<?php 
	class Token
	{
		public static function generate()
		{
			return $_SESSION['token'] = base64_encode(uniqid());
		}
		public static function check($token)
		{
			//print_r($_SESSION['token']);
			if (isset($_SESSION['token']) && $token === $_SESSION['token']) {
				//unset($_SESSION['token']);
				return true;
			}
			return false;
		}
	}
?>