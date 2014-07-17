<?php
	/**
	 * 用户首页
	 */
	require '/control/islogin.php';
	require 'config.inc.php';
	
	//常量定义
	$page_title = "草莓收藏-首页";
	
	$user_id = $_SESSION['user_id'];
	$stmt = $pdo->prepare("select * from bookmark where user_id=?");
	$stmt->execute(array($user_id));
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
	<head>
		<?php include 'control/head.php';?>
	</head>
	<body>
		<?php include 'control/navigation.php';?>
		<div class="container">
			<div class="row">
				<div class="col-md-9">
				<?php 
					if(!empty($rows)){
						foreach($rows as $row){
							echo '<table><tr>';
							echo '<td>'.$row['bookmark_id'].'</td>';
							echo '<td>'.$row['title'].'</td>';
							echo '<td>'.$row['url'].'</td>';
							echo '<td>'.$row['summary'].'</td>';
							echo '<td>'.$row['classify'].'</td>';
							echo '<td>'.$row['tag'].'</td>';
							echo '<td>'.$row['create_time'].'</td>';
							echo '<tr></table>';
						}
					}
				?>
				</div>
				<div class="col-md-3">
					<div><span><a href="addbookmark.php">添加收藏</a></span></div>
				</div>
			</div>
		</div>
		
		
	</body>
</html>