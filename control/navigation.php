<?php

$is_login = false;
$nick = "";
if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
	$is_login = true;
	$nick = trim($_SESSION['nick']);
}

?>

<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
	    	<a class="navbar-brand" href="index.php">草莓收藏</a>
		</div>
		<div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="index.php">主页</a></li>
				<li><a href="#about">关于我们</a></li>
				<li><a href="#contact">联系我们</a></li>
			</ul>
		</div>
		<div>
      		<p class="navbar-text navbar-right">
      		<?php 
      			if($is_login){
      				echo "欢迎$nick | ";
      				echo '<a href="logout.php" class="navbar-link">退出</a>';
      			}else{
      				echo '<a href="login.php" class="navbar-link">登录</a> | ';
      				echo '<a href="register.php" class="navbar-link">注册</a>';
      			}
      		?>
	    	</p>
	   	</div>
	</div>
</nav>