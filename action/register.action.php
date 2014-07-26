<?php
/**
 * 用户注册action
 * 
 * TODO:密码需要加密并且加种子生成，需要邮箱之类的做校验
 */

require '../config.inc.php';
require '../biz/bookmark.util.php';

session_start();

//判断是否已经登录
if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
	redirect(true);
}

if(isset($_POST['sub'])){
	$nick = trim($_POST['nick']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$repassword = trim($_POST['repassword']);
	
	if(empty($nick)||empty($email)||empty($password)||empty($repassword)){
		redirect(false);
	}
	
	if($password!==$repassword){
		redirect(false);
	}
	
	//判断邮箱是否已经被注册
	$stmt = $pdo->prepare("select user_id,nick from user where email=?");
	$stmt->execute(array($email));
	if($stmt->rowCount()>0){
		redirect(false);
	}else{
		//插入新用户
		try{
			$stmt = $pdo->prepare("insert into user(nick,password,email,create_time,modify_time) values(?,?,?,now(),now())");		
			$count = $stmt->execute(array($nick,get_pwd($password),$email));
			if($count>0){
				$stmt = $pdo->prepare("select user_id,nick from user where email=?");
				$stmt->execute(array($email));
				if($stmt->rowCount()>0){
					$_SESSION = $stmt->fetch(PDO::FETCH_ASSOC);
					$_SESSION["isLogin"] = 1;
					redirect(true);
				}
			}else{
				redirect(false);
			}
		}catch (Exception $e){
			$errmsg = $e->getMessage();
			redirect(false);
		}
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
		header("location:../register.php?errmsg=$errmsg");
		exit;
	}
}