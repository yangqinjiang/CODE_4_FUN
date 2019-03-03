<?php
/**
 * 动态语言静态化
 */
    $id = $_GET['id'];
    if(empty($id)){
        $id = '';
    }
    $cache_name = 'runtime/'.md5(__FILE__).'-'.$id.'.html';
    $cache_lifetime=3600;
    if(file_exists($cache_name) &&  //存在缓存文件
    filectime(__FILE__) <= filectime($cache_name) // 缓存文件的修改时间不是最新
    && filectime($cache_name) + $cache_lifetime > time()) //未过期
    {
        include $cache_name;
        exit;
    }
    ob_start();
?>
<b>This is My Script .<?php  echo $id;?></b>
<?php
    $content = ob_get_contents();
    ob_end_flush();
    $handle = fopen($cache_name,'w');
    fwrite($handle,$content);
    fclose($handle);
?>
