<?php
	/**
	 * 
	 * check csrf token
	 */

	require 'bookmark.const.php';
	
	function gen_token(){
		$hash = md5(uniqid(rand(), true));
		$n = rand(1, 24);
		$token = substr($hash, $n, 8);
		return $token;
	}
	
	function gen_csrf_token(){
		$token = gen_token();
		$_SESSION[TOKEN_NAME] = $token;
		echo "<input type=\"hidden\" name=\"".TOKEN_NAME."\" value=\"".$token."\">";
	}
	
	function check_token(){
		$token = $_REQUEST[TOKEN_NAME];
		if(empty($token) || empty($_SESSION[TOKEN_NAME])){
			destroy_stoken();
			return false;
		}
		if($token!=$_SESSION[TOKEN_NAME]){
			destroy_stoken();
			return false;
		}
		
		destroy_stoken();
		return true;
	}
	
	function destroy_stoken(){
		$_SESSION[TOKEN_NAME] = "";
	}
	
?>