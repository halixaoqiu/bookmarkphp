<?php
	
	require_once 'config.inc.php';
	require_once 'biz/tag.func.php';

	$tag_array = get_tag_array_for_guest($pdo);
	
	$tag_html = "";
	foreach($tag_array as $tag){
		$tag_html = $tag_html."<span class='tag-split-my-tag'>".$tag."</span>";
	}
	
?>
<div class="col-md-3">
	<div>
		<ul>
			<li><a role="button" class="btn" href="login2.php#myModal" data-toggle="modal">登录</a></li>
		</ul>
		<button type="button" class="btn btn-primary btn-lg btn-block">登录</button>
		<button type="button" class="btn btn-primary btn-lg btn-block">注册</button>
		<div class="split-line-block">
			<div class="split-line"></div>
		</div>
	</div>
	<div>
		<span><h3>热门标签</h3></span>
		<?php echo $tag_html ?>
		<div class="split-line-block">
			<div class="split-line"></div>
		</div>
		<span><h3>用户指南</h3></span>
		<li class="side-nav-li"><a class="side-nav-link" href="">什么是草莓收藏？</a></li>
	</div>
</div>