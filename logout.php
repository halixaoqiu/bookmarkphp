<?php
	/**
	 * 退出登录页
	 */
	session_start();
	
	if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
	}else{
		header("location:login.php");
		exit;
	}
	
	$nick = $_SESSION['nick'];
	$_SESSION = array();
	
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()-42000,'/');
	}
	
	session_destroy();
?>


<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>用户注销</title>
	</head>
	<body>
		<?php echo $nick ?>，再见
		<a href="login.php">重新登录</a>
	</body>
</html>