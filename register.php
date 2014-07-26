<?php
	/**
	 * 用户注册表单和用户注册处理
	 */
	require 'config.inc.php';
	require 'biz/checkcsrf.func.php';
	
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
		<div class="container bp-fix">
			<div class="row">
				<form class="form-horizontal" role="form" action="action/register.action.php" method="post">
					<?php gen_csrf_token() ?>
					<div class="form-group">
	    				<label for="nick"  class="col-sm-2 control-label">昵称</label>
	    				<div class="col-sm-6">
	    					<input type="text" name="nick" class="form-control" id="nick" placeholder="输入你想要的昵称">
	    				</div>
	  				</div>
	  				<div class="form-group">
	    				<label for="email"  class="col-sm-2 control-label">邮箱</label>
	    				<div class="col-sm-6">
	    					<input type="email" name="email" class="form-control" id="email" placeholder="输入你的邮箱">
	    				</div>
	  				</div>
	  				<div class="form-group">
	    				<label for="password"  class="col-sm-2 control-label">密码</label>
	    				<div class="col-sm-6">
	    					<input type="password" name="password" class="form-control" id="password" placeholder="输入你的密码">
	    				</div>
	  				</div>
	  				<div class="form-group">
	    				<label for="repassword"  class="col-sm-2 control-label">确认密码</label>
	    				<div class="col-sm-6">
	    					<input type="password" name="repassword" class="form-control" id="repassword" placeholder="再次输入密码">
	    				</div>
	  				</div>
	  				<div class="form-group">
				  		<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" name="sub" class="btn btn-default">注册</button>
							<span class="tag-split">已有账号？</span>
							<span><a href="login.php">我要登录</a></span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>