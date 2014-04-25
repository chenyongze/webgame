<?php
/**
 *  LM RSS Feed 生成程序
 *checkCode.class.php --验证码--
 * ============================================================================
 * 版权所有 (C) 2006-2008 蓝梦桌面资源，并保留所有权利。
 * 网站地址: http://www.lmpic.cn
 * ============================================================================
 * *author:     Hacker <bokeef*163.com>
 * *version:    v2.0
 * ---------------------------------------------
*/

class validn{
	/**
	 * 字体文件
	 */
	var $fontFile;
	/**
	 * 字体大小
	 *
	 * @var unknown_type
	 */
	var $fontSize=12;
	/**
	 * 验证码长度
	 */
	var $codelength;
	/**
	 * 验证高度
	 */
	var $height;
	/**
	 * 验证码宽度
	 */
	var $width;
	/**
	 * 是否打开随机角度
	 * 0 off
	 * 1 on
	 */
	var $is_randAngel=1;
	/**
	 * 是否启用随机色彩
	 * 0,off
	 * 1,on
	 */
	var $is_color;
	/**
	 * 验证码字符类型
	 * 0,纯数字
	 * 1，纯字母
	 * 2，数字和字母
	 * 3，纯中文
	 * 4，数字，字母，中文混合
	 * 5，字母，中文混合
	 * 6，数字，中文混合
	 */
	var $checkCodeType=2;
	var $dst_img;
	/**
	 * 干扰素
	 */
	var $varinter=50;
	var $is_interfere=1;
	/**
	 * 随机字母发生器
	 *
	 * @param unknown_type $length
	 * @return unknown
	 */
	function randABC($length){
		$ABCarray=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
		$ABClength=count($ABCarray);
		$tempStr='';
		for ($i=0;$i<$length;$i++){
			$randnumber=rand(0,$ABClength-1);
			$tempStr.=$ABCarray[$randnumber];
		}
		return $tempStr;
	}
	
	/**
	 * 随机字母发生器
	 *
	 * @param unknown_type $length
	 * @return unknown
	 */
	function randN($length){
		$ABCarray=array("0","1","2","3","4","5","6","7","8","9");
		$ABClength=count($ABCarray);
		$tempStr='';
		for ($i=0;$i<$length;$i++){
			$randnumber=rand(0,$ABClength-1);
			$tempStr.=$ABCarray[$randnumber];
		}
		return $tempStr;
	}	
	/**
	 * 随机数字发生器
	 *
	 * @param unknown_type $length
	 */
	function randNumber($length){
		$randTmp='';
		for($i=0;$i<$length;$i++){
			$randTmp.=	rand(0,9);
		}
		return $randTmp;
	}
	/**
	 * 随机数字与字母发生器||
	 * @param int $length
	 * @return $strtmp;
	 */
	function randA_N($length){
		$strArray=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9");
		$strlen=count($strArray);
		$strtmp='';
		for($i=0;$i<$length;$i++){
			$randtmp=rand(0,$strlen-1);
			$strtmp.=$strArray[$randtmp];
		}
		return $strtmp;
	}
	/**
	 * 随机色彩发生器
	 *
	 * @param unknown_type $colorValue
	 * @return unknown
	 */
	function randColor($length){
		$strArray=array("e","f","0","1","2","3","4","5","6","7","8","9");
		$strlen=count($strArray);
		$strtmp=	'';
		for($i=0;$i<$length;$i++){
			$randtmp=rand(0,$strlen-1);
			$strtmp.=$strArray[$randtmp];
		}
		return $strtmp;
	}
	/**
	 * 初始化顔色值
	 *
	 * @param unknown_type $colorValue
	 * @return unknown
	 */
	function colorX0($colorValue=false,$alpha=false){
		if(preg_match("/([a-z0-9][a-z0-9])([a-z0-9][a-z0-9])([a-z0-9][a-z0-9])/i",$colorValue,$color)){
			$red	=	hexdec($color[1]);
			$green	=	hexdec($color[2]);
			$blue	=	hexdec($color[3]);
		}
		if(isset($alpha)){
			return $color=imagecolorallocatealpha($this->dst_img, $red, $green, $blue,$alpha);
		}
		else return $color=imagecolorallocate($this->dst_img, $red, $green, $blue);
	}
	/**
	 * 产生随机角度
	 *
	 */
	function randAngle(){
		return rand(1,10);
	}
	function pictrues(){
		$this->dst_img=imagecreatetruecolor($this->width,$this->height);
		$randColor	=	$this->randColor(6);
		$color	=	$this->colorX0("#ffffff");
		imagefilledrectangle ($this->dst_img,0, 0, 300, 400,$color);
		switch ($this->checkCodeType){
			case "0":
			break;
			case "1":
			break;
			case "2":	$tmpStr	=	$this->randN($this->codelength);
			break;
			case "3":
			break;
			case "4":
			break;
			case "5":
			break;
			case "6":
			break;
		}
		if($this->is_interfere){
				$this->dst_img=$this->interfere($this->varinter);
		}
		for($i=0;$i<$this->codelength;$i++){
			$angle=$this->randAngle();
			$txtsize	=	imagettfbbox ($this->fontSize,$angle,$this->fontFile, $tmpStr[$i]);
			if(empty($w_x))
				$w_x=($this->width-($this->fontSize*$this->codelength))/2;
			else $w_x+=$this->fontSize;
			$h_y=($this->height-$txtsize[3]-$txtsize[7])/2;
			$stringColor = array(
							imagecolorallocate($this->dst_img,138,0,0),
						   	imagecolorallocate($this->dst_img,53,136,57),
						   	imagecolorallocate($this->dst_img,0,29,198),
						   	imagecolorallocate($this->dst_img,53,255,64),
						   	imagecolorallocate($this->dst_img,255,124,53),
						   	imagecolorallocate($this->dst_img,255,103,21),
						   	imagecolorallocate($this->dst_img,90,198,79),
						   	imagecolorallocate($this->dst_img,167,48,180),
						   	imagecolorallocate($this->dst_img,0,193,227),
						   	imagecolorallocate($this->dst_img,227,0,5),
						   	imagecolorallocate($this->dst_img,0,193,227),
						   	imagecolorallocate($this->dst_img,0,0,0),
						   	imagecolorallocate($this->dst_img,0,12,227));
			if((int)phpversion()>=5){
				imagettftext ($this->dst_img,$this->fontSize,$angle,$w_x, $h_y,$stringColor[rand(0,3)],$this->fontFile,$tmpStr[$i]);
			}
			else{
				imagechar($this->dst_img,20, $w_x, $h_y-8, $tmpStr[$i], $stringColor[rand(0,3)]);
			}
		}
		$_SESSION['validn'] = $tmpStr;
//		$_SESSION['aaaaaa'] = 'fdsafsda';
//		$session->set("valid_number",$tmpStr);
		imagegif($this->dst_img);
		imagedestroy($this->dst_img);				
	}
	/**
	 * 产生干扰束
	 */
	function interfere($max){
		for($i=0;$i<$max;$i++){
			imagesetpixel ( $this->dst_img, rand(0,$this->width), rand(0,$this->height), $this->colorX0($this->randColor(6),20));
			if(rand(0,$this->varinter)%10==0){
				imageline ( $this->dst_img, rand(0,$this->width),rand(0,$this->height), rand(0,$this->width),rand(0,$this->height), $this->colorX0($this->randColor(6),80));
			}
		}
		return $this->dst_img;
	}
}


