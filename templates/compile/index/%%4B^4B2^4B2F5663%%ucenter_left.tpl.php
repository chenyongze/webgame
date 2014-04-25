<?php /* Smarty version 2.6.14, created on 2010-12-06 15:04:23
         compiled from ucenter_left.tpl */ ?>
<div id="left">
	<h3 id="sidebarTitle">
		<a href="<?php echo @PASSPORT_URL; ?>
ucenter/index">通行证首页</a></h3>
	<dl id="sidebar">
		<dt>我的通行证</dt>
		<dd <?php if ($this->_tpl_vars['leftCurr'] == 'avatar'): ?> class="checked"<?php endif; ?>>
			<a href="<?php echo @PASSPORT_URL; ?>
userinfo/avatar">修改头像</a>
		</dd>
		<!-- dd>
			<a href="#">基本资料</a>
		</dd -->
		<dd class="nobg  <?php if ($this->_tpl_vars['leftCurr'] == 'playgame'): ?> checked<?php endif; ?>">
			<a href="<?php echo @PASSPORT_URL; ?>
ucenter/playgame">我的游戏</a>
		</dd>
		<dt>账号安全</dt>
		<dd <?php if ($this->_tpl_vars['leftCurr'] == 'info'): ?> class="checked"<?php endif; ?>>
			<a href="<?php echo @PASSPORT_URL; ?>
ucenter/info">密保资料</a>
		</dd>
		<dd <?php if ($this->_tpl_vars['leftCurr'] == 'mobile'): ?> class="checked"<?php endif; ?>>
			<a href="<?php echo @PASSPORT_URL; ?>
ucenter/mobile">手机认证</a>
		</dd>
		<dd <?php if ($this->_tpl_vars['leftCurr'] == 'email'): ?> class="checked"<?php endif; ?>>
			<a href="<?php echo @PASSPORT_URL; ?>
ucenter/email">邮箱认证</a>
		</dd>
		<dd <?php if ($this->_tpl_vars['leftCurr'] == 'getpwd'): ?> class="checked"<?php endif; ?>>
			<a href="<?php echo @PASSPORT_URL; ?>
ucenter/getpwd">修改密码</a>
		</dd>
		<dd class="nobg<?php if ($this->_tpl_vars['leftCurr'] == 'identity'): ?> checked<?php endif; ?>">
			<a href="<?php echo @PASSPORT_URL; ?>
ucenter/identity">防沉迷申请</a>
		</dd>
		<dt>充值管理</dt>
		<dd<?php if ($this->_tpl_vars['leftCurr'] == 'payment'): ?> class="checked"<?php endif; ?>>
			<a href="<?php echo @SITE_URL; ?>
payment/">游戏充值</a>
		</dd>
		<dd class="nobg border_bottom<?php if ($this->_tpl_vars['leftCurr'] == 'paysearch'): ?> checked<?php endif; ?>">
			<a href="<?php echo @SITE_URL; ?>
paysearch/index">充值记录</a>
		</dd>
	</dl>
</div>