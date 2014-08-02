<?php
/**
 * 顶部搜索的action
 */

require '../config.inc.php';

if(isset($_POST['sub'])){
	$text = trim($_POST["search"]);
	if(empty($text)){
		redirect();
	}
	echo $text;
	$stmt = $pdo->prepare("select * from bookmark where title like '%?%'");
	$stmt->execute(array($text));
	echo $stmt->rowCount();
	if($stmt->rowCount()>0){
		echo $text;
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($rows as $row){
			echo $row['title'];
		}
	}
//	redirect();
}

/**
 * 跳转处理
 * @param unknown_type $isSuccess
 */
function redirect(){
	header("location:../index.php");
	exit;
}

?>