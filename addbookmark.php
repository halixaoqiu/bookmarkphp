<?php
	/**
	 * 添加收藏页
	 */
	require 'control/islogin.php';
	require 'biz/checkcsrf.func.php';
	
	//常量定义
	$page_title = "草莓收藏-添加收藏";
	
	$errmsg = "";
	if(isset($_GET["errmsg"])){
		$errmsg = $_GET["errmsg"];
	}
?>

<html>
	<head>
		<?php include 'control/head.php';?>
	</head>
	<body>
		<?php include 'control/navigation.php';?>
		<div class="container bp-fix">
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal" role="form" action="action/addbookmark.action.php" method="post">
						<?php gen_csrf_token() ?>
						<div class="form-group">
					    	<label for="url" class="col-sm-2 control-label">网址*</label>
						    <div class="col-sm-9">
					       		<input type="text" name="url" class="form-control" id="url" placeholder="">
						     </div>
						</div>
						<div class="form-group">
					    	<label for="title" class="col-sm-2 control-label">标题*</label>
						    <div class="col-sm-9">
					       		<input type="text" name="title" class="form-control" id="title" placeholder="">
						     </div>
						</div>
						<div class="form-group">
					    	<label for="summary" class="col-sm-2 control-label">描述&nbsp;</label>
						    <div class="col-sm-9">
						    	<textarea class="form-control" name="summary" rows="5" id="summary" placeholder=""></textarea>
						     </div>
						</div>
						<div class="form-group">
					    	<label for="tag" class="col-sm-2 control-label">标签&nbsp;</label>
						    <div class="col-sm-9">
					       		<input type="text" name="tag" class="form-control" id="tag" placeholder="">
						     </div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
						        	<label><input type="checkbox" name="is_public" checked="checked">标记为公开</label>
						         </div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" name="sub" class="btn btn-default">添加收藏</button>
								<a href="index.php" class="navbar-link">返回</a>
							</div>
						</div>
					</form>
				</div>
				<?php include 'control/rightblock.php';?>
			</div>
		</div>
	</body>
</html>