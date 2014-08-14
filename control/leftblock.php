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
	
	$tag_html = "<ul><li class='side-nav-li'><a class='side-nav-link' href=\"tag.php?tag=&type=all\">所有收藏</a></li>";
	foreach($tag_merge_array as $tag){
		$tag_html = $tag_html."<li class='side-nav-li'><a class='side-nav-link' href=\"tag.php?tag=".$tag['tag_name']."\">".$tag['tag_name']."(".$tag['tag_count'].")</a></li>";
	}
	$tag_html = $tag_html."<li class='side-nav-li'><a class='side-nav-link' href=\"tag.php?tag=&type=notag\">无标签</a></li></ul>";
?>
<div class="col-md-2">
	<div>
		<ul>
			<li class="side-nav-li"><h3><a class="add-bookmark-link" href="addbookmark.php">添加新收藏</a></h3></li>
<!--			<li class="side-nav-li"><a class="side-nav-link" href="">管理收藏</a></li>-->
<!--			<li class="side-nav-li"><a class="side-nav-link" href="">我的标签</a></li>-->
		</ul>
		<div class="split-line-block">
			<div class="split-line"></div>
		</div>
	</div>
	<div>
		<span><h3>我的收藏</h3></span>
		<?php echo $tag_html ?>
	</div>
</div>
