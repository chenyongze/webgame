 <div class="cw404">
          <div class="cw_page">
               <div class="cw_p_left"></div>
            <div class="cw_p_right">
                 <p><{$message}></p>
                  <p><b>3</b>秒钟后页面将自动跳转，请稍候...</p>
                  <p>您也可以选择点击 <a href="<{$url}>" title="">跳转链接</a> 直接进入</p>
<!--                  <p><a href="#"><img src="<{$smarty.const.STATIC_URL}>images/404_2.jpg" width="86" height="27" /></a></p>-->
              </div>
          </div>
     </div>
     <{if $auto_refresh}>
		<script language="javascript">
			setTimeout(function(){window.location='<{$url}>'},3000);
		</script>
	 <{/if}>