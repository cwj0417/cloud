<?php 
$route=$_POST['route'];
$foldername=$_POST['foldername'];
$route=$route.'/'.$foldername;
if(is_dir($route)){
	echo 'yjcz';//已经存在
	exit;
}else{
	mkdir($route, 0777);
	chmod($route, 0777);
	echo 'ok';
}
 ?>