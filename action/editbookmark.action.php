<?php
/**
 * 编辑收藏action
 * 
 * TODO:标签和分类可以不填，需要有默认的，可以参考百度搜藏的处理方式，可以把用户已经使用的分类和标签展示出来，供用户选择
 */

require '../config.inc.php';
require '../control/islogin.php';

if(isset($_POST['sub'])){
	$bookmark_id= trim($_POST['bookmark_id']);
	$title = trim($_POST['title']);
	$url = trim($_POST['url']);
	$summary = trim($_POST['summary']);
	$tag = trim($_POST['tag']);
	$classify = trim($_POST['classify']);
	$is_public = trim($_POST['is_public'])=="on"?1:0;
	$user_id = trim($_SESSION['user_id']);
	
	//必填字段校验
	if(empty($title)||empty($url)){
		$errmsg="FORM_INVALID";
		redirect(false,$bookmark_id);
	}
	
	//权限校验
	$stmt = $pdo->prepare("select * from bookmark where bookmark_id=? and user_id=?");
	$stmt->execute(array($bookmark_id,$user_id));
	if($stmt->rowCount()<=0){
		header("location:index.php");
	}
	
	$stmt = $pdo->prepare("update bookmark set title=?,url=?,summary=?,classify=?,tag=?,is_public=?,modify_time=now() where bookmark_id=?");		
	$count = $stmt->execute(array($title,$url,$summary,$classify,$tag,$is_public,$bookmark_id));
	if($count>0){
		redirect(true);
	}
}

/**
 * 跳转处理
 * @param unknown_type $isSuccess
 */
function redirect($isSuccess, $bookmark_id){
	if($isSuccess){
		header("location:../index.php");
		exit;
	}else{
		header("location:../editbookmark.php?bookmark_id=$bookmark_id");
		exit;
	}
}
?>