<?php
header("Content-type:text/html;charset=utf-8");
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("RESULT", "Result");
// require ROOT.'/Core/autoload.php';
require './Core/autoload.php';




if (php_sapi_name()==='cli') {
 	exec("utf8.bat");
 }

// // 记录 采集出的结果
// // $Result = Curl::url('http://www.47nvnv.com/list/13.html')->match(['img'=>'src'])->get();
$Result = Curl::url('http://699pic.com/?sem=1')->match(["img"=>"/<img.*?data-original=[\"|'](.*?)[\"|']/"])->get();
$address = RESULT.'/'.$Result['domain'];
if (!file_exists($address)) {
	echo '创建:'.$address."\n";
	mkdir($address);
 } 


if (!is_array($Result)) {
	
}else{
		foreach ($Result['result'] as $key => $value) {
			
			if (!file_exists($address."/".$key)) {
				echo '创建文件:'.$key.", 位置:./".$address."\n";
				mkdir($address."/".$key);
			 } 

			if(is_array($value)){
				foreach ($value as $k => $v) {
							$after = getSuffix($v, '.jpg');
							$newfile = $address."/".$key."/".$k.$after;	//新建文件 
							$fileIncretion = Curl::url($v)->getdata();	//文件内容
							$filesize = format_bytes(strlen($fileIncretion));// 所需下载文件 大小
							// echo "文件: ".$v."下载开始. \n";
								// $newIncretion = strArray($fileIncretion,$i);
								$fileall = str_split($fileIncretion,1024*10);
								$Pall = 100/count($fileall);
									foreach ($fileall as $filek => $filev) {

										if(File::run($newfile, $filev)->get()){
											Process($newfile, $Pall*($filek+1));
										}else{
											die('文件写入失败');
										}
									}
								echo "\n";
							if (filesize($newfile)>=$filesize) {
								echo "下载成功, 下载地址:".$newfile."\n";
							}else{
								die("下载失败, 下载地址:".$newfile."\n");
							}
							
				}		
			}
		
		}
}

	

?>
