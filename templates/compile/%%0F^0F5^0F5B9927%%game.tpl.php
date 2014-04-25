<?php /* Smarty version 2.6.14, created on 2011-12-14 18:42:39
         compiled from game.tpl */ ?>
﻿<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>神雕网络-<?php echo $this->_tpl_vars['login_info']['game_name']; ?>
-<?php echo $this->_tpl_vars['login_info']['server_name']; ?>
</title>
<link href="<?php echo @STATIC_URL; ?>
css/gametoolbar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo @STATIC_URL; ?>
js/jquery/jquery.js"></script>
<script type="text/javascript" src="<?php echo @STATIC_URL; ?>
js/jquery/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo @STATIC_URL; ?>
js/jquery/jquery.scroll.js"></script>
<script type="text/javascript"> 
var hasTop = 1;
var hasLeft = 1;

function gameResize(isTopDisplay){
	topHeight = isTopDisplay ? 35 : 4;
	var windowHeight = $(document).height();
	$("#game").height(windowHeight-topHeight);
}

//提示，如防沉迷
function message(msg){
	if (msg == '') {
		return true;
	}
	alert(msg);
}

//添加到收藏夹
function addToFavorite(){
	var title = "<?php echo $this->_tpl_vars['login_info']['game_name']; ?>
";
	var url = "<?php echo $this->_tpl_vars['login_info']['game_url']; ?>
";
	try{
		if(window.sidebar){ 
			window.sidebar.addPanel(title, url, ""); 
		}else if(document.all){
			window.external.AddFavorite(url, title);
		}else if(window.opera && window.print){
			return true;
		}
	}catch(e){
	}
}

//页面初始化
$(document).ready(function(){
	if (hasLeft==0) {
		$("#contBox .right").css({"margin-left": "5px"});
	}
	gameResize();
	if (window.sidebar) {	
	} else if(document.all) {	
	} else {
		$("#link-favorite").parent('li').hide();
	}
	//防沉迷提醒
	//message('尊敬的用户：你未填写身份证实名信息，根据国家网络游戏管理办法，将定义为未成年用户，所有游戏收益减半，仅可体验3小时。');
	//隐藏或显示左侧工具条
	$(".ctrl").toggle(function(){
		$(".left").css({"width":"6px"});
		$(".ctrl").css({"background-position":"-6px 0"});
		$(".content").hide();
		$("#contBox .right").css({"margin-left": "10px"});
	},function(){
		$(".left").css({"width":"120px"});
		$(".ctrl").css({"background-position":"0 0"});
		$("#contBox .right").css({"margin-left": "125px"});
		$(".content").show();
	});
	//隐藏顶部工具条
	$(".shutBar").click(function(){
		$("#header").hide();
		$(".show_bar").show();
	});
	//显示顶部工具条
	$(".show_bar").click(function(){
		$("#header").show();
		$(".show_bar").hide();
	});
	//顶部工具条中的收藏按钮
	$("#link-favorite").click(function(){
		addToFavorite();
		window.onbeforeunload = null;
		return false;
	});
});
</script>
</head>
<body onResize="gameResize(hasTop);" style="background:#000;">
<div class="wrap">
  <div id="header">
    <ul>
      <li class="rightBorder"><a href="http://www.51yx.com/" target="_blank">51yx首页</a></li>
      <li class="currServer">当前所在服务器:<a>[<font color=red><?php echo $this->_tpl_vars['login_info']['game_name']; ?>
 | <?php echo $this->_tpl_vars['login_info']['server_name']; ?>
</font>]</a></li>
      <li class="update"> <span>&nbsp;</span>
      	<script type="text/javascript" src="<?php echo @STATIC_URL; ?>
js/game/gonggao_<?php echo $this->_tpl_vars['login_info']['game_id']; ?>
.js"></script>  
      </li>
    </ul>
    <script type="text/javascript">
		var news = new Scroller({line:1,speed:1000,timer:4000,Obj:$("#gonggao")});
	</script>
    <ol>
      <li><a href="http://50.51yx.com/" target="_blank" id="link-home">官网首页</a><span>&nbsp;</span></li>
      <li><a href="http://hd.51yx.com/20111212/" target="_blank" id="link-gift">礼包</a><span>&nbsp;</span></li>
      <li><a href="http://pay.51yx.com/" target="_blank" id="link-pay">充值</a><span>&nbsp;</span></li>
      <li><a href="#" target="_self" id="link-favorite" style="color:#F00;">加入收藏</a><span>&nbsp;</span></li>
      <li><a href="http://www.51yx.com/" target="_blank" id="link-51wan">51yx首页</a><span>&nbsp;</span></li>
      <li class="shutBar"><a href="#"></a></li>
    </ol>
    <div style="clear:both;"></div>
  </div>
  <div id="contBox">
    <div class="left">
      <div class="sidebar">
        <div class="content">
          <div class="show_bar"> <a href="#">&nbsp;</a>
            <p>显示工具条</p>
          </div>
          <script type="text/javascript" src="<?php echo @STATIC_URL; ?>
js/game/gameinfo_<?php echo $this->_tpl_vars['login_info']['game_id']; ?>
.js"></script>
          <ul class="link">
            <li>010-82618868</li>
          </ul>
        </div>
        <div class="ctrl">
          <div class="btn"></div>
        </div>
      </div>
    </div>
    <div class="right">
      <iframe id="game" src="<?php echo $this->_tpl_vars['url']; ?>
" style="width:100%;height:760px; text-align:center; margin: 0 auto;" name="game" marginwidth="0" marginheight="0" scrolling="auto"  frameborder="no" allowtransparency="true"></iframe>
    </div>
  </div>
</div>
</body>
</html>