<?php 
	class Token
	{
		public $token;
		public static function generate()
		{
			return $this->token = base64_encode(uniqid());
		}
		public static function check($token)
		{
			if($token === $this->token)
			{
				return true;
			}
			return false;
		}
	}
?>