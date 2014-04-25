<?php /* Smarty version 2.6.14, created on 2010-10-27 09:45:16
         compiled from index_header.tpl */ ?>
<style>
#dingHeader_s1 div,#dingHeader_s1 dl,#dingHeader_s1 dt,#dingHeader_s1 dd,#dingHeader_s1 ul,#dingHeader_s1 ol,#dingHeader_s1 li,#dingHeader_s1 h1,#dingHeader_s1 h2,#dingHeader_s1 h3,#dingHeader_s1 h4,#dingHeader_s1 h5,#dingHeader_s1 h6,#dingHeader_s1 pre,#dingHeader_s1 form,#dingHeader_s1 fieldset,#dingHeader_s1 input,#dingHeader_s1 textarea,#dingHeader_s1 p,#dingHeader_s1 blockquote,#dingHeader_s1 th,#dingHeader_s1 td,#dingHeader_s1 iframe 
	{ margin:0;padding:0;}
#dingHeader_s1 div,#dingHeader_s1 td
	{ font-size: 12px; font-family: "宋体","黑体","微软雅黑",Tahoma, Verdana, Arial, sans-serif; line-height: 1.4em; color: #333333; text-align: left; }
#dingHeader_s1 fieldset,#dingHeader_s1 img { border:0; }
#dingHeader_s1 address,#dingHeader_s1 caption,#dingHeader_s1 cite,#dingHeader_s1 code,#dingHeader_s1 dfn,#dingHeader_s1 em,#dingHeader_s1 th,#dingHeader_s1 var 
	{ font-style:normal; font-weight:normal; }
#dingHeader_s1 ol,#dingHeader_s1 ul { list-style:none; }
#dingHeader_s1 caption,#dingHeader_s1 th {text-align:left; }
#dingHeader_s1 h1,#dingHeader_s1 h2,#dingHeader_s1 h3,#dingHeader_s1 h4,#dingHeader_s1 h5,#dingHeader_s1 h6 { font-size:100%; font-weight:normal; }
#dingHeader_s1 ul:after { clear: both; content: "."; display: block; height: 0; visibility: hidden; }
#dingHeader_s1 dl:after { clear: both; content: "."; display: block; height: 0; visibility: hidden; }

#dingTop_s1 { height: 29px; border-bottom: solid 1px #e6e6e6; background-color: #f3f3f3;}
#dingHeader_s1 { width: 950px; height: 29px; margin: 0 auto; color: #666; font-size: 12px;}
#dingHeader_s1 a,#dingHeader_s1 a:visited { display: block; height: 29px; margin: 0 auto; color: #666; font-size: 12px; text-decoration: none;}
#dingHeader_s1 a:hover { color: #ff6600; text-decoration: none;}
#dingHeader_s1 #dingTopLogo_s1 { float: left; width: 19px; height: 29px; background: url(<?php echo @STATIC_URL; ?>
images/header/ding_top_s1.gif) no-repeat left 5px; margin-left: 10px;}
#dingHeader_s1 #dingTopLogo_s1 a { display: block; width: 19px; height: 17px; overflow: hidden; text-indent: -100px; margin-top: 6px;}
#dingHeader_s1 #dingNavL_s1 { float: left; width: 200px;}
#dingHeader_s1 #dingNavL_s1 li { float: left; height: 29px; line-height: 29px; text-align: center; background: url(<?php echo @STATIC_URL; ?>
images/header/ding_top_s1.gif) no-repeat left -81px;}
#dingHeader_s1 #dingNavL_s1 li.dingTopNobg_s1 { background: none;}
#dingHeader_s1 #dingNavL_s1 li.dingTopLogo_s1 { width: 55px;}
#dingHeader_s1 #dingNavL_s1 li.dingTopGame_s1 { width: 100px;}
#dingHeader_s1 #dingNavL_s1 li.dingTopGame_s1 a.domgTopGameA_s1 { display: block; width: 80px; background: url(<?php echo @STATIC_URL; ?>
images/header/ding_top_s1.gif) no-repeat 55px -18px; text-align: left;}
#dingHeader_s1 #dingNavL_s1 li.dingTopSe_s1 { width: 45px;}
#dingHeader_s1 #dingNavL_s1 li.dingTopSe_s1 a,#dingHeader_s1 #dingNavL_s1 li.dingTopSe_s1 a:visited {  height: 29px; line-height: 29px; width: 40px; display: block; vertical-align: bottom;}
#dingHeader_s1 #dingNavL_s1 li.dingTopSe_s1 a:hover { color: #ff6600;}

