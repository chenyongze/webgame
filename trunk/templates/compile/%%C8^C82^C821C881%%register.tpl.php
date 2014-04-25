<?php /* Smarty version 2.6.14, created on 2011-11-04 15:47:45
         compiled from register.tpl */ ?>

	<div id="reg_wrap">
    	<div id="reg_inner">
            <div class="reg_hd"></div>
            <form id='submitForm' action="/member/register/" method="post" onSubmit="return checkaccept();">
            <input type="hidden" name="game_id" value="<?php echo $this->_tpl_vars['game_id']; ?>
">
            <div class="reg_bd">
            	<p><label class="w66">用户名：</label><input id="user_name" name="user_name" maxlength="16" class="w170" type="text" onblur="checkUserExist(this.value)"/> <span id="username" class="grey"></span></p>
                <p class="textIndent">由6-16位小写英文字母、数字以及下划线_组成,首位为字母</p>
                <p><label class="w66">密码：</label><input id="user_password" name="password" value="" maxlength="12" class="w170" type="password" onblur="checkPwd(this.value)"/> <span id="pwdTip" class="grey"></span></p>
                <p class="textIndent">由6-12位英文字母及数字组成</p>
                <p><label class="w66">重复密码：</label><input id="user_password2" name="repassword"  maxlength="12" class="w170" type="password" onblur="checkPwdRepeat(this.value)" /> <span id="pwdTip2" class="grey"></span></p>
                <p><label class="w66">邮箱：</label><input id="email" name="email" class="w170" type="text" onblur="checkInfoEmail(this.value)" /> <span id="emailTip" class="grey"></span></p>
                <p><label class="w66">真实姓名：</label><input id="truename" name="realname" maxlength="6" class="w170" type="text" onblur="checkTrueNames(this.value);"/> <span id="truenameTip" class="grey"></span></p>
                <p><label class="w66">身份证号：</label><input id="identity" maxlength="18" name="identity" class="w170" type="text" onblur="checkid()"/> <span id="idtip" class="grey"></span></p>
                <p><label class="w66">验证码：</label><input id="valid" name="valid" maxlength="4" class="w88" type="text" onblur="checkValid(this.value)"/> <span id="validTip" class="grey"></span></p>
				<p style="text-indent:67px;"><?php echo @VALID_NUMBER; ?>
<a class="change" style="color:#a20d05;" href="javascript:void(0)" onclick="document.getElementById('valid_src').src='<?php echo @SITE_URL; ?>
member/validn/?f='+Math.random()" >看不清？换一个</a></p>
                <p align="center"><input name="" id="chkAgreement"  type="checkbox" value="1" checked="checked"  />&nbsp;<label><a href="http://passport.6msj.com/member/agreement.htm" target="_new" onclick="document.getElementById('input1').click();"><font color="#000">我已经仔细阅读并同意《神雕用户注册协议书》</font></a></label></p>
				<p align="center"><input name="" class="btn_reg" type="button" onclick="submitForm()" value="注册" /></p>              
            </div>
            </form>
            <div class="reg_ft"></div>
    	</div>
    </div>
