<?php

$is_login = false;
$nick = "";
if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
	$is_login = true;
	$nick = trim($_SESSION['nick']);
}

?>

<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container bp-fix">
		<div class="navbar-header">
	    	<a class="navbar-brand" href="index.php">草莓收藏</a>
		</div>
		<div>
			<form class="navbar-form navbar-left" role="search" action="search.php" method="get">
				<div class="form-group">
					<input type="text" name="search" class="form-control top-search-input" placeholder="搜索收藏或者标签">
				</div>
				<button type="submit" name="sub" class="btn btn-default btn-top-search">搜索</button>
			</form>
		</div>
		<div>
			<ul class="nav navbar-nav">
				<li class="navbar-active"><a class="top-nav-link" href="index.php">首页</a></li>
				<li><a class="top-nav-link" href="#about">标签</a></li>
				<li><a class="top-nav-link" href="#contact">发现</a></li>
			</ul>
		</div>
		<div>
      		<p class="navbar-text navbar-right">
      		<?php 
      			if($is_login){
      				echo "欢迎$nick | ";
      				echo '<a href="logout.php" class="navbar-link">退出</a>';
      			}else{
      				echo '<a href="guest.php" class="navbar-link">登录</a> | ';
      				echo '<a href="guest.php" class="navbar-link">注册</a>';
      			}
      		?>
	    	</p>
	   	</div>
	</div>
</nav>