#dingHeader_s1 .dingNavL_s1 { float: left; width: 220px;}
#dingHeader_s1 .dingNavL_s1 li { float: left; height: 29px; line-height: 29px; text-align: center; background: url(<?php echo @STATIC_URL; ?>
images/header/ding_top_s1.gif) no-repeat left -81px;}

#dingHeader_s1 #dingNavL_s1 li.dingTopWowo_s1 { width: 70px;}
#dingHeader_s1 #dingNavL_s1 li.dingTopWowo_s1 a,#dingHeader_s1 #dingNavL_s1 li.dingTopWowo_s1 a:visited {  height: 29px; line-height: 29px; width: 55px; display: block; vertical-align: bottom; background: url(<?php echo @STATIC_URL; ?>
images/header/new.gif) no-repeat right center; text-align: left; text-indent: 2px;}
#dingHeader_s1 #dingNavL_s1 li.dingTopWowo_s1 a:hover { color: #ff6600;}

#dingHeader_s1 #dingNavR_s1 { float: right; width: 370px;}
#dingHeader_s1 #dingNavR_s1 li { height: 29px; float: left; line-height: 29px; text-align: center; background: url(<?php echo @STATIC_URL; ?>
images/header/ding_top_s1.gif) no-repeat left -81px;}
#dingHeader_s1 #dingNavR_s1 li.dingTopNobg_s1 { background: none;}
#dingHeader_s1 #dingNavR_s1 li.dingTopUserCenter_s1 { width: 100px;}
#dingHeader_s1 #dingNavR_s1 li.dingTopUserCenter_s1 a { display: block; width: 80px; height: 29px; background: url(<?php echo @STATIC_URL; ?>
images/header/ding_top_s1.gif) no-repeat 65px -18px; text-align: left; text-indent: 10px;}
#dingHeader_s1 #dingNavR_s1 li.dingTopRecharge_s1 { width: 65px;}
#dingHeader_s1 #dingNavR_s1 li.dingTopRecharge_s1 a { display: block;  background: url(<?php echo @STATIC_URL; ?>
images/header/ding_top_s1.gif) no-repeat left -54px; width: 45px; height: 29px; text-align: right;}
#dingHeader_s1 #dingNavR_s1 li.dingTopSysmsg_s1 a { width: 80px;}
#dingHeader_s1 #dingNavR_s1 li.dingTopSysmsg_s1 a { margin: 0 10px; color: #ff6600;}
#dingHeader_s1 #dingNavR_s1 li.dingTopSysmsg_s1 a.color666 { color: #666;}
#dingHeader_s1 #dingNavR_s1 li.dingTopHelp_s1 { width: 43px;}
#dingHeader_s1 #dingNavR_s1 li.dingTopQuit_s1 { width: 60px;}
#dingHeader_s1 #dingNavR_s1 li.dingTopQuit_s1 a { width: 45px; height: 21px; display: block; text-align: center; line-height: 22px; background: url(<?php echo @STATIC_URL; ?>
images/header/ding_top_s1.gif) no-repeat left -120px; overflow: hidden; margin-top: 4px;}
#dingHeader_s1 #dingNavR_s1 li.dingTopLogin_s1 { width: 83px;}
#dingHeader_s1 #dingNavR_s1 li.dingTopLogin_s1 p { width: 73px; margin-left: 10px; background: url(<?php echo @STATIC_URL; ?>
images/header/ding_top_s1.gif) no-repeat left -150px; height: 21px; line-height: 21px; margin-top: 4px;}
#dingHeader_s1 #dingNavR_s1 li.dingTopLogin_s1 p a { display: inline-block; float: left; margin-left: 10px; height: 18px; line-height: 18px; margin-top: 1px;}

