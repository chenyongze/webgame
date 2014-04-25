<?php /* Smarty version 2.6.14, created on 2010-12-06 15:08:16
         compiled from payment2/payment2.confirm.tpl */ ?>
  <script>
  	$(function(){
		$(".p_submit").click(function(){
			var payCode = $(".payment_confirm input[name=sounds]").val();
			if (payCode == 1 || payCode ==2){
				dialog("我的标题", "id:dialogMsg", "370px", "auto", "id", "msg_value");
				//tipsWindown("提示","text: <div class='tk_content'><p class='tanhao'><img src='<?php echo @STATIC_URL; ?>
images/payment2/tanhao.gif' alt='' /></p><p class='wenzi'>请您在新打开的网上银行页面完成付款</p><p class='wenzi_tip'>支付完成前请不要关闭此窗口，完成支付后请根据您的情况点击下面的按钮。</p><p class='btn'><a href='<?php echo @SITE_URL; ?>
payment2/sucBan/<?php echo $this->_tpl_vars['pay']['game_id']; ?>
/<?php echo $this->_tpl_vars['pay']['server_id']; ?>
' class='btn_wancheng'><img src='<?php echo @STATIC_URL; ?>
images/payment2/tk_btn_zhifu1.gif' alt='' /></a><a href='<?php echo @SITE_URL; ?>
payment2/add/<?php echo $this->_tpl_vars['pay']['game_id']; ?>
/<?php echo $this->_tpl_vars['pay']['server_id']; ?>
/?user=<?php echo $this->_tpl_vars['pay']['user_code']; ?>
&s=<?php echo $this->_tpl_vars['pay']['sounds']; ?>
' class='btn_chongshi'><img src='<?php echo @STATIC_URL; ?>
images/payment2/tk_btn_zhifu2.gif' alt='' /></a></p><div class='clear'></div><p class='chakan'>或<span><a href='http://passport.5ding.com/help/pay/'>查看问题帮助</a></span></p></div>", "360", "220", "true", "", "true", "text");
			} else {
				$(".payment_confirm").attr('target', '_self');
			}
			//document.payment_confirm.submit();
			//alert('outs');
			//$("form[name='payment_confirm']").submit();
	    });
  	});
  </script>
  
<div id="main">
       <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ucenter_left.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <div id="right">
           
           <div class="contentTitle mt5">
			游戏充值
			</div>
			<div class="information newvalue">
      <div class="setp_s2">
      	<span class="ico"><img src="<?php echo @STATIC_URL; ?>
images/payment2/step1.gif" alt="" /></span><span class="yellow_ico"><img src="<?php echo @STATIC_URL; ?>
images/payment2/step2_1.gif" alt="" /></span><span class="nobg"><img src="<?php echo @STATIC_URL; ?>
images/payment2/step3.gif" alt="" /></span>
      </div>
      <div class="down">
        <div class="content">
        <form action='/payment2/save' method='post' target = "_blank" class="payment_confirm" name="payment_confirm">
        	<p><span class="info">充值账号：</span><span class="info_content"><?php echo $this->_tpl_vars['pay']['user_code']; ?>
</span></p>
        	<input type="hidden" name="user_code" value="<?php echo $this->_tpl_vars['pay']['user_code']; ?>
" />
            <p><span class="info">支付方式：</span><span class="info_content"><?php echo $this->_tpl_vars['card_type']; ?>
<!-- <img src="<?php echo @STATIC_URL; ?>
images/payment2/ico_gongshang.gif" /> --></span></p>
            <input type="hidden" name="pay_code" value="<?php echo $this->_tpl_vars['pay']['pay_code']; ?>
" />
            <p><span class="info">选择充值的游戏：</span><span class="info_content"><?php echo $this->_tpl_vars['game_info']['gname']; ?>
</span></p>
            <input type="hidden" name="game_id" value="<?php echo $this->_tpl_vars['pay']['game_id']; ?>
" />
            <p><span class="info">要充值的服务器：</span><span class="info_content"><?php echo $this->_tpl_vars['server_info']['sname']; ?>
