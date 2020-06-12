<?php 
/**
 * 数字转换成字母的函数
 * @param $value  0-9的数字
 * @return string  转换后的字符串
 */
  function md6($value){              //加密参数
        $raw = str_split($value);//打散字符串
        //使用[查表法]来查找相应的字母
        $table = array(0=>'g',1=>'z',2=>'c',3=>'r',4=>'k',5=>'f',6=>'o',7=>'h',8=>'i',9=>'j');
        $result  = '';
        foreach ($raw as $k => $v) {
            $result .=$table[$v];
        }
        return $result;
  }

  /**
 * 数字转换成字母的函数
 * @param $value  0-9的数字
 * @return string  转换后的字符串
 */
  function jie_md6($value){              //加密参数
        $raw = str_split($value);//打散字符串
        //使用[查表法]来查找相应的字母
        $table = array('g'=>'0','z'=>'1','c'=>'2','r'=>'3','k'=>'4','f'=>'5','o'=>'6','h'=>'7','i'=>'8','j'=>'9');
        $result  = '';
        foreach ($raw as $k => $v) {
            $result .=$table[$v];
        }
        return $result;
  }
// $raw = '456464645654'.time();
//   $md6_str = md6($raw );
//   var_dump($md6_str);
//   var_dump($raw == jie_md6($md6_str));
//   
// echo base64_decode('aHR0cDovL2ltZzAzLnN0b3JlLnNvZ291LmNvbS9uZXQvYS8wNC9saW5rP2FwcGlkPTEwMDUyMDAzMSZhbXA7dz03MTAmYW1wO3VybD1odHRwJTNBJTJGJTJGbW1iaXoucXBpYy5jbiUyRm1tYml6JTJGektCd0RkdThVOEd3ZzFDZGI0YU1lRTNxaHhsc0ZhNW82blpNN0gwdjdQdzZvS3FSd1U2TUtEaG9LeXR4bFZJT2lhSWRTMTByaWMzOFhUUGsyaWJ2RVd1QVElMkYwJTNGd3hfZm10JTNEZ2lm');
 // echo base64_encode('http://img03.store.sogou.com/net/a/04/link?appid=100520031&w=710&url=http%3A%2F%2Fmmbiz.qpic.cn%2Fmmbiz%2FzKBwDdu8U8Gwg1Cdb4aMeE3qhxlsFa5ov1P7W9Em8Vku1VEFWEGiaAt2z8JBBFC7OSjfc1lwicxrSVXMuDyT4W7w%2F0%3Fwx_fmt%3Dgif&wx_lazy=1');
 
//  $url = 'http://img03.store.sogou.com/net/a/04/link?appid=100520031&w=710&url=http%3A%2F%2Fmmbiz.qpic.cn%2Fmmbiz%2FzKBwDdu8U8Gwg1Cdb4aMeE3qhxlsFa5ov1P7W9Em8Vku1VEFWEGiaAt2z8JBBFC7OSjfc1lwicxrSVXMuDyT4W7w%2F0%3Fwx_fmt%3Dgif&wx_lazy=1'.time();
// $md5_url_key = md5($url);
// $haystack = 'http://image.weilianapp.com/i/aHR0cDovL21tYml6LnFwaWMuY24vbW1iaXovTzZFdjB5bUdvcnZzUUc1UGxVRG4zano4bW40RFF0OHpMUGdNemlhcUdxZndodjFZZXZQMFRXOVNIWkI0bnFxdWN3SmliaWJRdzhsWE81MjE1MmV5eDY0THcvMA==.jpg';
// $jpg_pos =  strrpos($haystack,'.jpg');
// echo substr($haystack,0,$jpg_pos);
// 
// $url = 'http://wb.ok8s.com/ask/a/843522?u=117038&s=http://mp.weixin.qq.com/s?__biz=MjM5MzA0MzY5OA==&mid=207915342&idx=1&sn=ba02acdb7f09bf418c20e94e14f88382&scene=1&key=0acd51d81cb052bc86ece3b3c7a3a4e6206ce1853825f78db237c0fd25463f3fa0af9c03049df29172794d4501cf371b&ascene=1&uin=MTUwODE2MTAyMg==&devicetype=Windows%207&version=61020019&pass_ticket=udTO/tgBCGdrP8bPjAFVZ/%20EaFhtMKUoZH8WB5E2gLeAnX9Ors0PgONBKEihQx9b&from=timeline&isappinstalled=0';
// // $url = 'http://mp.weixin.qq.com/s?__biz=MzAwNjUzNzgwMA==&mid=209242507&idx=1&sn=7495d50cde369d307496f775a42a7448#rd';
// $r = strpos($url,'http://mp.weixin.qq.com') == 0;
// var_dump($r);
// $url = 'aHR0cDovL21tYml6LnFwaWMuY24vbW1iaXova0hXa2ljU3NrM1E0d3lDa1RVU3dnVjFQMkZFUEhVQTFpYVVlVjFVRUNpYlIzZjlXMWlja3psNnNob3BVaE9RNkJFRkV0b3l2aWFEcHZ1UFlKbEs0RzVSTTJxZy8wP3d4X2ZtdD1qcGVn';
// $jpg_pos =  strrpos($url,'.jpg');
// var_dump($jpg_pos);
// if($jpg_pos){
//   $url =  substr($url,0,$jpg_pos);  
// }

// var_dump($url);
// 
// $biz = array(0=>'1');
// echo isset($biz[1]) ? $biz[1] : 'no sth.';
// 
$str = '<p dir="ltr">&lt;script&gt;alert(1);&lt;/script&gt;</p>';
echo htmlspecialchars(urldecode($str),ENT_NOQUOTES);

 ?>