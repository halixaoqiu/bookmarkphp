<?php
	/**
	 * 退出登录页
	 */
	require '/control/islogin.php';
	
	//常量定义
	$page_title = "柠檬收藏-用户注销";
	
	$nick = $_SESSION['nick'];
	
	//清除session
	$_SESSION = array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()-42000,'/');
	}
	session_destroy();
	
	//跳转到登录页
	header("location:guest.php");
	exit;
?>
