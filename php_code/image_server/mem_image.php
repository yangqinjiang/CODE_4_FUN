<?php 
	$url = $_GET['url'];
	$md5_url_key = md5($url);

	$memcache = new Memcache;
	$con_ok = $memcache->connect('127.0.0.1',11211);
	if(!$con_ok){
		exit('memcache 未连接成功');
	}

	$data = $memcache->get($md5_url_key);
	$type = $memcache->get($md5_url_key.'_type');
	if(empty($data)){
	    $ch = curl_init($url);

	    curl_setopt($ch, CURLOPT_HEADER, 1);

	    curl_setopt ($ch, CURLOPT_REFERER,"http://www.qq.com");

	    curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)"); 

	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//激活可修改页面,Activation can modify the page 

	    curl_setopt($ch, CURLOPT_TIMEOUT,15); 

	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

	    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1); 

	    $data = curl_exec($ch); 
		if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
		    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);//CURLINFO_REQUEST_SIZE - 在HTTP请求中有问题的请求的大小 
		    $type = curl_getinfo($ch,CURLINFO_CONTENT_TYPE);//CURLINFO_CONTENT_TYPE - 下载内容的Content-Type:值
		    $header = substr($data, 0, $headerSize);//获取头信息
		    $data = substr($data, $headerSize);//获取主体信息
		}
	    curl_close($ch); 
	    $memcache->add($md5_url_key,$data,false,86400);//缓存一天
	    $memcache->add($md5_url_key.'_type',$type,false,86400);
	}
	ob_clean(); 

    header("Content-type: ".$type);
    header('Cache-Control:max-age=2592000');
    echo $data;
 ?>