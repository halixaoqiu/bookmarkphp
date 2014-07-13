<?php
	/**
	 * 用户登录表单和处理用户登录
	 */
	require 'config.inc.php';
	
	//常量定义
	$page_title = "草莓收藏-用户登录";
	
	session_start();
	
	//判断是否已经登录
	if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
		header("location:index.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include 'control/head.php';?>
	</head>
	<body>
		<?php include 'control/navigation.php';?>
		<div class="container">
			<form class="form-horizontal" role="form" action="action/login.action.php" method="post">
  				<div class="form-group">
    				<label for="email"  class="col-sm-2 control-label">邮箱：</label>
    				<div class="col-sm-10">
    					<input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
    				</div>
  				</div>
  				<div class="form-group">
				    <label for="password" class="col-sm-2 control-label">密码：</label>
				    <div class="col-sm-10">
					    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
				  	</div>
				  </div>
				  <div class="form-group">
				  	<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="sub" class="btn btn-default">登录</button>
					</div>
				</div>
			</form>
			<div>
				<span>没有账号？</span>
				<span><a href="register.php">我要注册</a></span>
			</div>
		</div>
	</body>
</html>