<?php /* Smarty version 2.6.14, created on 2010-12-06 15:04:23
         compiled from payment2/payment2.add.tpl */ ?>

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
    <div class="setp_s2"> <span class="yellow_ico"><img src="<?php echo @STATIC_URL; ?>
images/payment2/step1_1.gif" alt="" /></span><span class="ico"><img src="<?php echo @STATIC_URL; ?>
images/payment2/step2.gif" alt="" /></span><span class="nobg"><img src="<?php echo @STATIC_URL; ?>
images/payment2/step3.gif" alt="" /></span> </div>
    <div class="down">
      <div class="other">
	      <div id="p_self" class="user_code  mb20">
	       <?php if ($_SESSION['user'] || $_GET['user']): ?>   
	       	<p class="account">
	        	<span class="other_info">充值账号：</span>
	        	<span class="value_account"><?php if ($_GET['user']):  echo $_GET['user'];  else:  echo $_SESSION['user']['user_code'];  endif; ?></span>
	        	<input type="hidden" value="<?php if ($_GET['user']):  echo $_GET['user'];  else:  echo $_SESSION['user']['user_code'];  endif; ?>" name="user_code"></input>
	        	<a href="javascript:;" class="switch_acc"><img src="<?php echo @STATIC_URL; ?>
images/payment2/btn_chongzhi.gif" /></a>
	        </p>
	       <?php else: ?>
	       <div class="mb20 nS_userCode">
		       	<p><span class="other_info ">充值账号：</span>
		       		<input type="text" class="input_wdl" name="user_code" value="<?php if ($_GET['user']):  echo $_GET['user'];  endif; ?>"/>
		       	</p>
	       	</div>
	       	
	       	<div class="mb20 nS_userCode1">
		       	<p><span class="other_info ">确认账号：</span><input type="text" class="input_wdl" name="user_code1"/></p>
	       	</div>
	        
	       <?php endif; ?>
		 	   
	      </div>
       
	       <div class="value_ydl user_code" id="p_other" style="display:none;">
	       <div class="mb20 nS_userCode">
		       	<p><span class="other_info">充值账号：</span><input type="text" class="input_wdl" name="user_code"/></p>
	       	</div>
	        	<div class="mb20 nS_userCode1">
		       	<p><span class="other_info">确认账号：</span><input type="text" class="input_wdl" name="user_code1"/>
	       		   <span class="btn_quxiao"><a href="javascript:;" id="p_cancel"><img src="<?php echo @STATIC_URL; ?>
images/payment2/btn_quxiao.gif" /></a></span></p>
	       		</div>
	       		
	       </div>
		   
		   	<div class="mb20 telephont">
		       	<p style="float: left; width: 375px;"><span class="other_info">手机号：</span><input type="text" maxlength="11" class="input_wdl" name="telephone" onblur="MobilePhoneValidate()" id="telephone"/></p>
		       	<span style="display: block; float: left; height: 30px; line-height: 15px; width: 200px; color: #999;">建议您认真填写，以便各种优惠活动或订单遇到问题时能及时联系您！</span>
		       	<div class="clear"></div>
		       	<div id="mobilePhoneVD_s1" style="display: none;" class="paymentFormMsg_s telephone_error"><div class="msgError_s">请输入正确的手机号码！</div></div>
	       	</div>
	       	
	       	<Script>
	       	function MobilePhoneValidate(){
		       	var regValidate = /^(13[0-9]|15[0|2|3|6|7|8|9]|18[8|9])\d{8}$/;
		       	if(!regValidate.test($("#telephone").val())){
					$("#mobilePhoneVD_s1").show();
			    }
		       	else {
		       		$("#mobilePhoneVD_s1").hide();
			       	}
		    }
	       	</Script>
		  
       <div class="mb20 nS_game_id">
        	<p><span class="other_info">选择充值的游戏：</span><span class="uboxstyle">
	          <select id="select_game" name="game_id" style="width: 260px; margin-top: 5px;"">
	          	<option value=0>请选择游戏</option>
	            <option value=26 <?php if ($_GET['2'] == 26): ?>selected<?php endif; ?>>明珠三国</option>
	            <option value=25 <?php if ($_GET['2'] == 25): ?>selected<?php endif; ?>>问仙</option>
	            <option value=24 <?php if ($_GET['2'] == 24): ?>selected<?php endif; ?>>龙门</option>
	            <option value=22 <?php if ($_GET['2'] == 22): ?>selected<?php endif; ?>>星客志愿</option>
	            <option value=27 <?php if ($_GET['2'] == 27): ?>selected<?php endif; ?>>傲视天地</option>
	            <option value=28 <?php if ($_GET['2'] == 28): ?>selected<?php endif; ?>>仙域</option>
				<option value=29 <?php if ($_GET['2'] == 29): ?>selected<?php endif; ?>>绝地战争</option>
				<option value=30 <?php if ($_GET['2'] == 30): ?>selected<?php endif; ?>>超级富豪</option>
				<option value=31 <?php if ($_GET['2'] == 31): ?>selected<?php endif; ?>>天纪</option>
	          </select>
	          </span>
	        </p>
       </div>
	    <div class="mb20 nS_server_id">
		    <p><span class="other_info">要充值的服务器：</span><span class="uboxstyle">
		          <select id="select_server" name="server_id" style=" width: 260px; margin-top: 5px; ">
		            <option value=0>请选择服务器</option>
		          </select>
	          </span></p>
	    	<div class="paymentFormMsg_s hidden" >
				<div class="msgSuccess_s">adfadfadsf</div>
	       	</div>
	    </div>  
        
        <p>选择您的支付方式：</p>
      </div>
      <div>
        <ul class="tab">
          <li><a id="t_code1" href="javascript:;" title="网上银行充值" class="selectedGame">网上银行充值</a></li>
          <li><a id="t_code2" href="javascript:;" title="支付宝充值">支付宝充值</a></li>
          <li><a id="t_code3" href="javascript:;" title="手机卡充值" >手机卡充值</a></li>
          <li><a id="t_code4" href="javascript:;" title="点卡充值"  >点卡充值</a></li>
        </ul>
        
        <div class="tab_box p_sounds" id="c_code1" style="display:none;">
        	<div class="value_webbank">
            	<div class="value_amount">
                	<p><span class="other_info">选择充值的金额：</span><span class="left">
			          <select class="game_price_bank game_amount left" name="game_amount" style=" width: 260px; margin-top: 5px;">
			          <?php $_from = $this->_tpl_vars['config_payment2']['bank']['price']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vo']):
