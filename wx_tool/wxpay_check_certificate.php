<?php


//http://php.net/manual/zh/function.getopt.php
$opt = getopt('m:k:');

if(!isset($opt['m'],$opt['k'])){
	echo '参数不完整~';
	echo "
用法: 
	调用微信支付沙箱环境的API接口验证
	php 本文件名 -m 微信支付商户号mch_id -k 商户支付密钥Key
	参考: https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=23_4
	";
	exit(1);
}

/**
 * 微信支付HTTPS服务器证书验证工具
 * 参考：https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=23_4
 * @Author carson
 */

// 微信配置信息
$config = [
    // 微信支付商户号
    'mch_id' => $opt['m'],
    // 随机字符串
    'nonce_str' => '123456',
    // 商户支付密钥Key
    'key' => $opt['k'],
];

echo sprintf('当前微信配置信息 mch_id=%s... , key=%s... ',substr($opt['m'], 0,10),substr($opt['k'], 0,10)) ."\n";
echo "开始验证...\n";
/**************************************************************
 *    ！！！！！！    此处以下代码，可以忽略    ！！！！！！
 *************************************************************/

// 非空参数值的参数按照参数名ASCII码从小到大排序（字典序）
$config_str = http_build_query($config, '', '&') ;

// 对数据MD5运算，再将得到的字符串所有字符转换为大写
$config['sign'] = strtoupper(md5($config_str));

// 移除商户支付密钥Key
unset($config['key']);

// 将请求数据格式化为XML
$data = arrayToXml($config);

// 发送curl请求，并返回
$res = curl('https://apitest.mch.weixin.qq.com/sandboxnew/pay/getsignkey', $data);

// 转换返回数据格式
$result = xmlToArray($res);
echo "验证结束,结果如下:\n";
// 显示验证结果
if ($result['return_code'] == 'SUCCESS') {
    print( "\n恭喜你~当前服务器通过微信支付证书验证\n");
} else {
    print( "\n\t警告!!!当前服务器未通过微信支付证书验证,请按微信官方指引更新服务器证书\n");
}


function curl($url, $data)
{
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, false);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //设置post方式提交
    curl_setopt($curl, CURLOPT_POST, true);
    //设置post数据
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    //执行命令
    $data = curl_exec($curl);
    //关闭URL请求
    curl_close($curl);
    //显示获得的数据
    return $data;
}

/**
 * 数组转XML
 * @param $arr
 * @return string
 */
function arrayToXml($arr)
{
    $xml = "<xml>";
    foreach ($arr as $key => $val) {
        if (is_numeric($val)) {
            $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
        } else {
            $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
    }
    $xml .= "</xml>";
    return $xml;
}

/**
 * 将XML转为array
 * @param $xml
 * @return bool|mix|mixed|string
 */
function xmlToArray($xml)
{
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $values;
}