#dingHeader_s1 .dingTopGame_s1 #dingTopGameBox_s1 { width: 202px; _width: 210px; border: solid 1px #ccc; position: absolute; z-index: 999; background-color: #fff; display: none; }
#dingHeader_s1 .dingTopGame_s1 .dingTopGameTab_s1 { width: 88px; height: 22px; border: solid 1px #ccc; border-bottom: 0; text-align: center; position: absolute; *position: relative; top: -23px; left: -1px; background-color: #fff;}
#dingHeader_s1 .dingTopGame_s1 .dingTopGameTab_s1 a {display: block; width: 80px; height: 22px; line-height: 22px; background: url(<?php echo @STATIC_URL; ?>
images/header/ding_top_s1.gif) no-repeat 55px -21px; text-align: left; margin: 0 auto; color: #ff6600; text-decoration: none;}
#dingHeader_s1 .dingTopGame_s1 #dingTopGameBox_s1 dl { width: 90px; margin: 5px; float: left; *margin-top: -18px; }
#dingHeader_s1 .dingTopGame_s1 #dingTopGameBox_s1 dl dt { width: 88px; height: 20px; line-height: 20px; background-color: #f3f3f3; border: 1px solid #e2e2e2; text-align: center; }
#dingHeader_s1 .dingTopGame_s1 #dingTopGameBox_s1 dl dd a,#dingHeader_s1 .dingTopGame_s1 #dingTopGameBox_s1 dl dd a:visited 
	{ display: block; width: 90px; height: 20px; line-height: 20px; text-indent: 2px; background: none; text-align: left;}
#dingHeader_s1 .dingTopGame_s1 #dingTopGameBox_s1 dl dd a:hover { text-decoration: none; color: #666; background-color: #ffe0c5;}


#dingTopUserBox_s1 { width: 160px; border: solid 1px #ccc; position: absolute; z-index: 999; background-color: #fff; display: none;}
.dingTopUserTab_s1 { width: 80px; height: 22px; border: solid 1px #ccc; border-bottom: 0; position: absolute; *position: relative; left: -1px; top: -23px; background-color: #fff;}
#dingHeader_s1 #dingNavR_s1 li.dingTopUserCenter_s1 .dingTopUserTab_s1 a { width: 80px; height: 22px; line-height: 22px; color: #ff6600; background: url(<?php echo @STATIC_URL; ?>
images/header/ding_top_s1.gif) no-repeat 65px -21px; }
#dingHeader_s1 .dingTopUserCenter_s1 #dingTopUserBox_s1 dl { width: 120px; margin: 0px 20px 0px 20px; padding: 10px 0 5px 0; background: url(<?php echo @STATIC_URL; ?>
images/header/dingtop_bg_xian.gif) repeat-x left bottom;}
#dingHeader_s1 .dingTopUserCenter_s1 #dingTopUserBox_s1 dl.dingTopMT18_s1 { *margin-top: -18px; }
#dingHeader_s1 .dingTopUserCenter_s1 #dingTopUserBox_s1 dl dt { width: 120px; font-weight: bolder; color: #333; text-align: left;}
#dingHeader_s1 .dingTopUserCenter_s1 #dingTopUserBox_s1 dl dd { width: 60px; float: left; height: 20px;}
#dingHeader_s1 .dingTopUserCenter_s1 #dingTopUserBox_s1 dl dd a,#dingHeader_s1 .dingTopGame_s1 #dingTopUserBox_s1 dl dd a:visited 
	{ display: block; width: 60px; height: 20px; line-height: 20px; text-indent: 2px; background: none;}
