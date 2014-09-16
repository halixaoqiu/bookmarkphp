<?php

/**
 * 工具集合，放各种工具方法
 */

/**
 * create pwd according to pwd with a seed constant
 * @param unknown_type $pwd
 */
function gen_pwd($pwd){
	$seed = "this_is_a_seed";
	return md5($pwd.$seed);
}

/**
 * 校验邮箱格式是否合法
 * @param unknown_type $email
 */
function check_email($email){
	return preg_match('/^[a-zA-Z0-9][a-zA-Z0-9._-]*\@[a-zA-Z0-9]+\.[a-zA-Z0-9\.]+$/', $email);
}

/**
 * 转义输入文本中的html标记防止注入
 * @param unknown_type $input
 */
function html2text($input){
	return htmlspecialchars(stripcslashes($input));
}
	
?>