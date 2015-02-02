<?php 
$filename=$_FILES['file']['name'];
$route=$_GET['r'].'/'.$filename;
if(!file_exists($route)){
	$res=move_uploaded_file($_FILES['file']['tmp_name'], $route);

}
header('location:'.$_SERVER['HTTP_REFERER']);
 ?>