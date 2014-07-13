<?php
/**
 * 添加收藏action
 * 
 * TODO:标签和分类可以不填，需要有默认的，可以参考百度搜藏的处理方式，可以把用户已经使用的分类和标签展示出来，供用户选择
 */

require '../config.inc.php';
require '../control/islogin.php';

if(isset($_POST['sub'])){
	$title = trim($_POST['title']);
	$url = trim($_POST['url']);
	$summary = trim($_POST['summary']);
	$tag = trim($_POST['tag']);
	$classify = trim($_POST['classify']);
	$is_public = trim($_POST['is_public'])=="on"?1:0;
	$user_id = trim($_SESSION['user_id']);
	
	if(empty($title)||empty($url)||empty($summary)||empty($tag)||empty($classify)){
		$errmsg="FORM_INVALID";
		redirect(false,$errmsg);
	}
	
	//根据url判断是否已经收藏过
	$stmt = $pdo->prepare("select bookmark_id from bookmark where url=? and user_id=?");
	$stmt->execute(array($url,$user_id));
	if($stmt->rowCount()>0){
		$errmsg = "HAS_ADDED";
		redirect(false,$errmsg);
	}
	
	$stmt = $pdo->prepare("insert into bookmark(user_id,title,url,summary,classify,tag,is_public,create_time,modify_time) values(?,?,?,?,?,?,?,now(),now())");		
	$count = $stmt->execute(array($user_id,$title,$url,$summary,$classify,$tag,$is_public));
	if($count>0){
		redirect(true);
	}
}

/**
 * 跳转处理
 * @param unknown_type $isSuccess
 */
function redirect($isSuccess, $errmsg){
	if($isSuccess){
		header("location:../index.php");
		exit;
	}else{
		header("location:../addbookmark.php?errmsg=$errmsg");
		exit;
	}
}
?>