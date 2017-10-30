<?php

// //  文件大小
function format_bytes($size) { 
	$units = array(' B', ' KB', ' MB', ' GB', ' TB'); 
	for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024; 
	return round($size, 2).$units[$i]; 
} 


function getSuffix($url, $default)
{
	// 获取文化名
	$filename = ltrim(strrchr($url, "/"), "/");
    $after = !empty($filename)? strrchr($filename, "."):'';
    if (empty($after)) {
    	$after = $default;
    }
    return $after;
}


function Process($filename, $now){
	$i = $now;
	$total = 100;
	$result = ' Download';
		if ($i==100) {
			$result = ' Done';
		}
	  printf("%s progress: [%-50s] %d%% %s\r", $filename,str_repeat('#',$i/$total*50), $i/$total*100, $result);
}
