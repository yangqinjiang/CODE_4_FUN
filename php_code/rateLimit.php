<?php
/**
 * 限流
 */
$ip = '127.0.0.1';//获取用户ip函数
$redis = new Redis();
$ok = $redis->connect('127.0.0.1');
var_dump($ok);
$key = 'SECOND_REQUERY_NUM:'.$ip;
var_dump($key);
$requery_num = $redis->lLen($key);
if ($requery_num > 1) {
    die('Too many requey second');
}
if(!$redis->exists($key)) {
    $redis->rPush($key, $ip);
    $redis->expire($key, 1);
}
$redis->rPushx($key, $ip);
echo 'ok';