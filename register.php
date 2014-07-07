<?php
	/**
	 * 用户注册表单和用户注册处理
	 */
	session_start();
	require 'config.inc.php';
	
	//判断是否已经登录
	if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==1){
		header("location:index.php");
		exit;
	}
	
	$errmsg = "";
	if(isset($_POST['sub'])){
		if(empty($_POST['nick'])||empty($_POST['email'])||empty($_POST['password'])||empty($_POST['repassword'])){
			$errmsg="表单填写不完整";
//			exit;
		}
		elseif($_POST['password']!==$_POST['repassword']){
			$errmsg="两次密码输入不一致";
//			exit;
		}else{
			//判断邮箱是否已经被注册
			$stmt = $pdo->prepare("select user_id,nick from user where email=?");
			$stmt->execute(array($_POST["email"]));
			if($stmt->rowCount()>0){
				$errmsg='该邮箱已经被注册';
			}else{
				//插入新用户
				try{
					$stmt = $pdo->prepare("insert into user(nick,password,email,create_time,modify_time) values(?,?,?,now(),now())");		
					$count = $stmt->execute(array($_POST["nick"],$_POST["password"],$_POST["email"]));
					if($count>0){
						$stmt = $pdo->prepare("select user_id,nick from user where email=?");
						$stmt->execute(array($_POST["email"]));
						if($stmt->rowCount()>0){
							$_SESSION = $stmt->fetch(PDO::FETCH_ASSOC);
							$_SESSION["isLogin"] = 1;
							header("location:index.php");
						}
					}else{
						$errmsg='注册失败，请重试';
					}
				}catch (Exception $e){
					$errmsg = $e->getMessage();
				}
			}
		}
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>用户注册</title>
	</head>
	<body>
		<div>
			<span>错误信息：<?php echo $errmsg?></span>
		</div>
		<form action="register.php" method="post">
			昵称：<input type="text" name="nick"><br>
			邮箱：<input type="text" name="email"><br>
			密码：<input type="password" name="password"><br>
			确认密码：<input type="password" name="repassword"><br>
			<input type="submit" name="sub" value="注册">
		</form>
		<div>
			<span>已有账号？</span>
			<span><a href="login.php">我要登录</a></span>
		</div>
	</body>
</html>