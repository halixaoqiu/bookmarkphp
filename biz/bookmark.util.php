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
	
?>