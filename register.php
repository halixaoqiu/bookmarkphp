<?php
	/**
	 * 用户注册表单和用户注册处理
	 */
	require 'config.inc.php';
	
	//常量定义
	$page_title = "草莓收藏-用户注册";
	
	session_start();
	
	//判断是否已经登录
	if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
		header("location:index.php");
		exit;
	}
	
	$errmsg = "";
?>

<html>
	<head>
		<?php include 'control/head.php';?>
	</head>
	<body>
		<?php include 'control/navigation.php';?>
		<div>
			<span>错误信息：<?php echo $errmsg?></span>
		</div>
		<form action="action/register.action.php" method="post">
			昵称：<input type="text" name="nick"><br>
			邮箱：<input type="text" name="email"><br>
			密码：<input type="password" name="password"><br>
			确认密码：<input type="password" name="repassword"><br>
			<input type="submit" name="sub" value="注册">
		</form>
		<div>
			<span>已有账号？</span>
			<span><a href="login.php">我要登录</a></span>
		</div>
	</body>
</html>