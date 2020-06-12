<?php 

/**
 * @param $url
 * @return array
 */
function fetch_image_from_remote($url, $referer = 'http://www.qq.com',$timeout=15)
{
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_HEADER, 1);

    curl_setopt($ch, CURLOPT_REFERER,$referer);

    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//激活可修改页面,Activation can modify the page

    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);

    $data = curl_exec($ch);
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);//CURLINFO_REQUEST_SIZE - 在HTTP请求中有问题的请求的大小
        $type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);//CURLINFO_CONTENT_TYPE - 下载内容的Content-Type:值
        $header = substr($data, 0, $headerSize);//获取头信息
        $data = substr($data, $headerSize);//获取主体信息
    }
    curl_close($ch);
    return array($data, $type);
}

function re_lastModified ($time_difference){
        date_default_timezone_set('PRC');
        $lastModified = time() + $time_difference;        
        header('Last-Modified: ' . date('D, d M Y H:i:s', $lastModified) . ' GMT');
        header('Cache-Control: max-age=86400,must-revalidate');  
        header('Expires: ' .gmdate ('D, d M Y H:i:s', time() + '86400' ). ' GMT'); 

}

function _addEtag() { 
      $etag = genEtag();
    header("Etag: $etag"); 
    // exit if not modified
    if (@trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) { 
        header("HTTP/1.1 304 Not Modified"); 
        exit; 
    }
}
function genEtag(){  
    if(!empty($_SERVER['HTTP_IF_NONE_MATCH'])){  
        $etag = $_SERVER['HTTP_IF_NONE_MATCH'];  
    }else{  
        define('SECRET', 'j8s91slksd9ab');  // secret  
        $etag = substr(md5(SECRET. substr(md5($_SERVER['REQUEST_URI']),0,16). substr(md5($_SERVER['HTTP_USER_AGENT']),0,16)),0, 16);  
    }  
    return $etag;  
}  

/**
 * @param $type
 * @param $data
 */
function output2Brower($type, $data)
{
    ob_clean();
    header("Content-type: " . $type);
    
    re_lastModified(60*2);

    header('Etag: '.genEtag());
    echo $data;
    exit;
}

_addEtag();
    define('CACHE_TIMEOUT',86400);//缓存时间
    define('CACHE_HOST','127.0.0.1');//缓存服务器的地址
    define('CACHE_PROT',11211);//端口

    $url = $_GET['url'];
    //解码
    $url = base64_decode($url);
    $url = str_replace(array('&amp;'),array('&'),$url);
    $md5_url_key = md5($url);
    $type_key = $md5_url_key.'_type';


    $memcache = new Memcache;
    $con_ok = $memcache->connect(CACHE_HOST,CACHE_PROT);
    if($con_ok){//memcache接上,
        $data = $memcache->get($md5_url_key);
        $type = $memcache->get($type_key);
        if(empty($data)){
            list($data, $type) = fetch_image_from_remote($url);
            $memcache->add($md5_url_key,$data,false,CACHE_TIMEOUT);//缓存一天
            $memcache->add($type_key,$type,false,CACHE_TIMEOUT);
        }
	}else{//memcache连不上,则使用原来的下载方式
        list($data, $type) = fetch_image_from_remote($url);
    }
    output2Brower($type, $data);
 ?>