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

<!DOCTYPE html>
<html>
	<head>
		<style type='text/css'>
			body {
			background-color: #CCC;
			}
		</style>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>用户登录</title>
	   	<link href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
   		<script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
   		<script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			    	</button>
			    	<a class="navbar-brand" href="#">草莓收藏</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">主页</a></li>
						<li><a href="#about">关于我们</a></li>
						<li><a href="#contact">联系我们</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="starter-template">
				<h1>填写登录信息：</h1>
				<form class="form-horizontal" role="form" action="login.php" method="post">
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
		</div>
	</body>
</html>