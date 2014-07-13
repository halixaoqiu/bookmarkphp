<?php
	/**
	 * 退出登录页
	 */
	require '/control/islogin.php';
	
	//常量定义
	$page_title = "草莓收藏-用户注销";
	
	$nick = $_SESSION['nick'];
	
	//清除session
	$_SESSION = array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()-42000,'/');
	}
	session_destroy();
?>

<html>
	<head>
		<?php include 'control/head.php';?>
	</head>
	<body>
		<?php include 'control/navigation.php';?>
		<?php echo $nick ?>，再见
		<a href="login.php">重新登录</a>
	</body>
</html>