#dingHeader_s1 .dingTopUserCenter_s1 #dingTopUserBox_s1 dl dd a:hover {text-decoration: none; color: #666; background-color: #ffe0c5;}
#dingHeader_s1 .dingTopUserCenter_s1 #dingTopUserBox_s1 dl.nobg_s1 { background: none;}

/*hzc 10.09.06*/
#fadeInPlaygame a:link {color:#ff6600;}
/* dingtop end */
</style>

<script type="text/javascript">
	var headerPlaygameIndex = 0;
	var headerPlaygame = new Array();
	<?php $_from = $this->_tpl_vars['headerPlaygame']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['playgameKey'] => $this->_tpl_vars['playgameItem']):
?>
		headerPlaygame[<?php echo $this->_tpl_vars['playgameKey']; ?>
] = '<?php echo $this->_tpl_vars['playgameItem']; ?>
';
	<?php endforeach; endif; unset($_from); ?>
	
	$(function () {
		ShowDingDialogBox("dingTopGame_s1", "dingTopGameBox_s1", 5, 24);
		ShowDingDialogBox("dingTopUserCenter_s1", "dingTopUserBox_s1", 9, 24);
		headerPlaygameFunc();
		setInterval(headerPlaygameFunc, 6000);
	});
	function ShowDingDialogBox(obj, objbox, left, top) {
		$("#" + obj).hover(function () {
			var p = $(this).position();
			$("#" + objbox).css({ "left": (p.left + left) + "px", "top": (p.top + top) + "px" }).show();
			$("#dingTopGameTab_s1").show();
		}, function () {
			$("#" + objbox).hide();
		});
	}
	function headerPlaygameFunc(){
		if(headerPlaygame[headerPlaygameIndex] != "") {
			$(".fadeInPlaygame").html(headerPlaygame[headerPlaygameIndex]);
		}
		$(".fadeInPlaygame").fadeIn('slow');
		if (headerPlaygameIndex == 49) {
			headerPlaygameIndex = 0;
		} else {
			headerPlaygameIndex++;
		}
		setTimeout("$('.fadeInPlaygame').fadeOut('slow')", 5000);
	}
</script>

<div id="dingTop_s1">
        <div id="dingHeader_s1">
            <h1 id="dingTopLogo_s1">
                <a href="<?php echo @SITE_URL; ?>
">5ding</a>
            </h1>
            <ul id="dingNavL_s1">
                <li class="dingTopNobg_s1 dingTopLogo_s1"><a href="<?php echo @SITE_URL; ?>
" target="_blank">我顶网</a></li>
                <li class="dingTopGame_s1" id="dingTopGame_s1"><a href="javascript:void(0)" class="domgTopGameA_s1">我顶娱乐</a>
                    <div id="dingTopGameBox_s1">
                        <div class="dingTopGameTab_s1" id="dingTopGameTab_s1">
                            <a href="javascript:void(0)">我顶娱乐</a>
                        </div>
                        <dl><dt>网页游戏(8)</dt>
							<dd>
								<a target="_blank" href="<?php echo @TJ_URL; ?>
" style="color:#ff6600;">·天纪</a>
							</dd>
							<dd>
								<a target="_blank" href="<?php echo @XY_URL; ?>
" style="color:#ff6600;">·仙域</a>
							</dd>
                            <dd>
                                <a target="_blank" href="<?php echo @WX_URL; ?>
" style="color:#ff6600;">·问仙</a>
                            </dd>
                            <dd>
                                <a target="_blank" href="<?php echo @SG_URL; ?>
" style="color:#ff6600;">·明珠三国</a>
                            </dd>
                            <dd>
                                <a target="_blank" href="<?php echo @LM_URL; ?>
