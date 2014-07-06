<?php
	/**
	 * 判断是否登录，没登录跳转到登录页
	 */
	session_start();
	if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin']!=1){
		header("location:login.php");
		exit;
	}
?>
