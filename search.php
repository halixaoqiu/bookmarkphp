<?php
/**
 * 搜索页
 */
require_once '/control/islogin.php';
require_once 'config.inc.php';
require_once '/biz/tag.func.php';

$text = trim($_GET["search"]);
if(empty($text)){
	redirect();
}
//常量定义
$page_title = "「".$text."」的搜索结果-草莓收藏";

if(isset($_GET['sub'])){
	$stmt = $pdo->prepare("select * from bookmark where title like ? order by create_time desc");
	$stmt->execute(array('%'.$text.'%'));
	if($stmt->rowCount()>0){
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
	
/**
 * 跳转处理
 * @param unknown_type $isSuccess
 */
function redirect(){
	header("location:index.php");
	exit;
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
				<?php 
					if(!empty($rows)){
						foreach($rows as $row){
							$bookmark_id = $row['bookmark_id'];
							$title = str_ireplace($text, "<span class='em'>".$text."</span>", $row['title']);
							$tag_array = get_tag_array_by_bookmark_id($bookmark_id,$pdo);
							$tag_html = "";
							foreach($tag_array as $tag){
								$tag_html = $tag_html."<span><a href='index.php'>".$tag."</a></span> ";
							}
							$tag_html = trim($tag_html);
							$is_public_text = $row['is_public']==1?"公开":"私有";
							$summary_class = !empty($row['summary'])?"item-block-common":"";
echo <<<EOT
<div class="main-container">
	<div class="font-bold">
		<h4><a href="{$row['url']}" target="_blank">{$title}</a></h4>
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
				<?php include 'control/rightblock.php';?>
			</div>
		</div>
	</body>
</html>