">·龙门</a>
                            </dd>
                            <dd>
                                <a target="_blank" href="<?php echo @XINGKE_URL; ?>
">·星客志愿</a>
                            </dd>
							<dd>
								<a target="_blank" href="<?php echo @AS_URL; ?>
">·傲视天地</a>
							</dd>
							<dd>
								<a target="_blank" href="<?php echo @JD_URL; ?>
">·绝地战争</a>
							</dd>
							<dd>
								<a target="_blank" href="<?php echo @FH_URL; ?>
">·超级富豪</a>
							</dd>
                        </dl>
						<dl><dt>娱乐平台(7)</dt>
							<dd>
								<a target="_blank" href="http://wo.5ding.com/">·玩家社区</a>
							</dd>
                            <dd>
                                <a target="_blank" href="http://juese.5ding.com/" style="color:#ff6600;">·角色</a>
                            </dd>
                            <dd>
                                <a target="_blank" href="http://xyx.5ding.com/">·我顶小游戏</a>
                            </dd>
                            <dd>
                                <a target="_blank" href="http://114.5ding.com/">·网址导航</a>
                            </dd>
                            <dd>
                                <a target="_blank" href="http://k.5ding.com/">·快玩</a>
                            </dd>
							<dd>
								<a target="_blank" href="http://bbs.5ding.com/">·论坛</a>
							</dd>
							<dd>
								<a target="_blank" href="http://ask.5ding.com/">·我顶问答</a>
							</dd>
                        </dl>
                        <div class="clear">
                        </div>
                    </div>
                </li>
                <!-- li class="dingTopSe_s1"><a href="http://juese.5ding.com/" target="_blank">角色</a></li>
				<li class="dingTopSe_s1"><a href="http://wo.5ding.com/" target="_blank">喔喔:</a></li -->
            </ul>
			<ul class="dingNavL_s1">
				<li id="fadeInPlaygame" class="fadeInPlaygame" style="display:none; text-align:center; background:none; width: 300px; overflow:hidden;"></li>
			</ul>
<?php if ($_SESSION['user']['user_id']): ?>
	<ul id="dingNavR_s1">
		<li class="dingTopNobg_s1 dingTopUserCenter_s1" id="dingTopUserCenter_s1"><a href="#">
			个人中心</a>
			<div id="dingTopUserBox_s1">
				<div class="dingTopUserTab_s1" id="dingTopUserTab_s1">
					<a href="<?php echo @PASSPORT_URL; ?>
ucenter/index">个人中心</a>
				</div>
				<dl class="dingTopMT18_s1">
					<dt>我的通行证 </dt>
					<dd>
						<a href="<?php echo @PASSPORT_URL; ?>
userinfo/avatar" title="更换头像">更换头像</a>
					</dd>
					<dd>
						<a href="<?php echo @PASSPORT_URL; ?>
ucenter/playgame" title="我的游戏">我的游戏</a>
					</dd>
				</dl>
				<dl>
					<dt>账号安全 </dt>
					<dd>
						<a href="<?php echo @PASSPORT_URL; ?>
ucenter/info" title="密保资料">密保资料</a>
					</dd>
					<dd>
						<a href="<?php echo @PASSPORT_URL; ?>
ucenter/mobile" title="手机认证">手机认证</a>
					</dd>
					<dd>
						<a href="<?php echo @PASSPORT_URL; ?>
ucenter/email" title="邮箱认证">邮箱认证</a>
					</dd>
					<dd>
						<a href="<?php echo @PASSPORT_URL; ?>
ucenter/getpwd" title="修改密码">修改密码</a>
					</dd>
					<dd>
						<a href="<?php echo @PASSPORT_URL; ?>
ucenter/identity" title="防沉迷">防沉迷</a>
					</dd>
				</dl>
				<dl class="nobg_s1">
					<dt>充值管理 </dt>
					<dd>
						<a href="<?php echo @SITE_URL; ?>
