<?php 

/**
 * 简单对称加密算法之加密
 * @param String $string 需要加密的字串
 * @param String $skey 加密EKY
 * @author Anyon Zou <zoujingli@qq.com>
 * @date 2013-08-13 19:30
 * @update 2014-10-10 10:10
 * @return String
 */
function encode($string = '', $skey = 'cxphp') {
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key < $strCount && $strArr[$key].=$value;
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
}

/**
 * 简单对称加密算法之解密
 * @param String $string 需要解密的字串
 * @param String $skey 解密KEY
 * @author Anyon Zou <zoujingli@qq.com>
 * @date 2013-08-13 19:30
 * @update 2014-10-10 10:10
 * @return String
 */
function decode($string = '', $skey = 'cxphp') {
    $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key <= $strCount && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
    return base64_decode(join('', $strArr));
}

// $str = '56,15123365247,54,四大古典风格';
// $str = 'http://mmbiz.qpic.cn/mmbiz/0lhibjA95Mu0xBoshUwljFBxq8pEkvkGXFEb5IpEEyHRjb9eyOhqQYM14TOpJQJu2CUMAHiakdP5zWqtW9ib7neyw/640?tp=webp&wxfrom=5'.time();
$str = 'http';
echo "string : " . $str . " \n";
echo "encode : " . ($enstring = encode($str)) . "\n";
echo "decode : " . decode($enstring)."\n";
$r = $str == decode($enstring);
var_dump($r);


echo md5('123');
die();



 ?>