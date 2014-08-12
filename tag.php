<?php
/**
 * tag页面
 */
require_once '/control/islogin.php';
require_once 'config.inc.php';
require_once '/biz/tag.func.php';

//常量定义
$page_title = "标签-草莓收藏";

$tag_name = trim($_GET["tag"]);
$type = @trim($_GET["type"]);
$user_id = $_SESSION['user_id'];

if(empty($tag_name) && empty($type)){
	redirect();
}

$tag_title = "$tag_name";

if($type=='all'){
	$tag_title = "所有收藏";
	$stmt = $pdo->prepare("select * from bookmark where user_id=? order by create_time desc");
	$stmt->execute(array($user_id));
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}elseif($type=='notag'){
	$tag_title = "无标签的收藏";
}else{
	$stmt = $pdo->prepare("select bookmark_id from bookmark_tag where tag_name=? and user_id=? order by create_time desc");
	$stmt->execute(array($tag_name,$user_id));
	if($stmt->rowCount()>0){
		$rows1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$bookmark_id_array = array();
		foreach($rows1 as $row){
			array_push($bookmark_id_array, $row['bookmark_id']);
		}
		$in = implode(',',$bookmark_id_array);
		$stmt = $pdo->prepare("select * from bookmark where bookmark_id in (".$in.") order by create_time desc");
		$stmt->execute();
		if($stmt->rowCount()>0){
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
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
				<?php include 'control/leftblock.php';?>
				<div class="col-md-7">
				<div class="tag-bar">
					<h2><?php echo $tag_title ?></h2>
				</div>
				<?php 
					if(!empty($rows)){
						foreach($rows as $row){
							$bookmark_id = $row['bookmark_id'];
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
				<?php include 'control/rightblock.php';?>
			</div>
		</div>
	</body>
</html>