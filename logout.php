<?php
	/**
	 * 退出登录页
	 */
	session_start();
	
	$nick = $_SESSION['nick'];
	$_SESSION = array();
	
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()-42000,'/');
	}
	
	session_destroy();
?>


<html>
	<head><title>用户注销</title></head>
	<body>
		<?php echo $nick?>，再见
		<a href="login.php">重新登录</a>
	</body>
</html>