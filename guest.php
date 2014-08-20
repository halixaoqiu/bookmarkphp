<?php
	/**
	 * 访客页面
	 */
	
	//常量定义
	$page_title = "柠檬收藏-方便的管理、分享你的收藏";
	
	session_start();
	
	//判断是否已经登录
	if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
		header("location:index.php");
		exit;
	}
	
?>
<html>
	<head>
		<?php include 'control/head.php';?>
	</head>
	<body>
		<div class ="gust-banner">
			<div class="container">
				<div class="row" style="margin-top:130px">
					<div class="col-md-7">
						<h1 class="heading" style="text-align:center">管理你的收藏</h1>
						<h1 class="heading" style="text-align:center">分享好的收藏</h1>
					</div>
					<div class="col-md-5">
						<form class="form-horizontal" role="form" action="action/register.action.php" method="post">
							<div class="form-group">
			    				<div class="col-sm-8">
			    					<input type="text" name="nick" class="form-control guest-input" id="nick" placeholder="昵称">
			    				</div>
			  				</div>
			  				<div class="form-group">
			    				<div class="col-sm-8">
			    					<input type="email" name="email" class="form-control guest-input" id="email" placeholder="邮箱">
			    				</div>
			  				</div>
			  				<div class="form-group">
							    <div class="col-sm-8">
								    <input type="password" name="password" class="form-control guest-input" id="password" placeholder="密码">
							  	</div>
						  	</div>
						  	<div class="form-group">
						  		<div class="col-sm-8">
									<button type="submit" name="sub" class="btn btn-success btn-block guest-input">注册 SIGN UP</button>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-8">
									<a href="#" class="login-link" data-toggle="modal" data-target="#loginModal">已有账号，我要登录</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class ="gust-banner">
			
		</div>
		
        <div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  
            <div class="modal-dialog">
            	<div class="modal-content">
            		<div class="modal-header">
            			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            			<h1 class="modal-title" id="myModalLabel">登录 SIGN IN</h1>
            		</div>
            		<div class="modal-body">
            			<form class="form-horizontal" role="form" action="action/login.action.php" method="post">
			  				<div class="form-group">
			    				<div class="col-sm-8 col-sm-offset-2">
			    					<input type="email" name="email" class="form-control guest-input" id="email" placeholder="邮箱">
			    				</div>
			  				</div>
			  				<div class="form-group">
							    <div class="col-sm-8 col-sm-offset-2">
								    <input type="password" name="password" class="form-control guest-input" id="password" placeholder="密码">
							  	</div>
						  	</div>
						  	<div class="form-group">
						  		<div class="col-sm-8 col-sm-offset-2">
									<button type="submit" name="sub" class="btn btn-success btn-block guest-input">登录 SIGN IN</button>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-8">
									<a href="#" class="login-link">已有账号，我要登录</a>
								</div>
							</div>
						</form>
            		</div>
            		<div class="modal-footer">
			            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			         </div>
            	</div>
            </div>
        </div>  
	</body>
</html>