<?php /* Smarty version 2.6.14, created on 2010-12-06 15:04:14
         compiled from left_login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'left_login.tpl', 154, false),)), $this); ?>
<div id="sidebar">
	<div id="login">
		<div class="sidebarBoxTop">
		</div>

<?php if ($_SESSION['user']): ?>
<!-- 登陆后 -->
	<div class="loginContent">
		<div class="loginTitle">
			<span style="float:left;">通行证登录</span><span style="font-size:12px; color:999; float:right; font-weight:500;">系统消息<a style="color:#ff6600;" href="<?php echo @SITE_URL; ?>
msg/" title="短消息" target="_blank">（<?php echo $this->_tpl_vars['msgCount']; ?>
）</a></span>
		</div>
		<div class="loginUserMsg">
			<div class="loginUserImg">
				<a href='<?php echo @PASSPORT_URL; ?>
ucenter/index'>
					<?php if ($_SESSION['user']['user_avatar']): ?>
						<img width="87" height="87" src="<?php echo @PASSPORT_URL; ?>
upload/<?php echo $_SESSION['user']['user_avatar']; ?>
" />
					<?php else: ?>
						<img width="87" height="87" src="<?php echo @STATIC_URL; ?>
images/boy_img_87x87.jpg" />
					<?php endif; ?>
				</a>
			</div>
			<ul>
				<li class="loginUserNick">
					<?php if ($_SESSION['user']['user_nickname']): ?>
						昵称：<?php echo $_SESSION['user']['user_nickname']; ?>

					<?php else: ?>
						账号:<?php echo $_SESSION['user']['user_code']; ?>

					<?php endif; ?>
				</li>
				<li>上次登录时间：</li>
				<li><?php echo $this->_tpl_vars['playgame']['pg_date']; ?>
</li>
				<li class="loginBtnRZ">
					<a href="<?php echo @PASSPORT_URL; ?>
ucenter/index" target="_blank">
						<img src="<?php echo @STATIC_URL; ?>
images/index/user_rz.jpg" />
					</a>
				</li>
			</ul>
			<div class="clear">
			</div>
		</div>
		<div class="loginBtn_gn">
			<select id="select_game" class="login_game">
				<option value=31 <?php if ($this->_tpl_vars['game']['gid'] == 31): ?>selected=true<?php endif; ?>>天纪</option>
				<option value=28 <?php if ($this->_tpl_vars['game']['gid'] == 28): ?>selected=true<?php endif; ?>>仙域</option>
				<option value=25 <?php if ($this->_tpl_vars['game']['gid'] == 25): ?>selected=true<?php endif; ?>>问仙</option>
				<option value=26 <?php if ($this->_tpl_vars['game']['gid'] == 26): ?>selected=true<?php endif; ?>>明珠三国</option>
				<option value=27 <?php if ($this->_tpl_vars['game']['gid'] == 27): ?>selected=true<?php endif; ?>>傲视天地</option>
				<option value=24 <?php if ($this->_tpl_vars['game']['gid'] == 24): ?>selected=true<?php endif; ?>>龙门</option>
				<option value=29 <?php if ($this->_tpl_vars['game']['gid'] == 29): ?>selected=true<?php endif; ?>>绝地战争</option>
				<option value=30 <?php if ($this->_tpl_vars['game']['gid'] == 30): ?>selected=true<?php endif; ?>>超级富豪</option>
				<option value=22 <?php if ($this->_tpl_vars['game']['gid'] == 22): ?>selected=true<?php endif; ?>>星客志愿</option>
			</select>
			<select id="select_server" class="login_server">
				<option value="<?php echo $this->_tpl_vars['newgameserver']['gsid']; ?>
"><?php echo $this->_tpl_vars['newgameserver']['sname']; ?>
</option>
			</select>
		</div>
		<div class="loginBtn_gn2">
		<a href="" class="login_game">
				<img src="<?php echo @STATIC_URL; ?>
images/index/login_user_start.jpg" />
			</a>
			</a>
			<a href="<?php echo @SITE_URL; ?>
payment" target="_blank" class="login_btn_cz">
				<img src="<?php echo @STATIC_URL; ?>
images/index/login_user_cz.jpg" />
			</a>

		</div>
	</div>
<?php else: ?>
<!-- 登陆前 -->
<form id="form1" action="<?php echo @PASSPORT_URL; ?>
member/login/" method="post">
	<div class="loginContent">
		<div class="loginTitle">
			通行证登录
		</div>
		<div class="loginForm">
			<span>通行证</span>
			<input type="text" name="login[user_code]" id="userName" />
		</div>
		<div class="loginForm">
			<span>密&nbsp;&nbsp;码</span>
			<input type="password" name="login[user_password]" id="userPass" />
		</div>
		<div class="loginPass">
			<input type="checkbox" id="loginStatus" name="loginsave" value="1" /><label for="rememberPass">记住密码</label>
			<a href="<?php echo @PASSPORT_URL; ?>
member/getpassAns" target="_blank">找回密码</a>
		</div>
		<div class="loginButton">
			<input type="image" src="<?php echo @STATIC_URL; ?>
images/index/login_btn_dl.gif" style="float:left; margin-left:13px;" />
			<a href="<?php echo @PASSPORT_URL; ?>
member/register/" target="_blank">
				<img src="<?php echo @STATIC_URL; ?>
images/index/login_btn_zc.gif" />
			</a>
		</div>
	</div>
</form>
<?php endif; ?>

<div class="sidebarBoxBottom">
		</div>
	</div>
	<div id="dingFuwu">
		<div class="sidebarBoxTop">
		</div>
		<div class="fuwuContent">
			<div class="loginTitle">
				我顶网服务</div>
			<ul class="fuwuList">
				<li><a href="http://wo.5ding.com/" target="_blank" class="shequ">社&nbsp;&nbsp;区</a><span>喔喔游戏社区</span></li>
				<li><a href="http://juese.5ding.com/" target="_blank" style="color:#ff6600;">角&nbsp;&nbsp;色</a><span style="color:#ff6600;">全新改版 开放注册</span></li>
				<li><a href="http://bbs.5ding.com/" target="_blank" class="kefu">论&nbsp;&nbsp;坛</a><span>玩家交流区</span></li>
				<li><a href="<?php echo @SITE_URL; ?>
payment" class="chongzhi" target="_blank">充&nbsp;&nbsp;值</a><span>多种充值方式</span></li>
				<li><a href="<?php if ($_SESSION['user_id']):  echo @PASSPORT_URL; ?>
ucenter/index<?php else:  echo @PASSPORT_URL;  endif; ?>" class="anquan" target="_blank">安&nbsp;&nbsp;全</a><span>为您的账号安全护航</span></li>
				<li><a href="http://ask.5ding.com" target="_blank" class="wenda">问&nbsp;&nbsp;答</a><span>互动问答，精彩共享</span></li>
				<li><a href="<?php echo @PASSPORT_URL; ?>
qa/" class="jianyi" target="_blank">建&nbsp;&nbsp;议</a><span>您的意见，我们的进步</span></li>
			</ul>
		</div>
		<div class="sidebarBoxBottom">
		</div>
	</div>
	<div id="sidebarBanner">
		<a href="<?php echo $this->_tpl_vars['index_left_ads'][0]['article_url']; ?>
">
			<img src="<?php echo $this->_tpl_vars['index_left_ads'][0]['article_image1']; ?>
" />
		</a>
	</div>
	<div id="sidebarPhone">
		<a href="http://j.looyu.com/WebModule/chat/p.do?c=32875&f=77198" target="_blank"><img src="<?php echo @STATIC_URL; ?>
images/index/sidebar_phone.jpg" /></a>
	</div>
</div>
<script type="text/javascript">

function get_server(id, no){
	var game_obj = $("#select_game");
	var server_obj = $("#select_server");
	if (typeof(id) != 'undefined'){
		$.getJSON('/ajax/get_server_ajax/', {game_id:id}, function(data){
			server_obj.empty();
			if (data.info == 'error') {
				server_obj.html('<option>暂无服务器</option>');
			} else {
				$.each(data.info, function(i,v){
					var s_name = ((v.sname).replace('(','')).replace(')','');
					if (no == v.gsid) {
						server_obj.append('<option  value='+v.gsid+' selected=true>'+s_name+'</option>');
					} else {
						server_obj.append('<option  value='+v.gsid+'>'+s_name+'</option>');
					};
				});
			};
		});
	}
}

$(document).ready(function(){
	var je= $('#select_game').val()? $("#select_game").val() : 28;
	get_server(je, <?php echo ((is_array($_tmp=@$this->_tpl_vars['playgame']['pg_gameid'])) ? $this->_run_mod_handler('default', true, $_tmp, '47') : smarty_modifier_default($_tmp, '47')); ?>
); //2表示 默认选中的服务器

});
$(function(){
	$("#select_game").bind('change', function(){
		var game_val = $(this).val();
		get_server(game_val); //2表示 默认选中的服务器
	});

	//进入游戏链接
	$(".login_game").live('click', function(){
		login_game();
	})
	$(".login_btn_cz").live('click', function(){
		chongzhi_game();
	});

	//进入聊天
	$(".login_room").live('click', function(){
		var gid = $("#select_game").val();
		var sid = $("#select_server").val();
		$(".chat_sid").val(sid);
		$(".chat_gid").val(gid);
		$(".chat_sname").val($("#select_server option[value="+sid+"]").html());
		$(".chat_gname").val($("#select_game option[value="+gid+"]").html());
		$("#chat_post").submit();
	});

});


//获取进入游戏链接
function login_game(){
	var gid = $("#select_game").val();
	var sid = $("#select_server").val();
	$(".login_game").attr('target', '_blank');
	$(".login_game").attr('href', 'http://www.5ding.com/playgame/index/'+gid+'/'+sid);
}
//进入充值连接
function chongzhi_game()
{
	var gid = $("#select_game").val();
	var sid = $("#select_server").val();

	$(".login_btn_cz").attr('href', 'http://www.5ding.com/payment/add/'+gid+'/'+sid);
}
 </script>