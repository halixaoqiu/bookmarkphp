<?php
	/**
	 * 用户首页
	 */
	require '/control/islogin.php';
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>首页-收藏夹</title>
	</head>
	<body>
		<div><span><?php echo $_SESSION['nick']?>,欢迎你！</span></div>
		<div><span>这里展示用户首页</span></div>
		<div><span><a href="logout.php">退出</a></span></div>
	</body>
</html>