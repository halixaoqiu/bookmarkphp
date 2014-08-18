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
	
	//count当前用户所有收藏
	$all_count = 0;
	$stmt = $pdo->prepare("select count(bookmark_id) as count from bookmark where user_id=?");
	$stmt->execute(array($user_id));
	if($stmt->rowCount()>0){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$all_count = $row['count'];
	}
	
	//count当前用户公开收藏
	$public_count = 0;
	$stmt = $pdo->prepare("select count(bookmark_id) as count from bookmark where user_id=? and is_public=1");
	$stmt->execute(array($user_id));
	if($stmt->rowCount()>0){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$public_count = $row['count'];
	}
	
	//count当前用户私有收藏
	$private_count = $all_count - $public_count;
	
	$tag_html = "<ul><li class='side-nav-li'><a class='side-nav-link' href=\"tag.php?tag=&type=public\">公开收藏<span class='my-tag-count'>".$public_count."</span></a></li>";
	$tag_html = $tag_html."<li class='side-nav-li'><a class='side-nav-link' href=\"tag.php?tag=&type=private\">私有收藏<span class='my-tag-count'>".$private_count."</span></a></li>";
	foreach($tag_merge_array as $tag){
		$tag_html = $tag_html."<li class='side-nav-li'><a class='side-nav-link' href=\"tag.php?tag=".$tag['tag_name']."\">".$tag['tag_name']."<span class='my-tag-count'>".$tag['tag_count']."</span></a></li>";
	}
	$tag_html = $tag_html."<li class='side-nav-li'><a class='side-nav-link' href=\"tag.php?tag=&type=notag\">无标签</a></li></ul>";
?>
<div class="col-md-2">
	<div style="padding:0 0 0 5px">
		<ul>
			<li class="side-nav-li"><h3><a class="add-bookmark-link" href="addbookmark.php">添加新收藏</a></h3></li>
		</ul>
		<div class="split-line-block">
			<div class="split-line"></div>
		</div>
	</div>
	<div class="my-tags">
		<span><h3><a class='side-my-bookmarks' href="tag.php?tag=&type=all">我的收藏<span class='my-tag-count'><?php echo $all_count?></span></a></h3></span>
		<?php echo $tag_html ?>
	</div>
</div>