?>
			         	 <option><?php echo $this->_tpl_vars['vo']; ?>
</option>
			          <?php endforeach; endif; unset($_from); ?>
			          </select>
			          </span><span class="value_yuanbao togame_amount">充值后您可获得：0元宝</span></p>
			          <div class="clear"></div>
               </div>
            </div>
            
            <div class="value_redio value_radio">
       	      <center><table width="538">
       	      	<tr>
       	      		<td><label><input checked type="radio" name="bank_radio" class="bank_radio"  value='ICBC'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/gongshang.jpg" alt="" /></label></td>
                    <td><label><input type="radio" name="bank_radio" class="bank_radio"  value='CMBCHINA'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/zhaoshang.jpg" alt="" /></label></td>
                    <td><label><input type="radio" name="bank_radio" class="bank_radio"  value='BOC'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/yinhang.jpg"   alt="" /></label></td>
               </tr>
               <tr>
       	      		<td><label><input type="radio" name="bank_radio" class="bank_radio"  value='ABC'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/nongye.jpg" alt="" /></label></td>
                    <td><label><input type="radio" name="bank_radio" class="bank_radio" value='CCB'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/jianshe.jpg" alt="" /></label></td>
                    <td><label><input type="radio" name="bank_radio" class="bank_radio" value='BOCO'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/jiaotong.jpg"   alt="" /></label></td>
               </tr>
               <tr>
       	      		<td><label><input type="radio" name="bank_radio" class="bank_radio" value='GDB'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/guangdong.jpg" alt="" /></label></td>
                    <td><label><input type="radio" name="bank_radio" class="bank_radio" value='ECITIC'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/zhongxin.jpg" alt="" /></label></td>
                    <td><label><input type="radio" name="bank_radio" class="bank_radio" value='CEB'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/guangda.jpg"   alt="" /></label></td>
               </tr>
               <tr>
       	      		<td><label><input type="radio" name="bank_radio" class="bank_radio" value='SPDB'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/pufa.jpg" alt="" /></label></td>
                    <td><label><input type="radio" name="bank_radio" class="bank_radio" value='SDB'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/shenzhen.jpg" alt="" /></label></td>
                    <td><label><input type="radio" name="bank_radio" class="bank_radio" value='CMBC'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/minsheng.jpg"   alt="" /></label></td>
               </tr>
               <tr>
       	      		<td><label><input type="radio" name="bank_radio" class="bank_radio" value='POST'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/youzhen.jpg" alt="" /></label></td>
                    <td><label><input type="radio" name="bank_radio" class="bank_radio" value='CIB'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/xingye.jpg" alt="" /></label></td>
                    <td><label><input type="radio" name="bank_radio" class="bank_radio" value='HXB'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/huaxia.jpg"   alt="" /></label></td>
               </tr>
                <tr>
       	      		<td><label><input type="radio" name="bank_radio" class="bank_radio" value='BCCB'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/beijing.jpg" alt="" /></label></td>
                    <td><label><input type="radio" name="bank_radio" class="bank_radio" value='PAB'/><img src="<?php echo @STATIC_URL; ?>
images/payment2/pinan.jpg" alt="" /></label></td>
                    <td class="other_bank"><label class="bank_redio_more"><span>更多银行</span>&gt;&gt;<!-- <img src="<?php echo @STATIC_URL; ?>
images/payment2/qita.jpg"  /> --></label></td>
               </tr>
          </table></center>
          </div>
          
          <div class="qitaRadioH value_radio" style="display:none;">
				<ul>
					<li><input type="radio" name="bank_radio" class="bank_radio" id="RadioGroup1_21" value='BJRCB'/><label for="RadioGroup1_21">北京农商行</label></li>
					<li><input type="radio" name="bank_radio" class="bank_radio" id="RadioGroup1_22" value='CBHB'/><label for="RadioGroup1_22">渤海银行</label></li>
					<li><input type="radio" name="bank_radio" class="bank_radio" id="RadioGroup1_23" value='NJCB'/><label for="RadioGroup1_23">南京银行</label></li>
					<li><input type="radio" name="bank_radio" class="bank_radio" id="RadioGroup1_24" value='NBCB'/><label for="RadioGroup1_24">宁波银行</label></li>
				
				
					<li><input type="radio" name="bank_radio" class="bank_radio" id="RadioGroup1_25" value='HKBEA'/><label for="RadioGroup1_25">东亚银行</label></li>
					<li><input type="radio" name="bank_radio" class="bank_radio" id="RadioGroup1_26" value='SHRCB'/><label for="RadioGroup1_26">上海农商银行</label></li>
					<li><input type="radio" name="bank_radio" class="bank_radio" id="RadioGroup1_27" value='GZCB'/><label for="RadioGroup1_27">广州市商业银行</label></li>
					<li><input type="radio" name="bank_radio" class="bank_radio" id="RadioGroup1_28" value='GNXS'/><label for="RadioGroup1_28">广州市农信社</label></li>
				
					<li><input type="radio" name="bank_radio" class="bank_radio" id="RadioGroup1_29" value='SDE' /><label for="RadioGroup1_29">顺德农信社</label></li>
				</ul>
            
        </div>
        <div class="btn_next"><a href="#" class="p_submit"><img src="<?php echo @STATIC_URL; ?>