</span></p>
            <input type="hidden" name="server_id" value="<?php echo $this->_tpl_vars['pay']['server_id']; ?>
" />
            <p><span class="info">你要充值的金额：</span><span class="info_content"><?php echo $this->_tpl_vars['pay']['amount']; ?>
 元</span></p>
            <input type="hidden" name="amount" value="<?php echo $this->_tpl_vars['pay']['amount']; ?>
" />
            <p><span class="info">充值后您可获得：</span><span class="info_content"><?php echo $this->_tpl_vars['game_amount']; ?>
</span></p>
            <input type="hidden" name="cardAmt" value="<?php echo $this->_tpl_vars['pay']['cardAmt']; ?>
" />
            <input type="hidden" name="cardPwd" value="<?php echo $this->_tpl_vars['pay']['cardPwd']; ?>
" />
            <input type="hidden" name="cardNo" value="<?php echo $this->_tpl_vars['pay']['cardNo']; ?>
" />
            <input type="hidden" name="sounds" value="<?php echo $this->_tpl_vars['pay']['sounds']; ?>
"/>
            <input type="hidden" name="cardType" value="<?php echo $this->_tpl_vars['pay']['pay_code']; ?>
" />
			<input type="hidden" name="telephone" value="<?php echo $this->_tpl_vars['pay']['telephone']; ?>
"/>
            <p class="btn_zhifu nobg">
            	<input type="submit" class="p_submit" style="background: url(<?php echo @STATIC_URL; ?>
images/payment2/btn_zhifu.gif) no-repeat; border: 0pt none; width: 162px; height: 38px;" value="" />
            	<span class="fanhui"><a href="<?php echo @SITE_URL; ?>
payment2/add/<?php echo $this->_tpl_vars['pay']['game_id']; ?>
/<?php echo $this->_tpl_vars['pay']['server_id']; ?>
/?user=<?php echo $this->_tpl_vars['pay']['user_code']; ?>
&s=<?php echo $this->_tpl_vars['pay']['sounds']; ?>
">返回修改</a></span>
            	</p>
        </form>
        </div>
      </div>
      </div>
      </div>
    <div class="clear"></div>
  </div>
  
  <div id="dialogMsg" style="display:none;">
        <div class="dialogMsg">
            <div class="dialogMsg_title">
                <span>提示</span><a href="javascript: DialogClose();"><img alt="close" src="<?php echo @STATIC_URL; ?>
images/payment2/dialog_close.gif" /></a>
                <div class="clear">
                </div>
            </div>
            <div class="dialogMsg_main">
                <div class="dialogMsg_tanhao">
                </div>
                <dl class="dialogMsg_font">
                    <dt>请您在新打开的网上银行页面完成付款</dt>
                    <dd>
                        支付完成前请不要关闭此窗口，完成支付后请根据您 的情况点击下面的按钮。
                    </dd>
                </dl>
                <div class="dialogMsg_btn">
                    <a href="<?php echo @SITE_URL; ?>
payment2/sucBan/<?php echo $this->_tpl_vars['pay']['game_id']; ?>
/<?php echo $this->_tpl_vars['pay']['server_id']; ?>
">
                        <img alt="已完成付款" src="<?php echo @STATIC_URL; ?>
images/payment2//tk_btn_zhifu1.gif" /></a> 
                    <a href="<?php echo @SITE_URL; ?>
payment2/add/<?php echo $this->_tpl_vars['pay']['game_id']; ?>
/<?php echo $this->_tpl_vars['pay']['server_id']; ?>
/?user=<?php echo $this->_tpl_vars['pay']['user_code']; ?>
&s=<?php echo $this->_tpl_vars['pay']['sounds']; ?>
">
                        <img alt="遇到问题，重试" src="<?php echo @STATIC_URL; ?>
images/payment2/tk_btn_zhifu2.gif" /></a>
                </div>
                <p class="dialogMsg_btnHelp">
                    或<a href="http://passport.5ding.com/help/pay/" target="_blank">查看问题帮助</a></p>
            </div>
        </div>
    </div>
  
  


  
  
  
  
  
  
  
  
  
  
  
  
  
  