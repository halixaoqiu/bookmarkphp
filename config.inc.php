<?php
	/**
	 * 配置文件，配置数据库连接等
	 */
	define("DSN","mysql:host=localhost;dbname=bookmark");
	define("DBUSER","root");
	define("DBPASS","");
	
	try{
		$pdo = new PDO(DSN,DBUSER,DBPASS);
	}catch(PDOException $e){
		die("connect db fail：".$e->getMessage());
	}