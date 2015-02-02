<?php 
$num=$_GET['i']+0;
$obj=simplexml_load_file('./urls.xml');
unset($obj->item[$num]);
var_dump($obj);
file_put_contents('./urls.xml', $obj->asXML());
header('location:'.$_SERVER['HTTP_REFERER']);
 ?>