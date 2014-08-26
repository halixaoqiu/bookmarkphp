<?php
	
	require_once 'config.inc.php';
	require_once 'biz/tag.func.php';

	$user_id = $_SESSION['user_id'];
	
	$tag_id_name_array = get_tags_by_user_id($user_id, $pdo);
	$tag_id_array = array();
	foreach($tag_id_name_array as $tag){
		array_push($tag_id_array, $tag['tag_id']);
	}
	$tag_id_count_array = count_bookmarks_of_tags_biggerthan0($tag_id_array,$pdo);
	$tag_merge_array = array();
	foreach($tag_id_count_array as $tag_id_count){
		$arr = array();
		$arr['tag_id'] = $tag_id_count['tag_id'];
		$arr['tag_count'] = $tag_id_count['tag_count'];
		foreach($tag_id_name_array as $tag_id_name){
			if($tag_id_name['tag_id']==$tag_id_count['tag_id']){
				$arr['tag_name'] = $tag_id_name['tag_name'];
				break;
			}
		}
		array_push($tag_merge_array, $arr);
	}
	
	$tag_html = "";
	foreach($tag_merge_array as $tag){
		$tag_html = $tag_html."<span class='tag-split-my-tag'><a class='tag-block' href=\"mybookmark.php?tag=".$tag['tag_name']."\">".$tag['tag_name']."(".$tag['tag_count'].")</a></span>";
	}
	
	//最新收藏
	$rows = array();
	$new_bookmark_html = "";
	$stmt = $pdo->prepare("select bookmark_id,title,url from bookmark order by create_time desc limit 5");
	$stmt->execute();
	if($stmt->rowCount()>0){
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	foreach ($rows as $row){
		$new_bookmark_html = $new_bookmark_html."<span class='latest-bookmark'><a class='rightside-nav-link' target='_blank' href='".$row['url']."'>".$row['title']."</a><span>";
	}
	
?>
<div class="col-md-3">
	<div>
		<span><h3>热门标签</h3></span>
		<?php echo $tag_html ?>
		<div class="split-line-block">
			<div class="split-line"></div>
		</div>
		<span><h3>最新收藏</h3></span>
		<?php echo $new_bookmark_html ?>
		<div class="split-line-block">
			<div class="split-line"></div>
		</div>
		<span><h3>热门收藏</h3></span>
		<?php echo $tag_html ?>
		<div class="split-line-block">
			<div class="split-line"></div>
		</div>
		<span><h3>意见反馈</h3></span>
		<li class="side-nav-li"><a class="side-nav-link" href="">什么是草莓收藏？</a></li>
	</div>
</div>