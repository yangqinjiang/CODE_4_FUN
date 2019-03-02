<?php
// 打开目录
// 读取目录当中的文件
// 如果文件类型是目录,继续打开目录
// 读取子目录的文件
// 如果文件类型是文件,输出文件名称
//关闭目录
function loopDir($dir){
    $handle = opendir($dir);
    if(false === $handle){
        return;
    }
    while ( false !== ($file = readdir($handle))){
        if($file != '.' && $file != '..'){
            echo $file . "\n";
            //
            $filepath = $dir . '/' . $file;
            if (filetype($filepath) == 'dir'){
                loopDir($filepath);
            }
        }
    }
    closedir($handle);//关闭目录句柄

}
$dir = './test';
loopDir($dir);