<?php
/**
 * 用户登录action
 * 
 * TODO:密码需要加密并且随机数做种
 */

require '../config.inc.php';
require '../biz/util.func.php';
require '../biz/checkcsrf.func.php';

session_start();
	
//判断是否已经登录
if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
	redirect(true);
}

if(isset($_POST['sub'])){
	$email = trim($_POST["email"]);
	$password = trim($_POST["password"]);
	//csrf token check
	if(!check_token()){
		redirect(false,"csrferr");
	}
	//check email
	if(!check_email($email)){
		redirect(false,"emailerror");
	}
	
	$stmt = $pdo->prepare("select user_id,nick from user where email=? and password=?");
	$stmt->execute(array($email,gen_pwd($password)));
	if($stmt->rowCount()>0){
		$_SESSION = $stmt->fetch(PDO::FETCH_ASSOC);
		$_SESSION["isLogin"] = 1;
		redirect(true);
	}else{
		redirect(false,"noexist");
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
		header("location:../guest.php?errmsg=$errmsg");
		exit;
	}
}
?>