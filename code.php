<?php 
header("Content-type: text/html; charset=utf-8");
header('content-type:image/gif'); 
$gd=new gd(80,30,200,200,200);
$a=rand(0,9);
$gd->addstring(5,10,8,0,0,0,$a);
$b=rand(0,9);
$gd->addstring(15,10,8,0,0,0,$b);
$gd->addstring(26,10,8,0,0,0,'+');
$c=rand(0,9);
$gd->addstring(36,10,8,0,0,0,$c);
$d=rand(0,9);
$gd->addstring(46,10,8,0,0,0,$d);
$gd->addstring(56,10,8,0,0,0,'=');
$gd->randdot(100);
$gd->gif();
session_start();
$_SESSION['code']=$a*10+$c*10+$b+$d;
class gd{
	public $img;
	private $width;
	private $height;
	public function __construct($width, $height,$r=0,$g=0,$b=0){
		$this->height=$height;
		$this->width=$width;
		$this->img=imagecreate($width, $height);
		$color=imagecolorallocate($this->img,$r,$g,$b);
		imagefill($this->img, 0,0,$color);
		
	}
	public function addstring($x,$y,$fontsize=5,$r=0,$g=0,$b=0,$str='_'){
		$r=rand(0,150);
		$g=rand(0,150);
		$b=rand(0,150);
		$color=imagecolorallocate($this->img,$r,$g,$b);
		imagestring($this->img,$fontsize,$x,$y,$str,$color);
	}
	public function setbg($r,$g,$b){
		imagefill($this->img, 0,0,$this->setcolor($r,$g,$b));
	}
	public function gif(){
		imagegif($this->img);
	}
	public function randdot($num=100){
		for($i=0;$i<$num;$i++){
		$color=imagecolorallocate($this->img, rand(0,255),rand(0,255),rand(0,255));
		imagesetpixel($this->img, rand(0,$this->width),rand(0,$this->height),$color);
		}
		
	}
}
 ?>