<?php /* Smarty version 2.6.14, created on 2010-10-27 09:45:16
         compiled from dialog_window.tpl */ ?>
﻿    <div id="dialoggame" style="width: 900px; margin: 50px auto; display: none;">
        <div class="dialogShadow_mh">
            <!--
			<div class="dialogHead_mh">
                <img alt="选择游戏服务器" src="<?php echo @STATIC_URL; ?>
images/dialog/dialog_title.gif" /><a href="javascript: DialogClose();"
                    title="close"></a>
            </div>
			-->
			<div class="dialogHead_mh">
				<img alt="选择游戏服务器" src="<?php echo @STATIC_URL; ?>
images/dialog/dialog_title.gif" />
				<span class="fadeInPlaygame" style="display:none;"></span>
				<a href="javascript: DialogClose();" class="close" title="close"></a>
			</div>
            <div class="dialogBox_mh">
                <ul class="dialogNav_mh">
                    <li class="nav_pageUp_mh"><a href="javascript:;">&nbsp;</a></li>
					<li><a id="tjSelect" href="javascript:var cN = 'tjSelect'; changeTag(31, cN);" title="天纪">天纪</a></li>
                    <li><a id="wxSelect" href="javascript:var cN = 'wxSelect'; changeTag(25, cN);" title="问仙">问仙</a></li>
                    <li><a id="mzsgSelect" href="javascript:var cN = 'mzsgSelect'; changeTag(26, cN);" title="明珠三国">明珠三国</a></li>
                    <li><a id="lmSelect" href="javascript:var cN = 'lmSelect'; changeTag(24, cN);" title="龙门">龙门</a></li>
                    <li><a id="asSelect" href="javascript:var cN = 'asSelect'; changeTag(27, cN);" title="傲视天地">傲视天地</a></li>
                    <li><a id="xySelect" href="javascript:var cN = 'xySelect'; changeTag(28, cN);" title="仙域">仙域</a></li>
                    <li><a id="xkzySelect" href="javascript:var cN = 'xkzySelect'; changeTag(22, cN);" title="星客志愿">星客志愿</a></li>
                    <li><a id="jdzzSelect" href="javascript:var cN = 'jdzzSelect'; changeTag(29, cN);" title="绝地战争">绝地战争</a></li>
                    <li><a id="cjfhSelect" href="javascript:var cN = 'cjfhSelect'; changeTag(30, cN);" title="超级富豪">超级富豪</a></li>
                    <li class="nav_pageDown_mh"><a href="javascript:;">&nbsp;</a></li>
                </ul>
                <div class="tagDialog_box_mh">
                    <div class="dialog_banner_mh">
                        <a href="#" title="问仙">
                            <img alt="问仙" src="<?php echo @STATIC_URL; ?>
images/dialog/white.gif" /></a></div>
                    <div class="dialogGameBox_mh">
                        <div class="serverBox_all_mh">
                            <div class="serverBox_l_all_mh">
                                <span>最新服务器：</span>
                            </div>
                            <ul class="serverBox_r_all_mh" id="dialogNewGame">
                            </ul>
                            <div class="clear">
                            </div>
                        </div>
                        <div class="serverBox_all_mh">
                            <div class="serverBox_l_all_mh">
                                <span>热门服务器：</span>
                            </div>
                            <ul class="serverBox_r_all_mh" id="dialogHotGame">
                            </ul>
                            <div class="clear">
                            </div>
                        </div>
                        <div class="dialogNoBorder_mh serverBox_all_mh">
                            <div class="serverBox_l_all_mh">
                                <span>所有服务器：</span>
                            </div>
                            <ul class="serverBox_r_all_mh" id="dialogAllGame">
                            </ul>
                            <div class="clear">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="no_game" style="display:none;" class="tagDialog_box_mh">
                  <div>
					<a href="http://www.5ding.com/client/index.html" target="_blank">
						<img alt="游戏暂未开放" src="<?php echo @STATIC_URL; ?>
images/dialog/no_game.jpg" />
					</a>
                  </div>
                </div>
                <div class="clear">
                </div>
                <div class="dialog_login_game_mh" id="dialog_login_game">
                    <span>上次登陆服务器：(问仙)04服(2010.08.04 17：40)</span><a href="">
                        <img alt="游戏充值" src="<?php echo @STATIC_URL; ?>
images/dialog/dialog_chongzhi.jpg" /></a> <a id="lastPlayGameButton" href="">
                            <img alt="登录游戏" src="<?php echo @STATIC_URL; ?>
images/dialog/dialog_logingame.jpg" /></a>
                    <div class="clear">
                    </div>
                </div>
            </div>
        </div>
    </div>