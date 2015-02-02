<?php 
$route=$_POST['route'];
header('Content-type: text/plain');
readfile($route);




 ?>