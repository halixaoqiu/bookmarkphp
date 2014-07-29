<?php
	
/**
 * 处理标签的function
 */

/**
 * 获取标签对应id
 * @param unknown_type $tag
 * @param unknown_type $user_id
 * @param unknown_type $pdo
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

/**
 * 创建标签记录，返回标签对应id
 * @param unknown_type $tag
 * @param unknown_type $user_id
 * @param unknown_type $pdo
 */
function create_a_tag($tag, $user_id, $pdo){
	$stmt = $pdo->prepare("insert into tag(tag_name,user_id,create_time,modify_time) values(?,?,now(),now())");
	$count = $stmt->execute(array($tag,$user_id));
	if($count>0){
		return $pdo->lastInsertId();
	}else{
		return -1;
	}
}

/**
 * 根据空格隔开的标签串创建标签记录，返回包含标签id和name的二维数组
 * @param unknown_type $tag
 * @param unknown_type $user_id
 * @param unknown_type $pdo
 */
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
	
/**
 * 创建一条bookmark_tag表的记录
 * @param unknown_type $bookmark_id
 * @param unknown_type $tag_id
 * @param unknown_type $tag_name
 * @param unknown_type $pdo
 */
function  create_a_bookmark_tag($bookmark_id,$tag_id,$tag_name,$pdo){
	$stmt = $pdo->prepare("insert into bookmark_tag(bookmark_id,tag_id,tag_name,create_time,modify_time) values(?,?,?,now(),now())");
	$count = $stmt->execute(array($bookmark_id,$tag_id,$tag_name));
	if($count>0){
		//do nothing
	}else{
		//log error
	}
}

/**
 * 根据bookmark_id获取标签串，用空格隔开
 * @param unknown_type $bookmark_id
 * @param unknown_type $pdo
 */
function get_tag_str_by_bookmark_id($bookmark_id,$pdo){
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

/**
 * 根据bookmark_id获取包含标签name的数组
 * @param unknown_type $bookmark_id
 * @param unknown_type $pdo
 */
function get_tag_array_by_bookmark_id($bookmark_id,$pdo){
	if(empty($bookmark_id)){
		return null;
	}
	$tag_array = array();
	$stmt = $pdo->prepare("select tag_name from bookmark_tag where bookmark_id=?");
	$stmt->execute(array($bookmark_id));
	if($stmt->rowCount()>0){
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($rows as $row){
			array_push($tag_array, $row['tag_name']);
		}
	}
	return $tag_array;
}

/**
 * 根据bookmark_id删除bookmark_tag的记录
 * @param unknown_type $bookmark_id
 * @param unknown_type $pdo
 */
function remove_bookmark_tag_by_bookmark_id($bookmark_id,$pdo){
	if(empty($bookmark_id)){
		return -1;
	}
	$stmt = $pdo->prepare("delete from bookmark_tag where bookmark_id=?");
	$count = $stmt->execute(array($bookmark_id));
	return $count;
}

?>