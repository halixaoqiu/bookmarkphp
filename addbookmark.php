<?php
	/**
	 * 添加收藏页
	 */
	require '/control/islogin.php';
	
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
		<div>
			<span>错误信息：<?php echo $errmsg?></span>
		</div>
		<div class="container">
			<form class="form-horizontal" role="form" action="action/addbookmark.action.php" method="post">
				<div class="form-group">
			    	<label for="title" class="col-sm-2 control-label">标题</label>
				    <div class="col-sm-10">
			       		<input type="text" name="title" class="form-control" id="title" placeholder="请输入标题">
				     </div>
				</div>
				<div class="form-group">
			    	<label for="url" class="col-sm-2 control-label">网址</label>
				    <div class="col-sm-10">
			       		<input type="text" name="url" class="form-control" id="url" placeholder="请输入网址">
				     </div>
				</div>
				<div class="form-group">
			    	<label for="summary" class="col-sm-2 control-label">描述</label>
				    <div class="col-sm-10">
				    	<textarea class="form-control" name="summary" rows="5" id="summary" placeholder="请输入描述"></textarea>
				     </div>
				</div>
				<div class="form-group">
			    	<label for="tag" class="col-sm-2 control-label">标签</label>
				    <div class="col-sm-10">
			       		<input type="text" name="tag" class="form-control" id="tag" placeholder="请输入标签">
				     </div>
				</div>
				<div class="form-group">
			    	<label for="classify" class="col-sm-2 control-label">分类</label>
				    <div class="col-sm-10">
			       		<input type="text" name="classify" class="form-control" id="classify" placeholder="请输入分类">
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
					</div>
				</div>
			</form>
		</div>
	</body>
</html>