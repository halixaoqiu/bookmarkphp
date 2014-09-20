<?php 
	/**
	 * 异步获取网页的title
	 */	

	$url = trim($_GET['url']); 
	if(!empty($url)){
//		$contents = file_get_contents($url); 
		
		$ch = curl_init();
		$timeout = 2; // set to zero for no timeout
		$ua ='Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.47 Safari/536.11';
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
		$contents = curl_exec($ch);
		
		//如果出现中文乱码使用下面代码 
		//$getcontent = iconv("gb2312", "utf-8",$contents); 
		if(preg_match("/<title>(.*)<\/title>/i",$contents,$out)){
	   		$title=$out[0];
	   		$title = str_replace("<title>","",$title);
	   		$title = str_replace("</title>","",$title);
//	   		$title = iconv("gbk", "utf-8",$title); 
	   		echo $title;  
	  	}
	}
?> 