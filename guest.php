<?php
	/**
	 * 访客页面
	 */
	require_once 'config.inc.php';
	require_once '/biz/tag.func.php';
	
	//常量定义
	$page_title = "草莓收藏";
	
	$stmt = $pdo->prepare("select * from bookmark where is_public=1 order by create_time desc limit 10");
	$stmt->execute();
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
							$bookmark_id = $row['bookmark_id'];
							$tag_array = get_tag_array_by_bookmark_id($bookmark_id,$pdo);
							$tag_html = "";
							foreach($tag_array as $tag){
								$tag_html = $tag_html."<span><a href='tag.php?tag=".$tag."'>".$tag."</a></span> ";
							}
							$tag_html = trim($tag_html);
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
		<span class="color-tag tag-split">标签</span>
		<span><a>{$tag_html}</a></span> 
		<span class="color-tag tag-split">收藏于</span>
		<span class="color-tag">{$row['create_time']}</span>
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
			</div>
		</div>
	</body>
</html>