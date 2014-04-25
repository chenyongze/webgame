<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>神雕网络-<{$login_info.game_name}>-<{$login_info.server_name}></title>
<link href="<{$smarty.const.STATIC_URL}>css/gametoolbar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<{$smarty.const.STATIC_URL}>js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<{$smarty.const.STATIC_URL}>js/jquery/jquery.cookie.js"></script>
<script type="text/javascript" src="<{$smarty.const.STATIC_URL}>js/jquery/jquery.scroll.js"></script>
<script type="text/javascript"> 
var hasTop = false;
var hasLeft = true;

function gameResize(isTopDisplay){
	topHeight = isTopDisplay ? 35 : 4;
	var windowHeight = $(document).height();
	var gameHeight = windowHeight-topHeight;
	if(gameHeight<620){
		$("#game").height(620);
	}else{
		$("#game").height(gameHeight);
	}	
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
	var title = "<{$login_info.game_name}>";
	var url = "<{$login_info.game_url}>";
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
	var game_id = "<{$login_info.game_id}>";
	if(game_id == 20 || game_id == 21 || game_id == 22){
		$("#gameLeft").hide();
		$(".left").css({"width":"0px"});
		$(".ctrl").css({"background-position":"0 0"});
		$(".content").hide();
		$("#contBox .right").css({"margin-left": "0px"});
	}
	
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
		hasTop = false;
		gameResize(hasTop); 
	});
	//显示顶部工具条
	$(".show_bar").click(function(){
		$("#header").show();
		$(".show_bar").hide();
		hasTop = true;
		gameResize(hasTop); 
	});
	//顶部工具条中的收藏按钮
	$("#link-favorite").click(function(){
		addToFavorite();
		window.onbeforeunload = null;
		return false;
	});
	$("#header").hide();
	$(".show_bar").show();
	gameResize(hasTop);
});
function addfavorite(url, title){
   if( getCookie("favorite") != null ){
       return;
   }
   
   if (document.all){// ie
   var ua = navigator.userAgent.toLowerCase();
if(ua.indexOf("msie 8")>-1){
  external.AddToFavoritesBar(url, title, title);
}else{ 
      window.external.addFavorite(url, title);
   }
   }else if (window.sidebar){// firefox
      window.sidebar.addPanel(title, url, "");
   }else if(window.opera && window.print) { // opera
      var elem = document.createElement('a');
      elem.setAttribute('href',url);
      elem.setAttribute('title',title);
      elem.setAttribute('rel','sidebar');
      elem.click();
   }
   setCookie("favorite", true);
}
function setOnBeforeUnloadFunction(load){
	if( load ){
		window.onbeforeunload = function(){
	    	alert("欢迎再回到《热血武林》的侠肝义胆武侠世界！\n《热血武林》－中国最纯正金庸武侠页游");
		}
	}
}
function setLeaveTip(tip){
	if( tip.length > 0 ){
		window.onbeforeunload = function(e){
			if (document.all){// ie
				// IE下，仅在关闭时弹出提示，刷新时不弹出
				if(event.clientX>document.body.clientWidth && event.clientY<0 ||event.altKey) {            
   					return tip;
   				}else if(event.clientY > document.body.clientHeight || event.altKey){
   					return tip;
   				}
   			}else if (window.sidebar){// firefox
   				// firefox没找到方法            
   				alert(tip);		
   			}									
		}
	}else{
		window.onbeforeunload = function(e){};
	}
}
</script>
</head>
<body style="background:#000;" onResize="gameResize(hasTop);" >
<div class="wrap" style="overflow:auto;">

  <div id="header">
    <ul>
      <li class="rightBorder"><a href="http://www.263wan.com/" target="_blank">263wan首页</a></li>
      <li class="currServer">当前所在服务器:<a>[<font color=red><{$login_info.game_name}> | <{$login_info.server_name}></font>]</a></li>
      <li class="update"> <span>&nbsp;</span>
      	<script type="text/javascript" src="/js/game/gonggao_<{$login_info.game_id}>.js"></script>  
      </li>
    </ul>
    <script type="text/javascript">
		var news = new Scroller({line:1,speed:1000,timer:4000,Obj:$("#gonggao")});
	</script>
    <ol>
      <li><a href="http://50.263wan.com/" target="_blank" id="link-home">官网首页</a><span>&nbsp;</span></li>
      <li><a href="http://hd.263wan.com/20111226/" target="_blank" id="link-gift">礼包</a><span>&nbsp;</span></li>
      <li><a href="http://pay.263wan.com/" target="_blank" id="link-pay">充值</a><span>&nbsp;</span></li>
      <li><a href="#" target="_self" id="link-favorite" style="color:#F00;">加入收藏</a><span>&nbsp;</span></li>
      <li><a href="http://www.263wan.com/" target="_blank" id="link-51wan">263wan首页</a><span>&nbsp;</span></li>
      <li class="shutBar"><a href="#"></a></li>
    </ol>
    <div style="clear:both;"></div>
  </div>
   
  <div id="contBox">
    <div class="left" id="gameLeft" >
      <div class="sidebar">
        <div class="content">
          <div class="show_bar" style="height: 12px;"> <a href="#" style="line-height: 12px;">&nbsp;</a>
<!--            <p>显示工具条</p>-->
          </div>
          <script type="text/javascript" src="/js/game/gameinfo_<{$login_info.game_id}>.js"></script>
        </div>
        <div class="ctrl">
          <div class="btn"></div>
        </div>
      </div>
    </div>
    <div class="right">
      <iframe id="game" src="<{$url}>" style="width:100%; text-align:center; margin: 0 auto;" name="game" marginwidth="0" marginheight="0" scrolling="no" frameborder="no" allowtransparency="true"></iframe>
    </div>
  </div>
</div>
<div style="display: none;">
</div>
</body>
</html>