images/payment2/btn_next.gif" alt="" /></a></div>
        </div>
        
        <div class="tab_box p_sounds" id="c_code2" style="display:none;">
            <div class="value_webbank">
                <div class="value_amount_zfb">
                    <p>
                    <span class="other_info">选择充值的金额：</span><span class="left">
                    <select class="game_price_alipay game_amount" name="game_amount" style="width: 260px; margin-top: 5px; ">
                      <?php $_from = $this->_tpl_vars['config_payment2']['alipay']['price']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vo']):
?>
			         	 <option><?php echo $this->_tpl_vars['vo']; ?>
</option>
			          <?php endforeach; endif; unset($_from); ?>
                    </select>
                    </span><span class="value_yuanbao togame_amount">充值后您可获得：0元宝</span></p>
                  </div>
              </div>
          <div class="btn_next">
            <a href="#" class="p_submit">
          <img src="<?php echo @STATIC_URL; ?>
images/payment2/btn_next.gif" alt="" /></a></div>
        </div>
        
        <div class="tab_box p_sounds" id="c_code3" style="display:none;">
			<div class="card">
            	<div class="card_img p_card" name="szx"><a href="javascript:;" ><img src="<?php echo @STATIC_URL; ?>
images/payment2/card_shenzhou.jpg" alt="" /></a></div>
                <p class="card_ps">神州卡支付</p>
            </div>
            
            <div class="card card_mid">
            	<div class="card_img p_card" name="unicom"><a href="javascript:;" ><img src="<?php echo @STATIC_URL; ?>
images/payment2/card_liantong.jpg" alt="" /></a></div>
                <p class="card_ps">联通卡支付</p>
            </div>
            <div class="card">
            	<div class="card_img  p_card" name="telecom"><a href="javascript:;" ><img src="<?php echo @STATIC_URL; ?>
images/payment2/card_dianxin.jpg" alt="" /></a></div>
                <p class="card_ps">电信卡支付</p>
            </div>
            <div class="tab_tip">可以通过营业厅、报刊亭、超市、便利店等方式购买</div>
        </div>
        
        <div class="tab_box p_sounds" id="c_code4" style="display:none;">
			<div class="card">
            	<div class="card_img p_card" name="junnet"><a href="javascript:;" ><img src="<?php echo @STATIC_URL; ?>
images/payment2/card_junwang.jpg" alt="" /></a></div>
                <p class="card_ps" >骏网一卡通支付</p>
            </div>
            <div class="card card_mid">
            	<div class="card_img p_card" name="sndacard"><a href="javascript:;" ><img src="<?php echo @STATIC_URL; ?>
images/payment2/card_shengda_nwe.jpg" alt="" /></a></div>
                <p class="card_ps">盛大支付</p>
            </div>
            
            <div class="card card_left">
            	<div class="card_img p_card"  name="netease"><a href="#"><img src="<?php echo @STATIC_URL; ?>
images/payment2/card_wangyi.gif" alt="" /></a></div>
                <p class="card_ps">网易一卡通支付</p>
            </div>
             <div class="card">
            	<div class="card_img p_card"  name="wanmei"><a href="#"><img src="<?php echo @STATIC_URL; ?>
images/payment2/card_wanmei.gif" alt="" /></a></div>
                <p class="card_ps">完美一卡通支付</p>
            </div>
            <div class="card card_mid">
            	<div class="card_img  p_card"  name="zhengtu"><a href="javascript:;" ><img src="<?php echo @STATIC_URL; ?>
images/payment2/card_zhengtu.jpg" alt="" /></a></div>
                <p class="card_ps">征途卡支付</p>
            </div>
            <div class="card">
            	<div class="card_img p_card"  name="jiuyou"><a href="#"><img src="<?php echo @STATIC_URL; ?>
images/payment2/card_jiuyou.gif" alt="" /></a></div>
                <p class="card_ps">久游一卡通支付</p>
            </div>
           
            <div class="card card_left">
            	<div class="card_img  p_card"  name="ypcard"><a href="#"><img src="<?php echo @STATIC_URL; ?>
images/payment2/card_yibao.gif" alt="" /></a></div>
                <p class="card_ps">易宝E卡通支付</p>
            </div>
            <!--新增卡 开始-->
            <div class="card card_mid">
            	<div class="card_img  p_card"  name="zongyou"><a href="#"><img src="<?php echo @STATIC_URL; ?>
images/payment2/zongyou.jpg" alt="" /></a></div>
                <p class="card_ps">纵游一卡通</p>
            </div>
            <div class="card ">
            	<div class="card_img  p_card"  name="tianxia"><a href="#"><img src="<?php echo @STATIC_URL; ?>
images/payment2/tianxia.jpg" alt="" /></a></div>
                <p class="card_ps">天下一卡通</p>
            </div>
            <!--新增卡 结束-->
            <div class="tab_tip">可以通过点卡官网、报刊亭、网吧、拉卡拉或电话订购等方式购买</div>
        </div>
        
        <div class="tab_box" id="c_code5" style="display:none;">
        	<div class="card">
            	<div class="card_img"><a href="javascript:;"><img src="<?php echo @STATIC_URL; ?>
