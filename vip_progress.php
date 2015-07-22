<?php 
//http://cn2.php.net/manual/zh/function.urldecode.php
function utf8_urldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');
}
 ?>