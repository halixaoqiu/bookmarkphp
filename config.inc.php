<?php
	/**
	 * 配置文件，配置数据库连接等
	 */

	if(defined('SAE_MYSQL_HOST_M')){
 		$dsn = 'mysql:host='.SAE_MYSQL_HOST_M.';port='.SAE_MYSQL_PORT.';dbname='.SAE_MYSQL_DB;
 		define("DSN",$dsn);
		define("DBUSER",SAE_MYSQL_USER);
		define("DBPASS",SAE_MYSQL_PASS);
	}else{
		$dsn = "mysql:host=localhost;dbname=bookmark";
		define("DSN",$dsn);
		define("DBUSER","root");
		define("DBPASS","");
	}

	try{
		$pdo = new PDO(DSN,DBUSER,DBPASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
	}catch(PDOException $e){
		die("connect db fail：".$e->getMessage());
	}