payment2" title="帐号充值">帐号充值</a>
					</dd>
					<dd>
						<a href="<?php echo @SITE_URL; ?>
paysearch/index" title="充值查询">充值查询</a>
					</dd>
				</dl>
				<div class="clear">
				</div>
			</div>
		</li>
		<li class="dingTopSysmsg_s1">
			<?php if ($this->_tpl_vars['msgCount']): ?>
				<a href="<?php echo @SITE_URL; ?>
msg/">系统消息(<?php echo $this->_tpl_vars['msgCount']; ?>
)</a>
			<?php else: ?>
				<a href="<?php echo @SITE_URL; ?>
msg/" class="color666">系统消息</a>
			<?php endif; ?>
		</li>
		<li class="dingTopRecharge_s1"><a href="<?php echo @SITE_URL; ?>
payment2" target="_blank">充值</a></li>
		<li class="dingTopHelp_s1"><a href="<?php echo @PASSPORT_URL; ?>
help/common/" target="_blank">帮助</a></li>
		<li class="dingTopQuit_s1"><a href="<?php echo @PASSPORT_URL; ?>
member/logout">退出</a></li>
	</ul>
<?php else: ?>
	<ul id="dingNavR_s1" style="width: 200px;">
		<li class="dingTopNobg_s1 dingTopRecharge_s1"><a href="<?php echo @SITE_URL; ?>
payment2" target="_blank">充值</a></li>
		<li class="dingTopHelp_s1"><a href="<?php echo @PASSPORT_URL; ?>
help/common/" target="_blank">帮助</a></li>
		<li class="dingTopLogin_s1">
			<p>
				<a href="<?php echo @PASSPORT_URL; ?>
member/login">登陆</a><a href="<?php echo @PASSPORT_URL; ?>
member/register">注册</a></p>
		</li>
	</ul>
<?php endif; ?>
		<div class="clear">
		</div>
	</div>
</div>

<div id="dingLogo">
	<h1>
		<a href="<?php echo $this->_tpl_vars['article_indextopgamelogo'][0]['article_link']; ?>
">我顶网</a></h1>
	<div class="dingBanner">
		<?php $_from = $this->_tpl_vars['article_indextopgamelogo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<a target="_blank" href="<?php echo $this->_tpl_vars['item']['article_link']; ?>
" title="<?php echo $this->_tpl_vars['item']['article_title']; ?>
"><img alt="<?php echo $this->_tpl_vars['item']['article_title']; ?>
" src="<?php echo $this->_tpl_vars['item']['article_image1']; ?>
"></a>
		<?php endforeach; endif; unset($_from); ?>
	</div>
	<div class="clear">
	</div>
	<div id="dingScrollDiv">
		<ul>
			<li><a href="<?php echo @SITE_URL; ?>
index/index4" title="分享快乐,从我顶开始!">分享快乐,从我顶开始!</a></li>
		</ul>
	</div>
</div>
  

<script type="text/javascript">
/*
setInterval('AutoScroll("scrollDiv",30)', 2000) //2秒钟滚动一次 同一个函数名写了两次

function AutoScroll(objid, height) {
	$("#"+objid).find("ul:first").animate({ marginTop: "-"+height+"px" }, 1000, function() {
		$(this).css({ marginTop: "0px" }).find("li:first").appendTo(this);
	});
}*/

function init_srolltext(){
	oScroll.scrollTop = 0;
	setInterval('scrollUp()', 15);
}

function scrollUp(){
	if(isStoped) return;
	curTop += 1;
	if(curTop == 19) {
		stopTime += 1;
		curTop -= 1;
		if(stopTime == 180) {
			curTop = 0;
			stopTime = 0;
		}
	}else{
		preTop = oScroll.scrollTop;
		oScroll.scrollTop += 1;
		if(preTop == oScroll.scrollTop){
			oScroll.scrollTop = 0;
			oScroll.scrollTop += 1;
		}
	}
}
</script>