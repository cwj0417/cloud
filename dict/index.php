<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>dict.cn</title>
	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	<style>
	.wrap{width:340px;height:140px;padding: 10px;box-shadow: 0 0 5px 5px rgba(0,0,125,.5);}
	input{width: 100%;height: 30px;font-size: 25px;}
	body{font-size: 25px;}
	</style>
</head>
<body>

	<div class="wrap">
		<input type="text" class="input" value='input words here'>
	<div class="res"></div>
	</div>
	
	
	
</body>
</html>
<script>
var lastmodify=null;
	$(function(){
		$('input').click(function(){
			$(this).select();
		})
		$('.input').keyup(function(){
			lastmodify=new Date().getTime();
			$('.res').html('查找中……');
			content=$('.input').val();
			setTimeout(function(){
			if(new Date().getTime()-lastmodify>=500&&content!=''){
							$('.res').load('./get.php?word='+$('.input').val());
						}else{
							return;
						}
			},500);
		})
	})
</script>