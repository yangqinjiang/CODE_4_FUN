<?php
// 请匹配所有img标签中的src值
$str = '<img alt="高清无码" id="av" src="av.jpg" />';
$pattern = '/<img.*?src="(.*?)".*?\/?>/i'; // /忽略大小写
preg_match($pattern,$str,$match);
var_dump($match);