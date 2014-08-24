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
	
	$tag_html = "<ul><li class='side-nav-li'><a class='side-nav-link' href=\"mybookmark.php?tag=&type=public\">公开收藏<span class='my-tag-count'>".$public_count."</span></a></li>";
	$tag_html = $tag_html."<li class='side-nav-li'><a class='side-nav-link' href=\"mybookmark.php?tag=&type=private\">私有收藏<span class='my-tag-count'>".$private_count."</span></a></li>";
	foreach($tag_merge_array as $tag){
		$tag_html = $tag_html."<li class='side-nav-li'><a class='side-nav-link' href=\"mybookmark.php?tag=".$tag['tag_name']."\">".$tag['tag_name']."<span class='my-tag-count'>".$tag['tag_count']."</span></a></li>";
	}
	$tag_html = $tag_html."<li class='side-nav-li'><a class='side-nav-link' href=\"mybookmark.php?tag=&type=notag\">无标签</a></li></ul>";
?>
<div class="col-md-2">
	<div style="padding:0 0 0 5px">
		<ul>
			<li class="side-nav-li"><h3><a class="add-bookmark-link" href="#" data-toggle="modal" data-target="#addModal">添加新收藏</a></h3></li>
		</ul>
		<div class="split-line-block">
			<div class="split-line"></div>
		</div>
	</div>
	<div class="my-tags">
		<span><h3><a class='side-my-bookmarks' href="mybookmark.php?tag=&type=all">我的收藏<span class='my-tag-count'><?php echo $all_count?></span></a></h3></span>
		<?php echo $tag_html ?>
	</div>
</div>

<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h1 class="modal-title" id="myModalLabel">添加新收藏</h1>
            </div>
            <div class="modal-body">
				<form class="form-horizontal" role="form" action="action/addbookmark.action.php" method="post">
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
						<div class="col-sm-offset-2 col-sm-9">
							<div class="checkbox">
					        	<label><input type="checkbox" name="is_public" checked="checked">标记为公开</label>
					         </div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-9">
							<button type="submit" name="sub" class="btn btn-success btn-block">添加收藏</button>
						</div>
					</div>
				</form>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			</div>
		</div>
	</div>
</div> 
