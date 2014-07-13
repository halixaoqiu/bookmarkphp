<?php
	/**
	 * 用户首页
	 */
	require '/control/islogin.php';
	
	//常量定义
	$page_title = "草莓收藏-首页";
?>

<html>
	<head>
		<?php include 'control/head.php';?>
	</head>
	<body>
		<?php include 'control/navigation.php';?>
		<div><span><?php echo $_SESSION['nick']?>,欢迎你！</span></div>
		<div><span>这里展示用户首页</span></div>
		<div><span><a href="addbookmark.php">添加收藏</a></span></div>
		<div><span><a href="logout.php">退出</a></span></div>
	</body>
</html>