images/payment2/card_shenzhou.jpg" alt="" /></a></div>
                <p class="card_ps p_card_ps">神州行充值卡支付</p>
                <p class="card_msg_s" id="pCardDesc"></p>
            </div>
            <div class="value_type">
            	<p><b class="card_title">支付方式：神州行充值卡支付</b></p>
           	<div class="mb15 nS_cardNo">
           		<p>
	                <span class="value_type_span">序列号：</span>
	                <span><input type="text" class="value_type_input" name="cardNo"/></span>
                </p>
           	</div>
           	
           	<div class="mb15 nS_cardPwd">
           		<p><span class="value_type_span">密码：</span><span><input type="text" class="value_type_input" name="cardPwd"/></span></p>
           	</div>
           	
            <div class="mb15 nS_cardAmt">
           		<p>
                	<span class="value_type_span">面额：</span>
                    <span class="value_type_miane"></span>
                    <div class="clear"></div>
               	</p>
           	</div>
                <p class="value_type_tip" id="card_desc">请务必选择与您使用的神州行卡相同的面额</p>
            </div>
            <div class="value_type_btn ">
            	<a href="#" class="p_submit"><img src="<?php echo @STATIC_URL; ?>
images/payment2/btn_next.gif" /></a>
                <a href="javascript:;" id="card_fanhui"><img src="<?php echo @STATIC_URL; ?>
images/payment2/btn_fanhui02.gif" /></a>
            </div>
        </div>
        
      </div>
    </div>
    </div>
    <div class="clear"></div>
  </div>

<div style="display:none;">
<form action="/payment2/confirm" method="post" id="payment_form" name="payment_form"> 
	<input type="hidden" name="user_code" value="<?php if ($_GET['user']):  echo $_GET['user'];  endif; ?>" /><!-- 用户id -->
	<input type="hidden" name="game_id" value='' /><!-- 游戏id -->
	<input type="hidden" name="server_id" value='' /><!-- 服务器id -->
	<input type='hidden' name="pay_code" value='' /><!-- 充值类型 -->
	<input type="hidden" name="sounds" value=1 /><!-- 选项卡 -->
	<input type="hidden" name="amount" value='' /><!-- 充值钱数 -->
	<input type="hidden" name="cardNo" value=''/> <!-- 卡号 -->
	<input type="hidden" name="cardPwd" value='' /><!-- 卡密 -->
	<input type="hidden" name="cardType" value=''/><!-- 卡类型 -->
	<input type="hidden" name="cardAmt" value=''/><!-- 卡面额 -->
	<input type="hidden" name="telephone" value="">
</form>
</div>
<div class="clear"></div>
    <div id="dialogMsg" style="display:none;">
        <div class="dialogMsg_value">
            <div class="dialogMsg_title_value">
                <span>提示</span><a href="javascript: DialogClose();" id="dialog_close"><img alt="close" src="<?php echo @STATIC_URL; ?>
images/payment2/dialog_close.gif" /></a>
                <div class="clear">
                </div>
            </div>
            <div class="dialogMsg_main_value">
                <p>
                    您还没有在<a href="javascript:;" target="_bank" id="dialog_name">龙门-(05)龙战于野</a>建立角色，请立即进入游戏创建角色。角色创建完成后，方可继续充值。
                </p>
                <div class="dialogMsg_btn_value">
                    <a href="javascript:; " target="_bank"  id="dialog_wanchen">
                        <img alt="已完成付款" src="<?php echo @STATIC_URL; ?>
images/payment2/value_btn_2.gif" />
                    </a> 
                    <a href="javascript:check_from()" id="dialog_chunshi">
                            <img alt="遇到问题，重试" src="<?php echo @STATIC_URL; ?>
images/payment2/value_btn_3.gif" />
                    </a>
                </div>
                <p>
                    注意：单击“创建角色”您可以在新窗口进入游戏，此页面不会关闭。
                </p>
            </div>
        </div>
    </div>
    
<script>
var popHtml = '';
//未登录状态验证
var _self = $("#p_self");
var _other = $("#p_other");
var html = '<div class="paymentFormMsg_s">';
var html2 = '<div class="paymentFormMsg2_s">';
var MsgError = '<div class="msgError_s">';
var MsgSuccess = '<div class="msgSuccess_s">';
var MsgStopDiv = '</div></div>';

var cardStartV = 0;

