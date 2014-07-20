<?php
	/**
	 * 编辑收藏页
	 */
	require '/control/islogin.php';
	require 'config.inc.php';
	
	//常量定义
	$page_title = "草莓收藏-编辑收藏";
	
	$user_id = $_SESSION['user_id'];
	$bookmark_id = $_GET['bookmark_id'];
	$stmt = $pdo->prepare("select * from bookmark where bookmark_id=? and user_id=?");
	$stmt->execute(array($bookmark_id,$user_id));
	
	$row="";
	$is_public = true;
	if($stmt->rowCount()>0){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$is_public = $row['is_public']==1?true:false;
	}else{
		header("location:index.php");
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
					<form class="form-horizontal" role="form" action="action/editbookmark.action.php" method="post">
						<input type="hidden" name="bookmark_id" value=<?php echo $bookmark_id?>>
						<div class="form-group">
					    	<label for="url" class="col-sm-2 control-label">网址*</label>
						    <div class="col-sm-9">
					       		<input type="text" name="url" class="form-control" id="url" value="<?php echo $row['url']?>" placeholder="请输入网址">
						     </div>
						</div>
						<div class="form-group">
					    	<label for="title" class="col-sm-2 control-label">标题*</label>
						    <div class="col-sm-9">
					       		<input type="text" name="title" class="form-control" id="title" value="<?php echo $row["title"]?>" placeholder="请输入标题">
						     </div>
						</div>
						<div class="form-group">
					    	<label for="summary" class="col-sm-2 control-label">描述&nbsp;</label>
						    <div class="col-sm-9">
						    	<textarea class="form-control" name="summary" rows="5" id="summary" placeholder="请输入描述"><?php echo $row['summary']?></textarea>
						     </div>
						</div>
						<div class="form-group">
					    	<label for="tag" class="col-sm-2 control-label">标签&nbsp;</label>
						    <div class="col-sm-9">
					       		<input type="text" name="tag" class="form-control" id="tag" value="<?php echo $row['tag']?>" placeholder="请输入标签">
						     </div>
						</div>
						<div class="form-group">
					    	<label for="classify" class="col-sm-2 control-label">分类&nbsp;</label>
						    <div class="col-sm-9">
					       		<input type="text" name="classify" class="form-control" id="classify" value="<?php echo $row['classify']?>" placeholder="请输入分类">
						     </div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
						        	<label><input type="checkbox" name="is_public" <?php if($is_public){echo 'checked="checked"';}?>>标记为公开</label>
						         </div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" name="sub" class="btn btn-default">修改</button>
								<a href="index.php" class="navbar-link">返回</a>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-3">
					<?php include 'control/leftblock.php';?>
				</div>
			</div>
		</div>
	</body>
</html>