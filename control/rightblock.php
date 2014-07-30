<?php
	
	require_once 'config.inc.php';
	require_once 'biz/tag.func.php';

	$user_id = $_SESSION['user_id'];
	
	$tag_id_name_array = get_tags_by_user_id($user_id, $pdo);
	
	$tag_html = "";
	foreach($tag_id_name_array as $tag){
		$tag_html = $tag_html."<span class='tag-split-my-tag'>".$tag['tag_name']."</span>";
	}
	
?>

<div><span><a href="addbookmark.php">添加收藏</a></span></div>
<div><span><a href="">分类管理</a></span></div>
<div><span><a href="">标签管理</a></span></div>
<div class="split-line-block">
	<div class="split-line"></div>
</div>
<div>
	<span><h3>我的标签</h3></span>
	<?php echo $tag_html ?>
</div>