<div class="login_box">
	<div class="login_box_title">
		<img src="<{$smarty.const.STATIC_URL}>images/account_img/login_title.gif" alt="" />
	</div>
	<div class="login_box_con">
		<a href="#" class="logo_login" title=""><img src="<{$smarty.const.STATIC_URL}>images/account_img/logo_login.gif" alt="" /></a>
		<dl>
			<dt><{$message}></dt>
			<{if $auto_refresh}>
				<dd>
					<p><b>3</b> 秒钟后页面将自动跳转，请稍候...</p>
					<p>您也可以选择点击 <a href="<{$url}>" title="">跳转链接</a> 直接进入</p>
				</dd>
			<{else}>
				<dd style="margin-top:30px;">
					<p><a href="<{$url}>" title="">跳转链接</a></p>
				</dd>
			<{/if}>
		</dl>
		<{if $auto_refresh}>
		<script language="javascript">
			setTimeout(function(){window.location='<{$url}>'},3000);
		</script>
		<{/if}>
	</div>
</div>
