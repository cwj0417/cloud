<?php 

$route=$_GET['r'];
$name=$_GET['n'];
header("Content-type: text/plain");
header("Accept-Ranges: bytes");
header("Content-Disposition: attachment; filename=".$name);
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("Pragma: no-cache" );
header("Expires: 0" ); 
readfile($route);
 ?>