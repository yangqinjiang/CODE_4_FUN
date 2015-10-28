<?php 

$redis = new redis();  
$result = $redis->connect('127.0.0.1', 6379);  
var_dump($result); //结果：bool(true)  
$result = $redis->set('test',"11111111111");  
var_dump($result);    //结果：bool(true)  
$result = $redis->get('test');  
var_dump($result);   //结果：string(11) "11111111111"
 ?>