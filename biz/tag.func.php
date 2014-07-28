<?php
	
/**
 * 处理标签的function
 */

function get_tag_id($tag, $user_id, $pdo){
	$stmt = $pdo->prepare("select tag_id from tag where tag_name=? and user_id=?");
	$stmt->execute(array($tag,$user_id));
	if($stmt->rowCount()>0){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['tag_id'];
	}else{
		return -1;
	}
}

function create_a_tag($tag, $user_id, $pdo){
	$stmt = $pdo->prepare("insert into tag(tag_name,user_id,create_time,modify_time) values(?,?,now(),now())");
	$count = $stmt->execute(array($tag,$user_id));
	if($count>0){
		return $pdo->lastInsertId();
	}else{
		return -1;
	}
}

function create_tags($tag,$user_id,$pdo){
	$tag_id_name_array = array();
	if(!empty($tag)){
		$tag_array = preg_split("/\s+/",$tag);
		$tag_array = array_unique($tag_array);
		//标签如果存在就取出tag_id，如果不存在就插入新tag记录
		foreach($tag_array as $each_tag){
			$tag_id = get_tag_id($each_tag,$user_id,$pdo);
			if($tag_id > 0){
				$arr = array();
				$arr['tag_name'] = $each_tag;
				$arr['tag_id'] = $tag_id;
				array_push($tag_id_name_array,$arr);
			}else{
				$tag_id = create_a_tag($each_tag,$user_id,$pdo);
				if($tag_id > 0){
					$arr = array();
					$arr['tag_name'] = $each_tag;
					$arr['tag_id'] = $tag_id;
					array_push($tag_id_name_array,$arr);
				}
			}
		}
	}
	return $tag_id_name_array;
}
	
function  create_a_bookmark_tag($bookmark_id,$tag_id,$tag_name,$pdo){
	$stmt = $pdo->prepare("insert into bookmark_tag(bookmark_id,tag_id,tag_name,create_time,modify_time) values(?,?,?,now(),now())");
	$count = $stmt->execute(array($bookmark_id,$tag_id,$tag_name));
	if($count>0){
		//do nothing
	}else{
		//log error
	}
}

function get_tags_by_bookmark_id($bookmark_id,$pdo){
	$tags = "";
	$stmt = $pdo->prepare("select * from bookmark_tag where bookmark_id=?");
	$stmt->execute(array($bookmark_id));
	if($stmt->rowCount()>0){
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if(!empty($rows)){
			foreach($rows as $row){
				$tags = $tags." ".$row['tag_name'];
			}
			return trim($tags);
		}
	}
	return $tags;
}

?>