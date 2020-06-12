<?php 

function do_post($url, $keysArr='',$format_json=true, $flag = 0){
    $ch = curl_init();
    $this_header = array(
        "charset=UTF-8"
        );

    curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
    if(! $flag) curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    curl_setopt($ch, CURLOPT_POST, TRUE); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $keysArr); 
    curl_setopt($ch, CURLOPT_URL, $url);
    $ret = curl_exec($ch);
    curl_close($ch);
    if($format_json){
        $r =  json_decode($ret);
        //返回数据正确
        if(json_last_error() === JSON_ERROR_NONE){
            return true;
        }
        return $r;
        
    }
    return $ret;
}
function do_get($url, $keysArr='',$format_json=true, $flag = 0){
    $ch = curl_init();
    $this_header = array(
        "charset=UTF-8"
        );

    curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
    if(! $flag) curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    curl_setopt($ch, CURLOPT_URL, $url);
    $ret = curl_exec($ch);
    curl_close($ch);
    if($format_json){
        $r =  json_decode($ret);
        //返回数据正确
        if(json_last_error() === JSON_ERROR_NONE){
            return true;
        }
        return $r;
        
    }
    return $ret;
}