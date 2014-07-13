<?php
/**
 * 用户登录action
 * 
 * TODO:密码需要加密并且随机数做种
 */

require '../config.inc.php';

session_start();
	
//判断是否已经登录
if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
	redirect(true);
}

if(isset($_POST['sub'])){
	$stmt = $pdo->prepare("select user_id,nick from user where email=? and password=?");
	$stmt->execute(array($_POST["email"],$_POST["password"]));
	if($stmt->rowCount()>0){
		$_SESSION = $stmt->fetch(PDO::FETCH_ASSOC);
		$_SESSION["isLogin"] = 1;
		redirect(true);
	}else{
		redirect(false);
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
		header("location:../login.php?errmsg=$errmsg");
		exit;
	}
}
?>