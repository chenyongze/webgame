<?php /* Smarty version 2.6.14, created on 2011-10-11 16:55:24
         compiled from 404.tpl */ ?>
 <div class="cw404">
          <div class="cw_page">
               <div class="cw_p_left"></div>
            <div class="cw_p_right">
                 <p><?php echo $this->_tpl_vars['message']; ?>
</p>
                  <p><b>3</b>秒钟后页面将自动跳转，请稍候...</p>
                  <p>您也可以选择点击 <a href="<?php echo $this->_tpl_vars['url']; ?>
" title="">跳转链接</a> 直接进入</p>
<!--                  <p><a href="#"><img src="<?php echo @STATIC_URL; ?>
images/404_2.jpg" width="86" height="27" /></a></p>-->
              </div>
          </div>
     </div>
     <?php if ($this->_tpl_vars['auto_refresh']): ?>
		<script language="javascript">
			setTimeout(function(){window.location='<?php echo $this->_tpl_vars['url']; ?>
'},3000);
		</script>
	 <?php endif; ?>