<?php
/**
 * 添加收藏action
 * 
 * TODO:标签和分类可以不填，需要有默认的，可以参考百度搜藏的处理方式，可以把用户已经使用的分类和标签展示出来，供用户选择
 */

require '../config.inc.php';
require '../control/islogin.php';
require '../biz/checkcsrf.func.php';

if(isset($_POST['sub'])){
	
	//csrf token check
	if(!check_token()){
		redirect(false,"csrferr");
	}
	
	$title = trim($_POST['title']);
	$url = trim($_POST['url']);
	$summary = trim($_POST['summary']);
	$tag = trim($_POST['tag']);
	$classify = trim($_POST['classify']);
	$is_public = trim($_POST['is_public'])=="on"?1:0;
	$user_id = trim($_SESSION['user_id']);
	
	if(empty($title)||empty($url)){
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
	
	//分割标签，创建标签记录
	$tag_id_array = array();
	if(!empty($tag)){
		$tag_array = preg_split("/\s+/",$tag);
		//标签如果存在就取出tag_id，如果不存在就插入新tag记录
		foreach($tag_array as $each_tag){
			$stmt = $pdo->prepare("select tag_id from tag where tag_name=? and user_id=?");
			$stmt->execute(array($each_tag,$user_id));
			if($stmt->rowCount()>0){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				array_push($tag_id_array, $row['tag_id']);
			}else{
				$stmt = $pdo->prepare("insert into tag(tag_name,user_id,create_time,modify_time) values(?,?,now(),now())");
				$count = $stmt->execute(array($each_tag,$user_id));
				if($count>0){
					array_push($tag_id_array, $pdo->lastInsertId());
				}
			}
		}
	}
	
	//插入收藏记录
	$stmt = $pdo->prepare("insert into bookmark(user_id,title,url,summary,classify,is_public,create_time,modify_time) values(?,?,?,?,?,?,now(),now())");		
	$count = $stmt->execute(array($user_id,$title,$url,$summary,$classify,$is_public));
	if($count>0){
		//在bookmark_tag表中插入收藏和标签的关联记录
		if(!empty($tag_id_array)){
			$bookmark_id = $pdo->lastInsertId();
			foreach($tag_id_array as $tag_id){
				$stmt = $pdo->prepare("insert into bookmark_tag(bookmark_id,tag_id,create_time,modify_time) values(?,?,now(),now())");
				$count = $stmt->execute(array($bookmark_id,$tag_id));
				if($count>0){
					redirect(true);
				}
			}
		}
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