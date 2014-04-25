<?php /* Smarty version 2.6.14, created on 2010-12-06 15:04:15
         compiled from footerbar.tpl */ ?>
<script type="text/javascript" src="<?php echo @STATIC_URL; ?>
js/footer.js"></script>
<!--[if lte IE 6]>
	<script type="text/javascript" src="<?php echo @STATIC_URL; ?>
js/footerIE6.js"></script>
<![endif]-->
<div id="dingWindows" style="display:none;">
	<div style="height: 1px; background-color: #fff; font-size:0px;"></div>
	<div id="winWowo" onclick="ShowWinBox('winWowoBox')">
		<!--喔喔-->
		<div id="winWowoBox">
			<div class="winWowoTitle">
				<span>喔喔</span><a target="_self" href="javascript:CloseWinBox('winWowoBox');">X</a>
				<div class="clear">
				</div>
			</div>
			<div class="winWowoContent">
				<ul class="winWowoFuwu" id="winWowoFuwu">
					<li><a href="http://www.5ding.com/payment" target="_blank" class="chongzhi">充值</a></li>
					<li><a href="javascript:var funcStr = 'windowActive'; footerIsLogin('ShowWinBox(funcStr); footerHotActivity();');" class="huodong">活动</a></li>
					<li><a href="http://passport.5ding.com/help/common/" target="_blank" class="bangzhu">帮助</a></li>
					<li><a href="http://j.looyu.com/WebModule/chat/p.do?c=32875&f=77198" target="_blank" class="zxkf">在线客服</a></li>
					<li><a href="http://bbs.5ding.com" target="_blank" class="luntan">论坛</a></li>
					<li><a href="http://juese.5ding.com/" target="_blank" class="role">角色</a></li>
					<li><a href="http://wo.5ding.com/" target="_blank" class="wowo">喔喔</a></li>
				</ul>
				<ul class="winWowoGame" id="winWowoGame">
					<li><a href="javascript:footerIsLogin('WinDialog(31);');" class="tianji">天纪</a></li>
					<li><a href="javascript:footerIsLogin('WinDialog(25);');" class="wenxian">问仙</a></li>
					<li><a href="javascript:footerIsLogin('WinDialog(24);');" class="longmen">龙门</a></li>
					<li><a href="javascript:footerIsLogin('WinDialog(26);');" class="mzsg">明珠三国</a></li>
					<li><a href="javascript:footerIsLogin('WinDialog(22);');" class="xkzy">星客志愿</a></li>
					<li><a href="javascript:footerIsLogin('WinDialog(27);');" class="aoshi">傲视天地</a></li>
					<li><a href="javascript:footerIsLogin('WinDialog(28);');" class="xianyu">仙域</a></li>
				</ul>
				<ul class="winWowoGame" style="display:none;">
					<li><a href="javascript:footerIsLogin('WinDialog(30);');" class="fuhao">超级富豪</a></li>
					<li><a href="javascript:footerIsLogin('WinDialog(29);');" class="juedi">绝地战争</a></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
				<div class="clear">
				</div>
				<div class="winWowoPaging">
					<a href="javascript:nextWowo();" class="winWowoNext"></a><a href="javascript:prevWowo();" class="winWowoPagingFirst winWowoPrev">
					</a>
					<div class="clear">
					</div>
				</div>
			</div>
		</div>
		<!--喔喔泡-->
		<div id="winWowoPao">
			<p class="winWowoPaoContent">
			</p>
			<a class="winWowoClose" target="_self" href="javascript:var footerFuncName = 'winWowoPao'; CloseWinWowoPao(footerFuncName);"></a>
		</div>
	</div>
	<div class="windowLogGame">
		<a target="_self" href="javascript:var footerFuncName = 'winLogGameBox'; footerIsLogin('ShowWinBox(footerFuncName); footerUserLogin();');" class="windowP" onmouseover="ShowWinMsg(this,'登录过的游戏',117,35)"
			onmouseout="HideWinMsg(this)">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_p.jpg" />
		</a>
		<!--登陆过的游戏-->
		<div id="winLogGameBox">
			<div class="winLogGameTitle">
				<span>登录过的游戏</span><a href="javascript:CloseWinBox('winLogGameBox');">X</a>
				<div class="clear">
				</div>
			</div>
			<div class="winLogGameContent">
				<div class="winLogGameList">
					<ul class="windowGameServer">
						<li class="f60" id="userLastPlayGameLog">
						</li>
					</ul>
					<ul class="winLogGameListBox">
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="windowLogGame">
		<a href="http://j.looyu.com/WebModule/chat/p.do?c=32875&f=77198" target="_blank" class="windowP" onmouseover="ShowWinMsg(this,'客服',151,35)" onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_kf.jpg" /></a>
	</div>
	<div class="windowLogGame">
		<a target="_self" href="javascript:var funcStr = 'windowActive'; footerIsLogin('ShowWinBox(funcStr); footerHotActivity();');" class="windowP" onmouseover="ShowWinMsg(this,'活动',185,35)"
			onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_hd.jpg" /></a>
		<!--活动-->
		<div id="windowActive">
			<div class="windowActiveTitle">
				<span>热门活动</span><a target="_self" href="javascript:CloseWinBox('windowActive');">X</a>
				<div class="clear">
				</div>
			</div>
			<div class="windowActiveContent">
				<div class="windowActiveList" id="windowActiveList">
				</div>
			</div>
		</div>
	</div>
	<div class="windowLogGame">
		<a href="http://www.5ding.com/payment/" target="_blank" class="windowP" onmouseover="ShowWinMsg(this,'充值',220,35)" onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_cz.jpg" /></a>
	</div>
	<div class="windowLogGame">
		<a href="http://juese.5ding.com" target="_blank" class="windowP" onmouseover="ShowWinMsg(this,'角色',255,35)" onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_role.gif" /></a>
	</div>
	<div class="windowLogGame">
		<a href="http://wo.5ding.com" target="_blank" class="windowP" onmouseover="ShowWinMsg(this,'喔喔社区',290,35)" onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_wo.gif" /></a>
	</div>
	<div class="windowLogGame">
		<a href="http://ask.5ding.com" target="_blank" class="windowP" onmouseover="ShowWinMsg(this,'问答',325,35)" onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_wenda_16x16.gif" /></a>
	</div>
	<div class="windowLogGame">
		<a href="http://www.5ding.com/client/index.html" target="_blank" class="windowP" onmouseover="ShowWinMsg(this,'游戏大厅',360,35)" onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_client_16x16.gif" /></a>
	</div>
	<div class="windowGame">
		<a target="_self" href="javascript:footerIsLogin('WinDialog(25);');" onmouseover="ShowWinMsg(this,'问仙',12,30)" onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_xian.jpg" />
		</a>
		<a target="_self" href="javascript:footerIsLogin('WinDialog(26);');" onmouseover="ShowWinMsg(this,'明珠三国',12,30)" onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_ming.jpg" />
		</a>
		<a target="_self" href="javascript:footerIsLogin('WinDialog(27);');" onmouseover="ShowWinMsg(this,'傲视天地',12,30)" onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_aoshi.jpg" />
		</a>
		<a target="_self" href="javascript:footerIsLogin('WinDialog(28);');" onmouseover="ShowWinMsg(this,'仙域',12,30)" onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_xianyu.png" />
		</a>
		<a target="_self" href="javascript:footerIsLogin('WinDialog(31);');" onmouseover="ShowWinMsg(this,'天纪',12,30)"	onmouseout="HideWinMsg()">
			<img src="<?php echo @STATIC_URL; ?>
