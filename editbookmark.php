<?php
	/**
	 * 编辑收藏页
	 */
	require 'control/islogin.php';
	require 'config.inc.php';
	require 'biz/checkcsrf.func.php';
	require 'biz/tag.func.php';
	
	//常量定义
	$page_title = "草莓收藏-编辑收藏";
	
	$user_id = $_SESSION['user_id'];
	$bookmark_id = trim($_GET['bookmark_id']);
	$stmt = $pdo->prepare("select * from bookmark where bookmark_id=? and user_id=?");
	$stmt->execute(array($bookmark_id,$user_id));
	
	$row="";
	$is_public = true;
	if($stmt->rowCount()>0){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$is_public = $row['is_public']==1?true:false;
		$tags = get_tag_str_by_bookmark_id($bookmark_id,$pdo);
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
						<?php gen_csrf_token() ?>
						<div class="form-group">
					    	<label for="url" class="col-sm-2 control-label">网址*</label>
						    <div class="col-sm-9">
					       		<input type="text" name="url" class="form-control" id="url" value="<?php echo $row['url']?>" placeholder="">
						     </div>
						</div>
						<div class="form-group">
					    	<label for="title" class="col-sm-2 control-label">标题*</label>
						    <div class="col-sm-9">
					       		<input type="text" name="title" class="form-control" id="title" value="<?php echo $row["title"]?>" placeholder="">
						     </div>
						</div>
						<div class="form-group">
					    	<label for="summary" class="col-sm-2 control-label">描述&nbsp;</label>
						    <div class="col-sm-9">
						    	<textarea class="form-control" name="summary" rows="5" id="summary" placeholder=""><?php echo $row['summary']?></textarea>
						     </div>
						</div>
						<div class="form-group">
					    	<label for="tag" class="col-sm-2 control-label">标签&nbsp;</label>
						    <div class="col-sm-9">
					       		<input type="text" name="tag" class="form-control" id="tag" data-toggle="tooltip" title="多个标签请用空格分隔" value="<?php echo $tags?>" placeholder="">
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
				<?php include 'control/rightblock.php';?>
			</div>
		</div>
	</body>
</html>

<script>
   $(function(){ $("[data-toggle='tooltip']").tooltip();});
</script>