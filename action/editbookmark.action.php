<?php
/**
 * 编辑收藏action
 * 
 * TODO:标签和分类可以不填，需要有默认的，可以参考百度搜藏的处理方式，可以把用户已经使用的分类和标签展示出来，供用户选择
 */

require '../config.inc.php';
require '../control/islogin.php';
require '../biz/checkcsrf.func.php';
require '../biz/tag.func.php';

if(isset($_POST['sub'])){
	
	$bookmark_id= trim($_POST['bookmark_id']);
	$title = trim($_POST['title']);
	$url = trim($_POST['url']);
	$summary = trim($_POST['summary']);
	$tag = trim($_POST['tag']);
	$is_public = trim($_POST['is_public'])=="on"?1:0;
	$user_id = trim($_SESSION['user_id']);
	
	//csrf token check
	if(!check_token()){
		redirect(false,$bookmark_id,"CSRF_ERROR");
	}
	//必填字段校验
	if(empty($title)||empty($url)){
		$errmsg="FORM_INVALID";
		redirect(false,$bookmark_id);
	}
	
	//用户权限校验
	$stmt = $pdo->prepare("select * from bookmark where bookmark_id=? and user_id=?");
	$stmt->execute(array($bookmark_id,$user_id));
	if($stmt->rowCount()<=0){
		header("location:index.php");
	}
	
	$stmt = $pdo->prepare("update bookmark set title=?,url=?,summary=?,is_public=?,modify_time=now() where bookmark_id=?");		
	$count = $stmt->execute(array($title,$url,$summary,$is_public,$bookmark_id));
	if($count>0){
		//分割标签，创建标签记录
		$tag_id_name_array = create_tags($tag,$user_id,$pdo);
		if(empty($tag_id_name_array)){
			//如果$tag为空，清空bookmark_tag表的关联记录
			remove_bookmark_tag_by_bookmark_id($bookmark_id,$pdo);
		}else{
			//如果$tag不为空，先清空老的bookmark_tag表记录，再插入新记录
			remove_bookmark_tag_by_bookmark_id($bookmark_id,$pdo);
			foreach($tag_id_name_array as $arr){
				create_a_bookmark_tag($bookmark_id,$user_id,$arr['tag_id'],$arr['tag_name'],$pdo);
			}
		}
		redirect(true);
	}
}

/**
 * 跳转处理
 * @param unknown_type $isSuccess
 */
function redirect($isSuccess, $bookmark_id, $errormsg){
	if($isSuccess){
		header("location:../index.php");
		exit;
	}else{
		header("location:../editbookmark.php?bookmark_id=$bookmark_id&errormsg=$errormsg");
		exit;
	}
}
?>