<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>urls</title>
	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	<style>
	a{text-decoration: none;color: inherit;}
	.delete{float:right;}
	.p:hover{background: yellow;}
</style>
</head>
<body>
	<?php

if(isset($_POST['des'])){
$xmlObj=simplexml_load_file('./urls.xml');
$size=sizeof($xmlObj->item);
$xmlObj->addChild('item');
$xmlObj->item[$size]->addChild('describe',$_POST['des']);
$xmlObj->item[$size]->addChild('url',$_POST['url']);
file_put_contents('./urls.xml', $xmlObj->asXML());
}
$xmlObj=simplexml_load_file('./urls.xml');
$size=sizeof($xmlObj->item);
for($i=0;$i<$size;$i++){
  echo '<p class="p"><a target="_blank" href="'.$xmlObj->item[$i]->url.'">'.$xmlObj->item[$i]->describe.'</a><a href="./delete.php?i='.$i.'" class="delete">删除</a></p>';
} 
?>
<form action="" method='post'>
	<p>描述<input type="text" name='des' class='content1' value='对网址的描述'onclick='this.select()'></p>
	<p>网址<input type="text" name='url' value='http://www.' onclick='this.select()' class='content2'></p>
	<p><input type="submit" value='谨慎提交' id='add'></p>
</form>
</body>
</html>
<script>
	$(function(){
		$('.delete').click(function(){
			if(!confirm('确定删除么?')){
				return false;
			}
		})
		$('#add').click(function(){
			if(!confirm('确定添加么?')){
				return false;
			}
		})
	})
</script>
