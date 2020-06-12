<?php 

$r = '<a href="http://baidu.com"></a><img data-s="300,640" data-type="jpeg"  data-original="http://mmbiz.qpic.cn/mmbiz/ZfMh01OHfM7TUibN181dGRBsRVxq4d45LpJNGDDNzS8Ga7iaVVEjH87WGbkxNfrsmibpQD21HHBicIp0XEynnZT5lA/0?wx_fmt=jpeg" data-ratio="0.7032520325203252" data-w="492"  /><img data-s="300,640" data-type="jpeg"  data-original="http://mmbiz.qpic.cn/mmbiz/ZfMh01OHfM7TUibN181dGRBsRVxq4d45LpJNGDDNzS8Ga7iaVVEjH87WGbkxNfrsmibpQD21HHBicIp0XEynnZT5lA/0?wx_fmt=jpg" data-ratio="0.7032520325203252" data-w="492"  /><img data-s="300,640" data-type="jpeg"  data-original="http://mmbiz.qpic.cn/mmbiz/ZfMh01OHfM7TUibN181dGRBsRVxq4d45LpJNGDDNzS8Ga7iaVVEjH87WGbkxNfrsmibpQD21HHBicIp0XEynnZT5lA/0?wx_fmt=png" data-ratio="0.7032520325203252" data-w="492"  />';
 

$reg = "/<img.*?data-original=\"(.*?)\"/i";



$r = preg_replace_callback($reg,function ($matches)
{
    var_dump($matches);
    $all_txt = $matches[0];
    $raw_url = $matches[1];
	//回调
    $replace_raw_url = base64_encode($raw_url);
    return str_replace($raw_url,'http://image.weilianapp.com/i/'.$replace_raw_url ,$all_txt);
},$r);
echo "\n\n";
echo $r;

echo "\n\n\n\n";
$test = 'aHR0cDovL21tYml6LnFwaWMuY24vbW1iaXovWmZNaDAxT0hmTTdUVWliTjE4MWRHUkJzUlZ4cTRkNDVMcEpOR0RETnpTOEdhN2lhVlZFakg4N1dHYmt4TmZyc21pYnBRRDIxSEhCaWNJcDBYRXlublpUNWxBLzA/d3hfZm10PWpwZWc=';

$test = base64_decode($test);

echo $test,"\n";

 ?>

