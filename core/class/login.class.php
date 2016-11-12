<?php 

class login{
	
	private $token;
	
	public function __construct(){
		session_start();
		$token = md5(bin2hex(openssl_random_pseudo_bytes(5)));
	}
	
}

?>