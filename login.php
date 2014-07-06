<?php
	/**
	 * 用户登录表单和处理用户登录
	 */
	session_start();
	require 'config.inc.php';
	
	//判断是否已经登录
	if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
		header("location:index.php");
		exit;
	}
	
	if(isset($_POST['sub'])){
		$stmt = $pdo->prepare("select user_id,nick from user where email=? and password=?");
		$stmt->execute(array($_POST["email"],$_POST["password"]));
		if($stmt->rowCount()>0){
			$_SESSION = $stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION["isLogin"] = 1;
			header("location:index.php");
		}else{
			echo '用户名or密码错误';
		}
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>用户登录</title>
	</head>
	<body>
		<form action="login.php" method="post">
			邮箱：<input type="text" name="email"><br>
			密码：<input type="password" name="password"><br>
			<input type="submit" name="sub" value="登录">
		</form>
		<div>
			<span>没有账号？</span>
			<span><a href="register.php">我要注册</a></span>
		</div>
	</body>
</html>