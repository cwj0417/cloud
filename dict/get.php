<?php 
header("Content-type:text/html;charset=utf-8");
$res=file_get_contents('http://dict.cn/'.$_GET['word']);
//var_dump($res);
$pat='/<li><span>(.*)<\/span><strong>(.*)<\/strong><\/li>/';
preg_match($pat, $res,$res);
//var_dump($res);
if(empty($res)){
	echo '查无此词';
}else{
	echo $res[0];
}
 ?>