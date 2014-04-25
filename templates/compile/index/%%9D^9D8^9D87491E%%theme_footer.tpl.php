<?php /* Smarty version 2.6.14, created on 2010-10-27 09:45:16
         compiled from theme_footer.tpl */ ?>
	<!--页脚 start -->
    <div id="footerHelpH">
	<p id="dicopyH">抵制不良游戏  注意自我保护 谨防受骗上当 适度游戏益脑 沉迷游戏伤身 合理安排时间 享受健康生活</p>
        <p>
            <a href="<?php echo @SITE_URL; ?>
aboutus/">关于我们</a><span>|</span>
            <a href="<?php echo @SITE_URL; ?>
aboutus/hr">我顶招聘</a><span>|</span>
	    <a href="<?php echo @SITE_URL; ?>
aboutus/map">网站地图</a><span>|</span>
			<a href="<?php echo @SITE_URL; ?>
aboutus/connect">联系我们</a><span>|</span> <span class="hotphonefont">热线电话</span><span
                class="hotphone">400-890-0588</span>
        </p>
        <p id="copyrightHelpH">
            <span>趣游（北京）科技有限公司</span>
			<span>京ICP证09363</span>
			<span class="hotphone2"><a href="http://www.miibeian.gov.cn/">京ICP备09113349号</a></span>
			<span class="hotphone2"><a href="http://www.5ding.com/jww.jpg" target="_blank">京网文[2010]0400-015号</a></span>
        </p>
    </div>
	<input type="hidden" id="is_login" value="<?php if ($_SESSION['user']['user_id']): ?>1<?php endif; ?>" />
  <?php if (! $this->_tpl_vars['skip_footerbar']): ?>
	<script language='javascript' src='<?php echo @SITE_URL; ?>
topnav/footer/' ></script>
  <?php endif; ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dialog_window.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>