images/index/win_3d_16x16.gif" />
		</a>
	</div>
	<div id="winWowoTextMsg">
	</div>
	<?php if (! $_SESSION['user']['user_id']): ?>
		<div class="windowLogin">
			<a target="_self" href="javascript:footerDialogSign();">注册</a><a target="_self" href="javascript:dialogLoginWindow();">登录</a>
		</div>
	<?php endif; ?>
	<div class="clear">
	</div>
</div>
<!--弹出框-->
<div id="winDialogWx" style="display: none;">
	<div id="winDialogBox">
		<div class="winDialogBoxTitle">
			<span class="winDialogBoxSpan">问仙</span><a target="_self" href="javascript:DialogClose();" class="winDialogBoxA">X</a>
			<div class="clear"></div>
		</div>
		<div class="winDialogContent">
			<div class="winDialogGameLog">
				<span class="winDialogGamePrev">上次登录的游戏：<a id="footerLastPlayGameLink" href="#"></a></span>
				<span class="winDialogGameTime" id="footerDialogGameTime"></span>
				<a href="#" class="winDialogCZ" id="footerDialogCZ">充值</a>
				<div class="clear">
				</div>
			</div>
			<div class="winDialogBanner">
			</div>
			<div class="winDialogGameList">
				<div class="winDialogGameListScroll">
					<div class="winDialogGameTypeBox">
						<div class="winDialogGameBoxTitle">
							最新服务器：
						</div>
						<ul class="winDialogGameBoxItem fontBolder" id="footerDialogNewGame">
						</ul>
						<div class="clear">
						</div>
					</div>
					<div class="winDialogGameTypeBox">
						<div class="winDialogGameBoxTitle">
							热门服务器：
						</div>
						<ul class="winDialogGameBoxItem fontBolder" id="footerDialogHotGame">
						</ul>
						<div class="clear">
						</div>
					</div>
					<div class="winDialogGameTypeBox">
						<div class="winDialogGameBoxTitle">
							全部服务器：
						</div>
						<ul class="winDialogGameBoxItem" id="footerDialogAllGame">
						</ul>
						<div class="clear">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--广告-->
<?php if ($this->_tpl_vars['picad']): ?>
	<div id="indexBottomBanner" style="display:none;">
		<div class="indexBannerTitle">
			<span>我顶我精彩</span><a target="_self" href="#">X</a>
		</div>
		<div class="indexBannerContent" id="indexBannerContent">
		</div>
	</div>
<?php endif; ?>
<!--图标说明框-->
<div id="winMsgBox">
	<p id="winMsgBoxContent">
	</p>
	<div class="winMsgBoxImg">
	</div>
</div>
<img src="<?php echo @STATIC_URL; ?>
images/kuaiwan/loading.gif" id="loadingImg" style="position:absolute; left:0px; bottom:0px;">