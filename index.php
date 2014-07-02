<?php
	/**
	 * 主页
	 */
	session_start();
	if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
		echo "current user：".$_SESSION["user_id"]."<br>";
		echo "<a href='logout.php'>退出</a>";
	}else{
		header("location:login.php");
		exit;
	}