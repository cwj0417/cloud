<?php 
$curget=$_GET['r'];
$route='./files'.$curget;
$scan=scandir($route);
$ref=$_SERVER['HTTP_REFERER'];
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Jin_Private_Cloud</title>
	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	<style>
	.mask{position: absolute;top:0;left: 0;height: 100%;width: 100%;z-index: 999;background: rgba(0,0,0,.5);display: none;}
	.code{position: absolute;top: 35%;left: 35%;z-index: 1000;width:200px;height: 80px;padding: 20px;background:#FFE4C4;display:none;}
	a{text-decoration: none;color: inherit;}
	a:hover{color: #DC143C; background: #B3EE3A;font-weight: bolder;}
	.container{width:1000px;margin:0 auto;background: #eee;}
	.hovershadow:hover{box-shadow: 0 0 5px rgba(0,0,0,.5);}
	.file{width: 40%;height: 1000px;background:#eef;padding: 5%;float: left;}
	.show{width:46%;padding: 2%;height: 1000px;background: #FFFACD;float: left;}
	.file ul{list-style: none;font-family: MicrosoftYahei;}
	.file li{border-bottom: 1px dashed gray;border-left: 4px solid #eef;text-indent: 0.5em;}
	.file li:hover{border-left: 4px solid #9AFF9A;background: #D1EEEE;}
	.file span{cursor: pointer;font-size: 14px;color: #AAAAAA;}
	.file span a:hover{color: inherit;}
	.file span:hover{cursor: pointer;color: black;font-weight: bolder;}
	.file .deletefile,.file .deletefolder{font-size: 9px;color:red;}
	</style>
</head>
<body>
	<div class="mask"></div>
	<div class="code hovershadow">
		<p style='font-size:3px;margin:0;'>数死早？点击图片更换验证码</p>
		<img src="./code.php" class='codeimg'>
		<input type="text" class="codeinput" style='height:30px;width:60px;font-size:30px;'><br/>
		<button class="codeconfirm">确定删除</button>
		<button class="codecancel">取消</button>
	</div>
	<input type="hidden" class="route" value='<?php echo $route; ?>'>
	<div class="container">
		<div class="file hovershadow">
			<a href="./loadxml.php" target='if'>云网址</a>
			<button class='newfolder'>新建文件夹</button>
			<form action="upload.php?r=<?php echo $route; ?>" method='post' enctype="multipart/form-data" class='uploadform'>上传文件:<input type="file" class="uploadfile" name='file'></form>
			<p><a href="<?php echo $ref ?>">返回</a>| <a href="?">根目录</a></p>
				<ul>
		<?php 
		if($scan==array('.','..')){
			echo '空目录';
		}else{
			foreach ($scan as $v) {
		if($v!='.'&&$v!='..'){
			$tmp=$route.'/'.$v;
			if(is_dir($tmp)){
				echo '<li><a style="color:#EE4000;font-size:18px;" href="?r='.$curget.'/'.$v.'">'.$v.'</a><span style="float:right;"><a style="color:#AAAAAA;font-size:15px;" href="?r='.$curget.'/'.$v.'">进入目录</a>|<span class="deletefolder" route="./files'.$curget.'/'.$v.'">删除</span></span></li>';
			}else{
				echo '<li>'.$v.'<span style="float:right;"><a target="if" href="http://'.$_SERVER['HTTP_HOST'].'/cloud/files'.$curget.'/'.$v.'">查看</a>|<a style="font-size:12px;color:#6B8E23;" href="./downloadfile.php?n='.$v.'&r=./files'.$curget.'/'.$v.'">下载</a>|<span class="deletefile" route="./files'.$curget.'/'.$v.'">删除</span></span></li>';
			}
		}
	}
		}

	?>
	</ul>
		</div>
		<div class="show hovershadow">
			<iframe width='100%' height='100%' name='if' frameborder="0" id='if'></iframe>
		</div>
		<div style='clear:both;'></div>
	</div>
	
</body>
</html>
<script>
	$(function(){
		$('.uploadfile').change(function(){
			if(!confirm('你确定要上传这个文件么')){
				return false;
			}
			$('.uploadform').submit();
		})
		////////////////////////
		$('.newfolder').click(function(){
			var li=$('<li></li>').addClass('tmp');
			var input=$('<input/>').addClass('tmpinput').css('color','#EE4000').val('新建文件夹');
			$('ul').append(li).append(input);
			$('.tmpinput').select().blur(function(){
				var content=$(this).val();
				if(content!='新建文件夹'){
					var route=$('.route').val();
					$.post('./createfolder.php',{route:route,foldername:content},function(data){
						if(data=='yjcz'){
							alert('文件夹重名');
							$('.tmp').remove();
							$('.tmpinput').remove();
						}else if(data=='ok'){
							location.reload(true);
						}
					})
				}else{
					$('.tmp').remove();
					$('.tmpinput').remove();
				}
			})
		})
		///////////////////////
		$('.codeimg').click(function(){
			$(this).attr('src','./code.php');
		})
		//////////
		$('.codeconfirm').attr('disabled','true');
		$('.codeinput').keyup(function(){
			var code=$(this).val();
			$.post('./check.php',{code:code},function(data){
				if(data=='ok'){
					$('.codeconfirm').attr('disabled',false);
				}else{
					$('.codeconfirm').attr('disabled','true');
				}
			})
		})
		/////////////////////
		var deleteroute='';
		$('.deletefile').click(function(){
			deleteroute=$(this).attr('route');
			$('.mask').show();
			$('.code').show();
		})
		//////
		$('.codecancel').click(function(){
			$('.mask').hide();
			$('.code').hide();
		})
		////
		$('.deletefolder').click(function(){
			deleteroute=$(this).attr('route');
			alert('你的操作将会删除文件夹下所有子文件夹及文件请慎重操作');
			$('.mask').show();
			$('.code').show();
		})
		//////////////////////////////
		$('.codeconfirm').click(function(){
			$.post('./deletef.php',{route:deleteroute},function(data){
				alert(data);
				location.reload(true);
			})
		})
	})
</script>
