<?php
// 请匹配所有img标签中的src值
$str = '<img alt="高清无码" id="av" src="av.jpg" /><img alt="高清无码" id="bv" src="bv.jpg" />';
$pattern = '/<img.*?src="(.*?)".*?\/?>/i'; // /忽略大小写
preg_match_all($pattern,$str,$match);
var_dump($match);