$(function(){
	$(".other_bank").live('click', function(){
		$(".qitaRadioH").toggle();
		//$(".qitaRadioH").css('display', 'block');
	});
	//解决ie 6 下select击穿
	$("#dialog_close").live('click', function(){
		$("select").css('display', 'block');
	});
	
	if ("<?php echo $_GET['s']; ?>
" == ''){
		paycode_sounds(1);//默认选择网上银行
	} else {
		paycode_sounds("<?php echo $_GET['s']; ?>
");
	}
	
	//select_card("<?php echo $_GET['3']; ?>
");
	
	//卡类充值 返回按钮
	$("#card_fanhui").live('click', function(){
		paycode_sounds($("#payment_form input[name=sounds]").val());
	});
	//url 接受参数 选中默认的 服务器列表
	
	var get_game_id = "<?php echo $_GET['2']; ?>
";
	var get_server_id = "<?php echo $_GET['3']; ?>
";
	if (get_game_id.length != ''){
		if (get_server_id.length != ''){
			get_server(get_game_id, get_server_id);
		} else {
			get_server(get_game_id,12);
		};	
	};
	

	
	//为登录状态下 账号验证
	$(".nS_userCode input", _self).blur(function(){
		$(".nS_userCode1 input").focus();
		$(".nS_userCode div").remove('.paymentFormMsg_s');
		if ($(this).val().length == 0){
			popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>你输入的账号不能为空</div>";
			$(".nS_userCode").append(html + MsgError +'你输入的账号不能为空'+ MsgStopDiv);
		} else {
			//$(".nS_userCode").append(html + MsgSuccess + '账号输入正确'+ MsgStopDiv);
		}
	});
	$(".nS_userCode1 input", _self).blur(function(){
		$(".nS_userCode1 div").remove('.paymentFormMsg_s');
		if ($(this).val().length == 0){
			popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>你输入的账号不能为空</div>";
			$(".nS_userCode1").append(html+MsgError +'你输入的账号不能为空'+ MsgStopDiv);
		} else {
			if ($(this).val() != $(".nS_userCode input").val()){
				$(".nS_userCode input").focus();
				popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>两次输入账号不一样</div>";
				$(".nS_userCode1").append(html+MsgError+'两次输入账号不一样'+MsgStopDiv);
			} else {
				//$(".nS_userCode1").append(html+MsgSuccess+'账号输入正确'+MsgStopDiv);
			}
		}
	});

	//登录状态下 账号验证
	$(".nS_userCode input", _other).blur(function(){
		$(".nS_userCode1 input").focus();
		$(".nS_userCode div").remove('.paymentFormMsg_s');
		if ($(this).val().length == 0){
			popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>你输入的账号不能为空</div>";
			$(".nS_userCode").append(html + MsgError +'你输入的账号不能为空'+ MsgStopDiv);
		} else {
			//$(".nS_userCode").append(html + MsgSuccess + '账号输入正确'+ MsgStopDiv);
		}
	});
	$(".nS_userCode1 input", _other).blur(function(){
		$(".nS_userCode1 div").remove('.paymentFormMsg_s');
		if ($(this).val().length == 0){
			popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>你输入的账号不能为空</div>";
			$(".nS_userCode1").append(html+MsgError +'你输入的账号不能为空'+ MsgStopDiv);
		} else {
			if ($(this).val() != $(".nS_userCode input").val()){
				$(".nS_userCode input").focus();
				popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>两次输入账号不一样</div>";
				$(".nS_userCode1").append(html+MsgError+'两次输入账号不一样'+MsgStopDiv);
			} else {
				//$(".nS_userCode1").append(html+MsgSuccess+'账号输入正确'+MsgStopDiv);
			}
		}
	});

	var _self = $("#c_code5");
	$(".p_card").live('click', function(){
		var payCode = $(this).attr('name');
		var img = $('img', this).attr('src');
		$(".tab_box").css('display', 'none');
		_self.css('display', 'block');

		$(".card_img img", _self).attr('src', img);
		p_card(payCode);
		var desc = getCardDesc(payCode);
		$("#pCardDesc").html(desc);
	});
	//鼠标滑过效果
	/*
	$(".p_card").mouseover(function(){
		var payCode = $(this).attr('name');
		var html = '<div class="value_tel mouseEffect" style="z-index: 9999;"><div class="value_tel_foot"><div class="value_tel_top"><p>需要您先购买';
		var codeName = '';
		codeName = get_code_name(payCode);
		var CodeDesc = '，各超市、商店、书报亭均有售。</p><p class="value_tel_tip1">[注：';
		var CodeStopDiv = '充值金额为88%，例如充值100元，可购得5D游戏88元]</p></div></div></div>';
		$(this).parent().append(html+codeName+CodeDesc+CodeStopDiv);
	});
	
	$(".p_card").mouseout(function(){
		$("div").remove(".mouseEffect");
	});
	*/
	//game select change method
	$("#select_game").change(function(){
		getCardRadioDesc();
		$('.nS_game_id div').remove('.paymentFormMsg_s');
		//获取服务器列表
		if ($(this).val() != 0) {get_server($(this).val());}
		//游戏验证
		if ($(this).val() == 0){
			$(".nS_game_id").append(html+MsgError +'请选择游戏'+ MsgStopDiv);
		} else {
			//$(".nS_game_id").append(html+MsgSuccess +'选择游戏正确'+ MsgStopDiv);
		}
		togame_amount('bank', $(".p_sounds:visible .game_amount").val());  
	});

	//选择服务器 表单验证
	$("#select_server").change(function(){
		$('.nS_server_id div').remove('.paymentFormMsg_s');
		if ($(this).val() == 0){
			$(".nS_server_id").append(html+MsgError +'请选择服务器'+ MsgStopDiv);
		} else {
			//$(".nS_server_id").append(html+MsgSuccess +'选择游戏正确'+ MsgStopDiv);
		}
	});
	//卡号表单验证
	var _cardSelf = $("#c_code5");
	var _cardType = $("#payment_form input[name=cardType]").val();
	var cardNoVal = '';
	$(".nS_cardNo input", _cardSelf).blur(function(){
		$(".nS_cardNo div").remove('.paymentFormMsg2_s');
		cardNoVal = $(this).val();
		if (cardNoVal.length == 0){
			$(".nS_cardNo", _cardSelf).append(html2+MsgError+'卡号不能为空'+MsgStopDiv);
		} else {
			//$(".nS_cardNo", _cardSelf).append(html2+MsgSuccess+'卡号写入正确'+MsgStopDiv);
		}
	});
	$(".nS_cardPwd input", _cardSelf).blur(function(){
		var _cardType = $("#payment_form input[name=cardType]").val();
		$(".nS_cardPwd div").remove('.paymentFormMsg2_s');
		var cardPwdVal = $(this).val();
		if (cardPwdVal.length == 0){
			$(".nS_cardPwd", _cardSelf).append(html2+MsgError+'密码不能为空'+MsgStopDiv);
		} else {
			var ret = card_verify(_cardType,cardNoVal,cardPwdVal);
			if (ret == false){
				$('.nS_cardPwd').remove('.paymentFormMsg_s');
				$(".nS_cardPwd", _cardSelf).append(html2+MsgError+'卡号密码的位数不对'+MsgStopDiv);
			}
		}
	});
	//卡密表单验证

	$("#t_code1").live('click', function(){paycode_sounds(1)});
	$("#t_code2").live('click', function(){paycode_sounds(2)});
	$("#t_code3").live('click', function(){paycode_sounds(3)});
	$("#t_code4").live('click', function(){paycode_sounds(4)});

	//给别人充值 按钮
	$(".switch_acc").click(function(){
		$("#p_self").css('display', 'none');
		$("#p_other").css('display', 'block');
	});
	
	//给别人充值 点取消按钮事件
	$("#p_cancel").click(function(){
		$("#p_self").css('display', 'block');
		$("#p_other").css('display', 'none');
	});

	//网上银行 选择充值面额
	$(".game_price_bank").bind('change', function(){
		var price = $(this).val();
		togame_amount('bank', price);
	});

	//支付宝 选择充值面额
	$(".game_price_alipay").bind('change', function(){
		var price = $(this).val();
		togame_amount('alipay', price);
	});

	$(".p_submit").live('click', function(){
		check_from();
	});
});
function check_from(){
	//@todo 
	form_submit();
	//选项卡公共参数
	var _payForm = $("#payment_form");
	var user_code = $("input[name=user_code]", _payForm).val();
	var gameV = $("input[name=game_id]", _payForm).val();
	var serverV = $("input[name=server_id]", _payForm).val();
	var soundsV = $("input[name=sounds]", _payForm).val();
	var status = '';
	
	//验证账号
	$("div").remove('.paymentFormMsg_s');
	$("div").remove('.paymentFormMsg2_s');
	if (user_code.length == 0){
		popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>账号不能为空</div>";
		$(".nS_userCode").append(html + MsgError +'账号不能为空'+ MsgStopDiv);	
		$(".nS_userCode1").append(html + MsgError +'账号不能为空'+ MsgStopDiv);	
	}
	if(gameV == 0) {
		popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>请选择游戏</div>";
		$(".nS_game_id").append(html+MsgError +'请选择游戏'+ MsgStopDiv);
	}
	if(serverV == 0){
		popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>请选择服务器</div>";
		$(".nS_server_id").append(html+MsgError +'请选择服务器'+ MsgStopDiv);
	}
	//其他选项卡所需要参数
	var cardAmt = $("input[name=cardAmt]", _payForm).val(); //面额
	var cardNo = $("input[name=cardNo]", _payForm).val();  //卡号
	var cardPwd = $("input[name=cardPwd]", _payForm).val();  //卡密
	var cardType = $("input[name=cardType]", _payForm).val(); //卡类型
	
	if ((soundsV == 3 || soundsV == 4)){
		cardStartV = 0;
		var ret = card_verify(cardType,cardNo,cardPwd);
		if (ret == true){
			status = true;
		} else {
			$(".nS_cardPwd div").remove('.paymentFormMsg2_s');
			popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>卡号密码的位数不对</div>";
			$(".nS_cardPwd").append(html2+MsgError+'卡号密码的位数不对'+MsgStopDiv);
			cardStartV = 1;
			//status = false;
		};
		if (cardAmt == ''){
			$(".nS_cardAmt div").remove('.paymentFormMsg2_s');
			$(".nS_cardAmt div").remove('.paymentFormMsg_s');
			$(".nS_cardAmt").append(html2+MsgError+'请选择充值面额'+MsgStopDiv);
			popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>请选择充值面额</div>";
			cardStartV = 1;
			//status = false;
		};
	};

	if (user_code != '' && serverV != 0 && cardStartV==0){
		$.ajax({ 
			url: "/ajax/check_user_ajax/", 
			async: false,
			data:{user_code:user_code,server_id_x:serverV},
			dataType:'json',
			success: function(data){
				if (data.info == 'ok' && popHtml == '') {
					$(".p_submit").attr('href', 'javascript:;');
					setTimeout(function(){
						document.payment_form.submit();
					}, 2);
					//$("#payment_form").submit()
				} else {
					var gameId = $("#select_game").val();
					var gameName = $("#select_game option[value="+gameId+"]").html();
					var serverId = $("#select_server").val();
					var serverName = $("#select_server option[value="+serverId+"]").html();
					$("#dialog_wanchen").attr('href', 'http://www.5ding.com/playgame/index/'+gameId+'/'+serverId);
					$("#dialog_name").html(gameName +'-'+ serverName);
					$("#dialog_name").attr('href', 'http://www.5ding.com/playgame/index/'+gameId+'/'+serverId);
					popHtml += "<div class='msgError_s paymentNoBorder_s' style='margin-left: 10px; margin-top: 10px;'>充值的用户还没有在该服务器创建角色</div>";
					dialog("我的标题", "id:dialogMsg", "410px", "auto", "id", "msg_value");
					$("select").css('display', 'none');
					
					//tipsWindown("提示","text:"+popHtml+"<div style='width: 53px; height: 28px; margin: 0 auto; position: absolute; bottom: 10px; left: left: -180px;'><a href='javascript:;' class='index_close common_colse' ><img alt='确定' src='<?php echo @STATIC_URL; ?>
images/payment2/btn_queding.gif'></a></div>", "360", "220", "true", "", "true", "text");
					popHtml = '';
					$(".nS_server_id div").remove('.paymentFormMsg2_s');
					//$(".nS_server_id").append(html+MsgError +'充值的用户还没有在该服务器创建角色'+ MsgStopDiv);
					status = false;
				}
			}
		});
	} else {
		//dialog("我的标题", "id:dialogMsg", "370px", "auto", "id", "msg");
		//$("select").css('display', 'none');
		//tipsWindown("提示","text:"+popHtml+"<div style='width: 53px; height: 28px; margin: 0 auto; position: absolute; bottom: 20px; left: -180px;'><a href='javascript:;' class='index_close common_colse'><img alt='确定' src='<?php echo @STATIC_URL; ?>
images/payment2/btn_queding.gif'></a></div>", "360", "220", "true", "", "true", "text");
		popHtml = '';
	}
}
	
function doSubmit(){
	document.payment_form.submit();
}


//  验证卡的信息是否完整 主要判断长度
function card_verify(cardType,No,Pwd){
	if (cardType == 'junnet' && No.length >= 16 && Pwd.length >= 16){return true;}
	if (cardType == 'sndacard' && No.length >=10 && Pwd.length >= 8){return true;}
	if (cardType == 'zhengtu' && No.length >= 16 && Pwd.length >= 8){return true;}
	if (cardType == 'telecom' && No.length >= 19 && Pwd.length >= 18){return true;}
	if (cardType == 'unicom' && No.length >= 15 && Pwd.length >= 19){return true;}
	if (cardType == 'netease' && No.length >= 13 && Pwd.length >= 9){return true;}
	if (cardType == 'jiuyou' && No.length >= 13 && Pwd.length >= 10){return true;}
	if (cardType == 'wanmei' && No.length >= 10 && Pwd.length >= 15){return true;}
	if (cardType == 'ypcard' && No.length >= 12 && Pwd.length >= 10){return true;}
	if (cardType == 'szx' && No.length >9 && Pwd.length >= 8){return true;}
		
	if (cardType == 'zongyou' && No.length >= 15 && Pwd.length >= 15){return true;}
	if (cardType == 'tianxia' && No.length >= 15 && Pwd.length >= 8){return true;}
	return false;
}

// 功能：清除 表单 提交的数据 （暂时未用到）
function clear_from(){
	$("#payment_form input").each(function(i){
		$(this).val('');
	});
}

// 功能：清除 卡 号 卡密
function clear_card(){
	$("#c_code5 input[name=cardNo]").val("");
	$("#c_code5 input[name=cardPwd]").val("");
	$("#c_code5 input[name=cardAmt]").val("");
}

//功能：随卡类型 改变 卡的面额 与文字描述
function p_card(code){
	$("#payment_form input[name=cardType]").val(code);
	var _self = $("#c_code5");
	var config_payment2_json = <?php echo $this->_tpl_vars['config_payment2_json']; ?>
;
	var html='<table><tr>';
	$.each(config_payment2_json[code].price, function(i,n){
		if ((i+1)%3==0){
			html += '<td><label><input type="radio" class="cardRadio" name="cardAmt" value="'+n+'" id="RadioGroup1_0" />'+n+'元</label></td></tr><tr>';
		} else {
			html += '<td><label><input type="radio" class="cardRadio" name="cardAmt" value="'+n+'" id="RadioGroup1_0" />'+n+'元</label></td>';
		}
	});
	html = html + '</tr></table>';
	$(".value_type_miane", _self).html('');
	$(".value_type_miane", _self).append(html);

	$(".p_card_ps", _self).html(get_code_name(code));
	$(".card_title", _self).html('支付方式：'+get_code_name(code)+'支付');
	var desc = '请务必选择与您使用的'+get_code_name(code)+'相同的面额，';
	$("#card_desc").html(desc);
	
}
/**
 * 返回卡name 
 */
function get_code_name(type){
	if (type == 'junnet') return '骏网一卡通';
	if (type == 'sndacard') return '盛大卡';
	if (type == 'zhengtu') return '征途卡';
	if (type == 'telecom') return '电信卡';
	if (type == 'unicom') return '联通一卡通';
	if (type == 'netease') return '网易一卡通';
	if (type == 'jiuyou') return '久游一卡通';
	if (type == 'wanmei') return '完美一卡通';
	if (type == 'ypcard') return '易宝一卡通';
	if (type == 'szx') return '神州行一卡通';
	
	if(type == 'zongyou') return '纵游一卡通';
	if(type == 'tianxia') return '天下一卡通支付';
}

function form_submit(){
	$("#payment_form input[name=game_id]").val($("#select_game").val());
	$("#payment_form input[name=server_id]").val($("#select_server").val());
	if ($(".user_code:visible input").val().length >0){
		$("#payment_form input[name=user_code]").val($(".user_code:visible input").val());
	};
	$("#payment_form input[name=pay_code]").val($(".value_radio input[name=bank_radio]:checked").val());

	$("#payment_form input[name=amount]").val($(".tab_box:visible .game_amount").val()); 
	$("#payment_form input[name=telephone]").val($("#telephone").val());
	
	$("#payment_form input[name=cardNo]").val($("#c_code5 input[name=cardNo]").val());
	$("#payment_form input[name=cardPwd]").val($("#c_code5 input[name=cardPwd]").val());
	$("#payment_form input[name=cardAmt]").val($("#c_code5 input[name=cardAmt]:checked").val());
}
/**
 * 功能：选择充值方式 选项卡
 */
function paycode_sounds(code){
	$("#payment_form input[name=sounds]").val(code);
	if (code == 1) togame_amount('bank', $(".game_price_bank").val());
	if (code == 2) togame_amount('alipay', $(".game_price_alipay").val());
	
	for(i=1; i<=5; i++){
		$("#c_code"+i).css('display','none');
		$("#t_code"+i).removeClass("selectedGame");
	}
	$("#c_code"+code).css('display', 'block');
	$("#t_code"+code).addClass("selectedGame");

	$("#c_code5 input[name=cardNo]").val("");
	$("#c_code5 input[name=cardPwd]").val("");
	$("#c_code5 input[name=cardAmt]").val("");

	$("#c_code5 div").remove('.paymentFormMsg2_s');
}
/**
 * 功能：获取游戏对应的服务器
 * id game_id  no  要选择服务器的 id
 */
function get_server(id, no){
	var game_obj = $("#select_game");
	var server_obj = $("#select_server");
	var emptyHtml = '<option value=0>请选择服务器</option>';
	$.getJSON('/ajax/get_server_ajax/', {game_id:id}, function(data){
		server_obj.empty();
		if (data.info == 'error') {
			server_obj.text('该游戏没有服务器');
		} else {
			server_obj.append(emptyHtml);
			$.each(data.info, function(i,v){
				if (no == v.gsid) {
					server_obj.append('<option value='+v.gsid+' selected=true>'+v.sname+'</option>');
				} else {
					server_obj.append('<option value='+v.gsid+'>'+v.sname+'</option>');
				};
			});
		};
	});
}

//游戏币换算
function togame_amount(code, price){
	var config_ratio_json = <?php echo $this->_tpl_vars['config_ratio_json']; ?>
;
	var config_payment2_json = <?php echo $this->_tpl_vars['config_payment2_json']; ?>
;
	var _self = $(".togame_amount");
	var game_id = $("#select_game").val();
	var html = '';
	if (game_id != 0){
		var gameAmount = config_payment2_json[code].pay_to_game_agio;
		html = price*gameAmount*config_ratio_json[game_id].ratio + config_ratio_json[game_id].type;
		$(_self).html('充值后您可获得：'+html);
	} else {
		$(_self).html('');
	}
}
//卡类型描述返回
function getCardDesc(type){
	if (type == 'junnet'){ 
		return '请务必选择与您使用的骏网一卡通相同的面额，否则引起的交易失败交易金额不予退还！';
	}
	if (type == 'sndacard') {
		return '请务必选择与您使用的盛大点卡相同的面额，否则引起的交易失败交易金额不予退还。 注意：卡号以CS、S、CA、CSB开头的“盛大互动娱乐卡”进行支付,暂不支持SC开头的卡。';
	}
	if (type == 'zhengtu') {
		return '请务必选择与您使用的征途卡相同的面额，否则引起的交易失败交易金额不予退还';
	}
	if (type == 'telecom') {
		return '请务必选择与您使用的电信卡相同的面额，否则引起的交易失败交易金额不予退还。不支持地方卡充值（如北京电信卡），请使用全国通用电信卡充值。';
	}
	if (type == 'unicom') {
		return '请务必选择与您使用的联通卡相同的面额，否则引起的交易失败交易金额不予退还';
	}
	if (type == 'netease') {
		return '请务必选择与您使用的网易一卡通相同的面额，否则引起的交易失败交易金额不予退还';
	}
	if (type == 'jiuyou') {
		return '请务必选择与您使用的久游一卡通相同的面额，否则引起的交易失败交易金额不予退还';
	}
	if (type == 'wanmei') {
		return '请务必选择与您使用的完美一卡通相同的面额，否则引起的交易失败交易金额不予退还';
	}
	if (type == 'ypcard') {
		return '请务必选择与您使用的易宝E卡通相同的面额，否则引起的交易失败交易金额不予退还';
	}
	if (type == 'szx') {
		return '请务必选择与您使用的神州行一卡通相同的面额，否则引起的交易失败交易金额不予退还';
	}
	
	if (type == 'zongyou') {
		return '请务必选择与您使用的纵游一卡通相同的面额，否则引起的交易失败交易金额不予退还';
	}
	if (type == 'tianxia') {
		return '请务必选择与您使用的天下一卡通相同的面额，否则引起的交易失败交易金额不予退还';
	}
}

$(function(){
	$(".cardRadio").live('click', function(){
		getCardRadioDesc();
	});
})

//获取卡面额点击的描述信息
function getCardRadioDesc(){
	var price = $(".nS_cardAmt [name=cardAmt]:checked").val();
	var code = $("#payment_form [name=cardType]").val();
	var game_id = $("#select_game").val();
	var config_ratio_json = <?php echo $this->_tpl_vars['config_ratio_json']; ?>
;
	var config_payment2_json = <?php echo $this->_tpl_vars['config_payment2_json']; ?>
;
	var cardRadioDesc = '';
	var gameToamount = '';
	if (game_id == 0){
		cardRadioDesc = '请先选择游戏';
	} else if(game_id != '' && code != ''){
		var gameAmount = config_payment2_json[code].pay_to_game_agio;
		gameToamount = Math.floor(price*gameAmount*config_ratio_json[game_id].ratio) + config_ratio_json[game_id].type;
		cardRadioDesc = '充值'+price+'元，可获得'+gameToamount;
	} else if (price == ''){
		cardRadioDesc = '请选择充值面额';
	}
	$("#card_desc").html(cardRadioDesc);
}
</script>