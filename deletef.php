<?php 
$route=$_POST['route'];
if(is_file($route)){
	if(unlink($route)){
		echo '文件删除成功';
	}else{
		echo '文件删除失败';
	}
}else{
	if(deletefolder($route)){
		echo '文件夹删除成功';
	}else{
		echo '文件夹删除失败';
	}
}
function deletefolder($dir){
	$res=scandir($dir);
	array_shift($res);
	array_shift($res);
	if(empty($res)){
		if(rmdir($dir)){
			return true;
		};
		
	}else{
		foreach($res as $v){
			$v=$dir.'/'.$v;
			if(is_file($v)){
				if(!unlink($v)){
					return false;
				};
			}else{
				deletefolder($v);
			}
		}
		if(rmdir($dir)){
			return true;
		};
	}
}
 ?>