<?php
	/**
	 * 用户首页
	 */
	require '/control/islogin.php';
	require 'config.inc.php';
	
	//常量定义
	$page_title = "草莓收藏-首页";
	
	$user_id = $_SESSION['user_id'];
	$stmt = $pdo->prepare("select * from bookmark where user_id=? order by create_time desc");
	$stmt->execute(array($user_id));
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
				<?php 
					if(!empty($rows)){
						foreach($rows as $row){
							$is_public_text = $row['is_public']==1?"公开":"私有";
							$summary_class = !empty($row['summary'])?"item-block-common":"";
echo <<<EOT
<div class="main-container">
	<div class="font-bold">
		<h4><a href="{$row['url']}" target="_blank">{$row['title']}</a></h4>
	</div>
	<div class="">
		<span class="color-tag">网址</span>
		<span>{$row['url']}</span>
	</div>
	<div class="{$summary_class}">{$row['summary']}</div>
	<div class="item-block-common">
		<span class="color-tag">{$is_public_text}</span>
<!--		<span class="color-tag tag-split">分类</span>-->
<!--		<span class="color-tag"><a>{$row['classify']}</a></span> -->
		<span class="color-tag tag-split">标签</span>
		<span><a>{$row['tag']}</a></span> 
		<span class="color-tag tag-split">收藏于</span>
		<span class="color-tag">{$row['create_time']}</span>
		<span class="color-tag tag-split"><a href="editbookmark.php?bookmark_id={$row['bookmark_id']}" target="_blank">编辑</a></span>
	</div>
	<div class="split-line-block">
		<div class="split-line"></div>
	</div>
</div>
EOT;
						}
					}
				?>
				</div>
				<div class="col-md-3">
					<?php include 'control/rightblock.php';?>
				</div>
			</div>
		</div>
	</body>
</html>